<?

class Forum{
  public $id_topic;
  public $id_topic_type;
  public $country;
  public $id_club;
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
    $this->title = $data->title;
    $this->text = $data->topic;
    $this->topic_date = $data->topic_date;
    $this->likes = $data->likes;
    $this->dislikes = $data->dislikes;
    $this->edited = $data->edited;
    $this->edited_date = $data->edited_date;
  }
  public function countReplies(){
    
  }
  public function __loadreplies(){

  }
  public function __post(){}
  public function __reply($text){}
}
