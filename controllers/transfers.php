<?

$this->title = 'Mercado de Transferências';
$this->menu = 'transfers';
$this->submenu = 'transfers';
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
include('helpers/__country.php');
include('helpers/_rec.php');


$query = Connection::getInstance()->connect()->prepare("SELECT * FROM transferlist where status=TRUE and enddate>:enddate order by enddate asc");
$query->bindParam(':enddate',date('Y-m-d H:i:s'));
$query->execute();

$this->transfer = array();
$i = 0;
while($data=$query->fetch()){
  $this->transfer[$i]['transfer'] = $data;
  $player = Player::__this($data['id_player']);
  $player->__loadinfo();
  $player->__loadpositions();
  $player->skillIndex();
  $this->transfer[$i]['player'] = $player;
  $i++;
}
