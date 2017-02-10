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
   tweetdate timestamp without time zone default now(),
   retweet integer,
   reply_to integer
 );

 create table tweetContent(
   id_tweet_content serial primary key,
   id_tweet integer not null,
     foreign key(id_tweet) references tweet(id_tweet),
   type varchar(1) not null default 'C',
   tweet varchar(200) not null,
   likes integer default 0,
   tags text[]
 );
 crete table tweetLikes(
  id_like serial primary key,
  id_tweet integer not null,
    foreign key(id_tweet) references tweet(id_tweet),
  id_club foreign key(id_club) references club(id_club)
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
  public static function __gettweetcontent($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM tweetContent where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public static function __getreplies($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet FROM tweet where reply_to=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  /*
  TAGS SHOULD BE USED LIKE THIS
  '{{"meeting", "lunch"}, {"training", "presentation"}}'
  */
  public static function __tweet($id_club,$type,$tweet,$tags,$reply_to='NULL'):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO tweet(id_club,reply_to) values (:id_club,:reply_to)");
      $query->bindParam(':id_club',$id_club);
      $query->bindParam(':reply_to',$reply_to);
      $query->execute();
      $id_tweet=Connection::getInstance()->connect()->lastInsertID('tweet_id_tweet_seq');
      try{
        $query=Connection::getInstance()->connect()->prepare("INSERT INTO tweetContent(id_tweet,tweet,type,tags) values (:id_tweet,:tweet,:type,:tags)");
        $query->bindParam(':id_tweet',$id_tweet);
        $query->bindParam(':type',$type);
        $query->bindParam(':tweet',$tweet);
        $query->bindParam(':tags',$tags);
        $query->execute();
      }catch(PDOException $e){
        $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweet where id_tweet=:id_tweet");
        $query->bindParam(':id_tweet',$id_tweet);
        $query->execute();
      }
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }
  public static function __retweet($id_tweet,$id_club){
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO tweet (id_club,retweet) values (:id_club,:id_tweet)");
      $query->bindParam(':id_club',$id_club);
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }

  public static function __unretweet($id_tweet,$id_club){
    try{
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweet where id_club=:id_club and id_tweet=:id_tweet");
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
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweetLikes where id_tweet=:id_tweet");
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweetContent where id_tweet=:id_tweet");
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweet where id_tweet=:id_tweet");
      $query->bindParam(':id_tweet',$id_tweet);
      $query->execute();
      return true;
    }catch(PDOException $e){echo $e->getmessage(); return false;}
  }
  public static function __like($id_tweet,$id_club){
    $query=Connection::getInstance()->connect()->prepare("INSERT INTO tweetLikes(id_tweet,id_club) values (:id_tweet,:id_club)");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$id_club);
    $query->execute();
  }
  public static function __deslike($id_tweet,$id_club){
    $query=Connection::getInstance()->connect()->prepare("DELETE FROM tweetLikes where id_tweet=:id_tweet and id_club=:id_club");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$id_club);
    $query->execute();
  }
  public static function __countLikes($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet FROM tweetLikes where id_tweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();

    return $query->rowCount();
  }
  public static function __countRetweets($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT count(id_tweet) as x from tweet where retweet=:id_tweet");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);

    return $data['x'];
  }

  public static function liked($id_club,$id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet from tweetLikes where id_tweet=:id_tweet and id_club=:id_club");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$id_club);
    $query->execute();
    if($query->rowCount()>0){
      return true;
    }else {
      return false;
    }
  }

  public static function tweetIsMine($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_club from tweet where id_tweet=:id_tweet and id_club=:id_club");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$_SESSION['SL_club']);
    $query->execute();
    if($query->rowCount()>0){
      return true;
    }else {
      return false;
    }
  }

  public static function retweeted($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet from tweet where retweet=:id_tweet and id_club=:id_club");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$_SESSION['SL_club']);
    $query->execute();
    if($query->rowCount()>0){
      return true;
    }else {
      return false;
    }
  }
  public static function retweetGetId($id_tweet){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_tweet from tweet where retweet=:id_tweet and id_club=:id_club");
    $query->bindParam(':id_tweet',$id_tweet);
    $query->bindParam(':id_club',$_SESSION['SL_club']);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data['id_tweet'];
  }
}
