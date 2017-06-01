<?
error_reporting(!E_ALL);
ini_set('display_errors',0);
include('../classes/Match.php');
include('../classes/MatchEngine.php');
include('../classes/Club.php');
include('../classes/ClubInfo.php');
include('../classes/ClubFans.php');
include('../classes/ClubStadium.php');
include('../classes/MatchReport.php');
include('../classes/MatchStats.php');
include('../classes/Player.php');
include('../classes/Goalkeeper.php');
include('../classes/LinePlayer.php');
include('../classes/Connection.php');
include('../classes/Soccer.php');

$day = date('Y-m-d');
$day = '2017-05-31';
$query = Connection::getInstance()->connect()->prepare("SELECT id_match FROM matches where day=:day");
$query->bindParam(':day',$day);
$query->execute();
while($data=$query->fetch()){
  $match = new Match($data['id_match']);
  $match->__load();
  $engine = new MatchEngine($match);
  $engine->__loadteams();
  if($engine->__WO()!=-1){
    $engine->__WO();
    $engine->matchStats->__createWO();
    $engine->matchReport->__save();
  }else{
    $engine->weather();
    $engine->pitch_condition();
    $engine->attendance();
    $engine->match();
  }
}
