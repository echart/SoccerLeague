<?
class Feed{
  public $id_club;
  public $tweet=array();
  public function __construct($id_club){
    $this->id_club=$id_club;
  }
  public function __getLastTweetsByClub($qtd=20, $page=0){
    $offset=$page*$qtd;
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet FROM tweet where id_club=:id_club order by tweetdate desc limit :qtd offset :offset1");
    $query->bindParam(':qtd',$qtd);
    $query->bindParam(':offset1',$offset);
    $query->bindParam(':id_club',$this->id_club);
    $query->execute();
    $i=0;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->tweet[$i]=$data['id_tweet'];
      $i++;
    }
    return $this->tweet;
  }
  public function __getLastTweets($qtd=20,$page=0){
    $offset=$page*$qtd;
    $query=Connection::getInstance()->connect()->prepare("SELECT * from tweet where reply_to is null and id_club=:id_club or id_club in (SELECT buddya FROM buddies where buddyb=:id_club)  or id_club in (SELECT buddyb FROM buddies where buddya=:id_club) order by tweetdate desc limit :qtd offset :offset1");
    $query->bindParam(':qtd',$qtd);
    $query->bindParam(':offset1',$offset);
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
