<?
include('../../classes/Connection.php');
include('../../classes/Club.php');
include('../../classes/League.php');
include('../../classes/JsonOutput.php');

$who = $_POST['who'];

$search = Connection::getInstance()->connect()->prepare("SELECT * FROM club where clubname ilike ? order by id_club limit 30");
$params = array("%$who%");
$search->execute($params);
$result = array();
$i=0;
while($data = $search->fetch(PDO::FETCH_OBJ)){
  $result[$i]['id_club'] = $data->id_club;
  $result[$i]['clubname'] = $data->clubname;
  $id_league = Club::getClubIDLeague($data->id_club);
  $league = new League();
  $league->id_league = $id_league;
  $league->__load();
  $result[$i]['competition'] = $league->name;
  $i++;
}
echo JsonOutput::success($result);
