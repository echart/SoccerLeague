<?
include('../../classes/Connection.php');
include('../../classes/Club.php');
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
  $i++;
}
echo JsonOutput::success($result);
