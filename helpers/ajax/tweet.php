<?
error_reporting(!E_ALL);
include('../../classes/Connection.php');
include('../../classes/Tweet.php');
include('../../classes/Club.php');
include('../../classes/PRO.php');
include('../../classes/ClubInfo.php');
include('../../classes/JsonOutput.php');
include('../__date.php');

session_start();
$id_tweet = $_GET['id_tweet'];
if($_GET['method']=='post'){
  $tweet= $_POST['tweet'];
  if($_POST['reply_to']=='' or $_POST['reply_to']==null){
    $reply_to = null;
  }else{
    $reply_to = $_POST['reply_to'];
  }
  if(Tweet::__tweet($_SESSION['SL_club'],'M',$tweet,null,$reply_to)){
    echo JsonOutput::success(array('success'=>'posted'));
  }else{
    echo JsonOutput::error('error','error');
  }

}else if($_GET['method']=='get'){
  $tweet        = Tweet::__gettweet($id_tweet);
  $tweetContent = Tweet::__gettweetcontent($id_tweet);
  $tweetReplies = Tweet::__getrepliesnumber($id_tweet);
  $key = 0;
  $data['tweet']['id_tweet'] = $tweet['id_tweet'];
  $data['tweet']['id_club'] = $tweet['id_club'];
  $clubinfo = new ClubInfo(new Club($tweet['id_club']));
  $data['tweet']['logo'] = $clubinfo->__logo();
  $data['tweet']['clubname'] = Club::getClubNameById($tweet['id_club']);
  $date = new DateTime($tweet['tweetdate']);
  $data['tweet']['tweetdate'] = $date->format('d/m/Y H:i:s');
  $data['tweet']['reply_to'] = $tweet['reply_to'];
  $data['tweet']['id_tweet_content'] = $tweetContent['id_tweet_content'];
  $data['tweet']['type'] = $tweetContent['type'];
  $data['tweet']['tweet'] = $tweetContent['tweet'];
  $data['tweet']['likes'] = $tweetContent['likes'];
  $data['tweet']['liked'] = (Tweet::liked($_SESSION['SL_club'],$tweet['id_tweet'])) ? 'liked' : '';
  $data['tweet']['replies'] = $tweetReplies;

  $replies = Tweet::__getreplies($id_tweet);
  $x=0;
  while($tweetReplies--){
    $tweet=$replies->fetch(PDO::FETCH_OBJ);
    $tweet        = Tweet::__gettweet($tweet->id_tweet);
    $tweetContent = Tweet::__gettweetcontent($tweet['id_tweet']);
    $key = 0;
    $data['replies'][$x]['id_tweet'] = $tweet['id_tweet'];
    $data['replies'][$x]['id_club'] = $tweet['id_club'];
    $clubinfo = new ClubInfo(new Club($tweet['id_club']));
    $data['replies'][$x]['logo'] = $clubinfo->__logo();
    $data['replies'][$x]['clubname'] = Club::getClubNameById($tweet['id_club']);
    $date = new DateTime($tweet['tweetdate']);
    $data['replies'][$x]['tweetdate'] = $date->format('d/m/Y H:i:s');
    $data['replies'][$x]['reply_to'] = $tweet['reply_to'];
    $data['replies'][$x]['id_tweet_content'] = $tweetContent['id_tweet_content'];
    $data['replies'][$x]['type'] = $tweetContent['type'];
    $data['replies'][$x]['tweet'] = $tweetContent['tweet'];
    $data['replies'][$x]['likes'] = $tweetContent['likes'];
    $data['replies'][$x]['liked'] = (Tweet::liked($_SESSION['SL_club'],$tweet['id_tweet'])) ? 'liked' : '';
    $x++;
  }

  $data= array('data'=>$data);
  echo JsonOutput::load($data);
}else if($_GET['method']=='delete'){
  $id_tweet = $_GET['id_tweet'];
  $tweet        = Tweet::__gettweet($id_tweet);

  if($_SESSION['SL_club']==$tweet['id_club']){
    Tweet::__deletetweet($id_tweet);
    echo JsonOutput::success(array('success'=>'deleted'));
  }else{
    echo JsonOutput::error('error','denied');
  }
}
