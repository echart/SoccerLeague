<?
$page=intval($this->request['page'])-1;
if($this->request['method']=='all' AND $_SESSION['SL_club']==$this->request['id']){
  $feed = new Feed($this->request['id']);
  $feed->__getLastTweets(50,$page);
}else{
  $feed = new Feed($this->request['id']);
  $feed->__getLastTweetsByClub(50,$page);
}
$data = array('tweets'=>array());
foreach ($feed->tweet as $key => $id_tweet) {
  $tweet        = Tweet::__gettweet($id_tweet);
  $tweetContent = Tweet::__gettweetcontent($id_tweet);
  $tweetReplies = Tweet::__getrepliesnumber($id_tweet);

  $data['tweets'][$key]['id_tweet'] = $tweet['id_tweet'];
  $data['tweets'][$key]['id_club'] = $tweet['id_club'];
  $clubinfo = new ClubInfo(new Club($tweet['id_club']));
  $data['tweets'][$key]['logo'] = $clubinfo->__logo();
  $data['tweets'][$key]['clubname'] = Club::getClubNameById($tweet['id_club']);
  $date = new DateTime($tweet['tweetdate']);
  $data['tweets'][$key]['tweetdate'] = $date->format('d/m/Y H:i:s');
  $data['tweets'][$key]['reply_to'] = $tweet['reply_to'];
  $data['tweets'][$key]['id_tweet_content'] = $tweetContent['id_tweet_content'];
  $data['tweets'][$key]['type'] = $tweetContent['type'];
  $data['tweets'][$key]['tweet'] = $tweetContent['tweet'];
  $data['tweets'][$key]['likes'] = $tweetContent['likes'];
  $data['tweets'][$key]['liked'] = (Tweet::liked($_SESSION['SL_club'],$tweet['id_tweet'])) ? 'liked' : '';
  $data['tweets'][$key]['replies'] = $tweetReplies;

}
$data= array('data'=>$data);
echo JsonOutput::load($data);
exit;
