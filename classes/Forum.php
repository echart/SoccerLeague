<?

class Forum{
  public $id_topic;
  public $id_topic_type;
  public $country;
  public $id_club;
  public $fixed;
  public $title;
  public $text;
  public $topic_date;
  public $likes;
  public $dislikes;
  public $edited;
  public $edited_date;

  public function __construct($id_topic = ''){
    $this->id_topic = $id_topic;
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM forum_topic where id_topic=:id_topic");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    $this->id_topic_type = $data->id_topic_type;
    $this->country = $data->country;
    $this->id_club = $data->id_club;
    $this->fixed = $data->fixed;
    $this->title = $data->title;
    $this->text = $data->topic;
    $this->topic_date = $data->topic_date;
    $this->likes = $data->likes;
    $this->dislikes = $data->dislikes;
    $this->edited = $data->edited;
    $this->edited_date = $data->edited_date;
  }
  public function countReplies(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM forum_topic_reply where id_topic=:id_topic");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->execute();
    return $query->rowCount();
  }
  public function __loadreplies($page){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM forum_topic_reply where id_topic = :id_topic order by reply_date asc limit 6 offset :page");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->bindParam(':page',$page);
    $query->execute();
    $topics = array();
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $topics[] = $data;
    }
    return $topics;
  }
  public function __post(){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO forum_topic(id_topic_type, id_club, country, title, topic) VALUES (:id_topic_type, :id_club, :country,  :title, :topic)");
    $query->bindParam(':id_topic_type',$this->id_topic_type);
    $query->bindParam(':id_club',$this->id_club);
    $query->bindParam(':country',$this->country);
    $query->bindParam(':title',$this->title);
    $query->bindParam(':topic',$this->text);
    $query->execute();
    return true;
  }
  public function __reply($text){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO forum_topic_reply(id_topic, id_club, topic) VALUES (:id_topic, :id_club, :topic)");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->bindParam(':id_club',$this->id_club);
    $query->bindParam(':topic',$text);
    $query->execute();

  }
  public function __deletetopic(){
    $query = Connection::getInstance()->connect()->prepare("DELETE FROM forum_topic where id_topic = :id_topic");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->execute();
  }
  public function __deletereply(){
    $query = Connection::getInstance()->connect()->prepare("DELETE FROM forum_topic_reply where id_reply = :id_topic");
    $query->bindParam(':id_topic',$this->id_topic);
    $query->execute();
  }
  public static function _IDType($type){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM forum_type where type=:type");
    $query->bindParam(':type',$type);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    return $data->id_topic_type;
  }
}
