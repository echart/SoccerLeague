<?
class Feed{
  public $id_club;
  public $tweet=array();
  public function __construct($id_club){
    $this->id_club=$id_club;
  }
  public function __getLastTweetsByClub($qtd=20){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet FROM tweet where id_club=:id_club order by tweetdate desc limit :qtd");
    $query->bindParam(':qtd',$qtd);
    $query->bindParam(':id_club',$this->id_club);
    $query->execute();
    $i=0;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->tweet[$i]=$data['id_tweet'];
      $i++;
    }
    return $this->tweet;
  }
  public function __getLastTweets($qtd=20){
    $query=Connection::getInstance()->connect()->prepare("select * from tweet where id_club=:id_club or id_club in (SELECT buddy1 FROM buddies where buddy2=:id_club)  or id_club in (SELECT buddy2 FROM buddies where buddy1=:id_club)order by tweetdate desc limit :qtd");
    $query->bindParam(':qtd',$qtd);
    $query->bindParam(':id_club',$this->id_club);
    $query->execute();
    $i=0;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->tweet[$i]=$data['id_tweet'];
      $i++;
    }
    return $this->tweet;
  }
}
