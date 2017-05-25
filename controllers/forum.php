<?
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$country = strtoupper($this->request['country']) ?? strtoupper($_SESSION['SL_country']);

if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: '.App::url().'forum/'.strtolower($_SESSION['SL_country']).'/general/1');

$this->menu = 'forum';
switch ($this->get['subrequest']) {
  case 'post':
    if($this->request['type']!='announcements' OR($this->request['type']=='announcements' and $this->admin()->is_GT())){
      $topic = new Forum();

      $title = new Filters($this->post['title']);
      $topic->title = $title->filter();

      $text = new Filters($this->post['text']);
      $topic->text = $text->filter();

      $topic->id_club = $_SESSION['SL_club'];
      $topic->id_topic_type = Forum::_IDType($this->request['type']);
      $topic->country = $this->request['country'];

      $topic->__post();
      header('Location: ' . $this->tree . 'forum/'.$this->request['country'].'/'.$this->request['type']);
    }
    exit;
    break;
  case 'reply':
    $this->requestURL='forum_viewtopic.php';
    $topic = new Forum($this->post['id_topic']);

    $text = new Filters($this->post['text']);

    $topic->id_club = $_SESSION['SL_club'];
    $reply = $topic->__reply($text->filter());
    $topic->country = $this->request['country'];

    header('Location: ' . $this->tree . 'forum/'.$this->post['country'].'/'.$this->post['type'].'/topic/'.$this->post['id_topic']);
    break;
  default:
    $this->submenu='forum';
    if(isset($this->request['topic'])){
      $this->requestURL='forum_viewtopic';
      $this->title = 'Forum ' . $country .' '. ucfirst($this->request['type']);

      $this->page = $this->request['page'] ?? 0;
      $this->page = ($this->page==0) ? 0 : 6*($this->request['page']-1);

      $this->country = strtolower($country);

      $this->topic = new Forum($this->request['topic']);
      $this->topic->__load();

      $this->replies = $this->topic->__loadreplies($this->page);
      $this->addCSSFile('forum_topic.css');

    }else{
      $this->title = 'Forum ' . $country .' '. ucfirst($this->request['type']);

      $this->type = $this->request['type'];
      $this->page = $this->request['page'] ?? 0;
      $this->page = ($this->page==0) ? 0 : 10*($this->request['page']-1);
      $this->country = strtolower($country);
      $query = Connection::getInstance()->connect()->prepare("SELECT id_topic from forum_topic inner join forum_type using(id_topic_type) where country = :country AND type=:type order by fixed desc,topic_date desc limit 10 offset :page");
      $query->bindParam(':country',$this->country);
      $query->bindParam(':type',$this->type);
      $query->bindParam(':page',$this->page);
      $query->execute();

      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $topic = new Forum($data['id_topic']);
        $topic->__load();
        $this->forum['topics'][] = $topic;
      }
      $this->addCSSFile('forum.css');

      $query = Connection::getInstance()->connect()->prepare("SELECT id_topic from forum_topic inner join forum_type using(id_topic_type) where country = :country AND type=:type");
      $query->bindParam(':country',$this->country);
      $query->bindParam(':type',$this->type);
      $query->execute();

      $this->data['total'] = $query->rowCount();
    }
    break;
}
