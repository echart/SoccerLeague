<?

include('../../classes/Connection.php');
include('../../classes/Club.php');
include('../../classes/Player.php');
include('../../classes/Lineplayer.php');
include('../../classes/Goalkeeper.php');
include('../../classes/JsonOutput.php');
include('../__date.php');
include('../__country.php');

JsonOutput::jsonHeader();

$id_player = $_GET['id_player'];
$playerdata = array();

$player = Player::__this($id_player);
$player->__loadinfo();
$player->__loadskills();
$player->__loadpositions();
$player->__loadappearance();
$player->skillIndex();

$playerdata['name'] = $player->name;
$playerdata['clubname'] = Club::getClubNameById($player->id_club);
$playerdata['club'] = $player->id_club;
$country = getCountryByID($player->id_country);
$playerdata['country'] = $country['country'];
$playerdata['wage'] = $player->wage;
$playerdata['height'] = $player->height;
$playerdata['weight'] = $player->weight;
$playerdata['age'] = $player->age;
$playerdata['skill_index'] = $player->skill_index;

$data = array('data'=>$playerdata);
echo JsonOutput::load($data);
