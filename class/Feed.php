<?
/**
 * Type T = transfer
 * Type G = game
 * Type M = miscellaneous
 * type F = New Forum
 * type A = anchievement
 */
 /*
create table feed{
  id_feed serial primary key,
  id_club integer,
    foreign key(id_club) references club(id_club),
  feed_type varchar(1),
  feed_content text,
  feed_likes integer,
  feed_deslikes integer
}

create table feed_comment{
  id_feed_comment serial primary key,
  id_feed integer,
    foreign key(id_feed) references feed(id_feed),
  id_club integer,
    foreign key(id_club) references club(id_club),
  feed_comment text,
  feed_likes integer,
  feed_deslikes integer
}
*/
class Feed{
  public $id_feed;
  public $id_club;
  public $feed_type;
  public $feed_content;
  public $feed_likes;
  public $feed_deslikes;

  public function __construct($id_club,$feed_type){
    $this->id_club=$id_club;
    $this->feed_type=$feed_type;
  }
  public function __getFeed($id_feed){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM feed where id_feed=:id_feed");
    $query->bindParam(':id_feed',$id_feed);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);

    $this->id_feed=$data['id_feed'];
    $this->id_club=$data['id_club'];
    $this->feed_type=$data['feed_type'];
    $this->feed_content=$data['feed_content'];
    $this->feed_likes=$data['feed_likes'];
    $this->feed_deslikes=$data['feed_deslikes'];
  }

  public function feedContent($feed_contet){
    $this->feed_content=$feed_content;
  }
  public function feed_type
}
