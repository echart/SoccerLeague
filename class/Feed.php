<?
include('Connection.php');
class Feed{
  public $id_club;
  public $tweet=array();
  public function __construct($id_club){
    $this->id_club=$id_club;
  }

  public function __getLastTweets($qtd=20,$id_club=''){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM tweet where id_club=:id_club order by tweetdate desc");
    $query->bindParam(':id_club',$this->id_club);
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->tweet[]['id_tweet']=$data['id_tweet'];
      $this->tweet[]['tweetdate']=$data['tweetdate'];
      $this->tweet[]['istweet']='true';
    }
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM retweet where id_club=:id_club order by retweetdate desc");
    $query->bindParam(':id_club',$this->id_club);
    $query->execute();
    $i=0;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->tweet[]['id_tweet']=$data['id_retweet'];
      $this->tweet[]['tweetdate']=$data['retweetdate'];
      $this->tweet[]['isretweet']='true';
    }
    return $this->tweet;
  }
}

$feed= new Feed(1);
$feed->__getLastTweets();

print_r($feed->tweet);
