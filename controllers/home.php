<?
require_once('helpers/__country.php');
$this->data['menu']='home';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Home - Soccer League Beta';

$this->addCSSFile('home.css');
$this->addCSSFile('tweet.css');
$this->addJSFile('tweet.js');

$feed = new Feed($_SESSION['SL_club']);
$feed->__getLastTweets(50);
$i=0;
foreach ($feed->tweet as $key => $id_tweet) {
  $tweet=Tweet::__gettweet($id_tweet);
  $tweetContent=Tweet::__gettweetcontent($id_tweet);
  $this->data['tweet'][$i]['id_tweet']=$tweet['id_tweet'];
  $this->data['tweet'][$i]['id_club']=$tweet['id_club'];
  $this->data['tweet'][$i]['tweetdate']=$tweet['tweetdate'];
  $this->data['tweet'][$i]['retweet']=$tweet['retweet'];
  $this->data['tweet'][$i]['reply_to']=$tweet['reply_to'];
  $this->data['tweet'][$i]['type']=$tweetContent['type'];
  $this->data['tweet'][$i]['tweet']=$tweetContent['tweet'];
  $this->data['tweet'][$i]['likes']=$tweetContent['likes'];
  $this->data['tweet'][$i]['tags']=$tweetContent['tags'];
  $i++;
}
