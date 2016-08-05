<?
/**
 * Type T = transfer
 * Type G = game
 * Type M = miscellaneous
 * type F = New Forum
 * type A = anchievement
 */
 /*
create table tweet(
  id_tweet serial primary key,
  id_club integer not null,
    foreign key(id_club) references club(id_club),
  type varchar(1) not null,
  tweet varchar(200) not null,
  likes integer default 0,
  reply_to integer,
  tags text[],
)

create table retweet(
  id_retweet serial primary key,
  id_tweet integer not null,
    foreign key(id_tweet) references tweet(id_tweet),
  id_club integer not null,
    foreign key(id_club) references club(id_club)
)
*/
class Tweet{
  public static function __gettweet($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM tweet where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public static function __getreplies($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM tweet where reply_to=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  /*
  TAGS SHOULD BE USED LIKE THIS
  '{{"meeting", "lunch"}, {"training", "presentation"}}'
  */
  public static function __tweet($id_club,$type,$tweet,$tags,$reply_to='null'):bool{
    try{
      $query=Connection::getInstance->connect()->prepare("INSERT INTO tweet(id_club,type,tweet,likes,reply_to,tags) values (:id_club,:type,:tweet,0,:tags,reply_to)");
      $query->bindParam(':id_club',$id_club);
      $query->bindParam(':type',$type);
      $query->bindParam(':tweet',$tweet);
      $query->bindParam(':reply_to',$reply_to);
      $query->bindParam(':tags',$tags);
      $query->execute();
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }
  public static function __retweet($id_tweet,$id_club){
    try{
      $query=Connection::getInstance->connect()->prepare("INSERT INTO retweet (id_tweet,id_club) values (:id_tweet,:id_club)");
      $query->bindParam(':id_club',$id_club);
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }
  public static function __deletetweet($id_tweet):bool{
    try{
      $query=Connection::getInstance->connect()->prepare("DELETE FROM tweet where id_tweet=:id_tweet");
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      return true;
    }catch(PDOException $e){echo $e->getmessage(); return false}
  }
  public static function __like($id_tweet){
    $likes=self::__countLikes($id_tweet)+1;

    $query=Connection::getInstance->connect()->prepare("UPDATE tweet set likes=:likes where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':likes',$likes);
    $query->execute();
  }
  public static function __countLikes($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT likes FROM tweet where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data['likes'];
  }
  public static function __countRetweets($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_retweet from retweet where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    return $query->rowCount();
  }
}
