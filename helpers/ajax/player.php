<?

include('../../classes/Connection.php');
include('../../classes/App.php');
include('../../classes/Club.php');
include('../../classes/Player.php');
include('../../classes/Lineplayer.php');
include('../../classes/Goalkeeper.php');
include('../../classes/JsonOutput.php');
include('../__date.php');
include('../_rec.php');
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
$player->wage();

$playerdata['name'] = $player->name;
$playerdata['player_id'] = $player->id_player;
$playerdata['clubname'] = Club::getClubNameById($player->id_club);
$playerdata['club_id'] = $player->id_club;
$country = getCountryByID($player->id_country);
$playerdata['country'] = $country['country'];
$playerdata['country_id'] = $player->id_country;
$playerdata['country_abbr'] = $country['abbreviation'];
$playerdata['wage'] = number_format($player->wage,2,',','.');
$playerdata['height'] = $player->height;
$playerdata['weight'] = $player->weight;
$playerdata['age'] = $player->age;
$playerdata['skill_index'] = $player->skill_index;
$playerdata['positions'] = $player->position;
$playerdata['injury'] = 0;
$playerdata['retirement'] = 0;
$playerdata['recomendation'] = _rec($player->rec, App::url());

$data = array('data'=>$playerdata);
echo JsonOutput::load($data);
/*
name
playerid
age
clubid
clubname
country
positions
injury
retirering
número
skillindex
skills
wage
*/
