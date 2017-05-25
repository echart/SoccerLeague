<?
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$country = strtoupper($this->request['country']) ?? strtoupper($_SESSION['SL_country']);

if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: '.App::url().'forum/'.strtolower($_SESSION['SL_country']).'/general/1');

$this->menu = 'forum';
switch ($this->get['subrequest']) {
  case 'post':
    echo 'novo topic';
    exit;
    break;
  case 'reply':
    echo 'reply';
    exit;
    break;
  default:
    $this->submenu='forum';
    if(isset($this->request['topic'])){
      echo 'topic';exit;
    }else{
      $this->title = 'Forum ' . $country .' '. ucfirst($this->request['type']);

      $this->type = $this->request['type'];
      $this->page = 10*($this->request['page']-1) ?? 0;
      $this->country = strtolower($country);
      $query = Connection::getInstance()->connect()->prepare("SELECT id_topic from forum_topic inner join forum_type using(id_topic_type) where country = :country AND type=:type limit 10 offset :page");
      $query->bindParam(':country',$this->country);
      $query->bindParam(':type',$this->type);
      $query->bindParam(':page',$this->page);
      $query->execute();

      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        echo $data->topic;
        $topic = new Forum($data['id_topic']);
        $topic->__load();
        $this->forum['topics'][] = $topic;
      }
      $this->addCSSFile('forum.css');
    }
    break;
}
