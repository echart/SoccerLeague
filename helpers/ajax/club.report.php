<?
include('../../classes/Connection.php');
include('../../classes/Admin.php');
include('../../classes/JsonOutput.php');
session_start();
JsonOutput::jsonHeader();
$query = Connection::getInstance()->connect()->prepare("INSERT INTO club_report (id_club,id_club_reported,reason,description) values (:id_club,:id_club_reported,:reason,:description)");
$query->bindParam(':id_club',$_SESSION['SL_club']);
$query->bindParam(':reason',$_POST['reason']);
$query->bindParam(':id_club_reported',$_POST['id_club']);
$query->bindParam(':description',$_POST['description']);
$query->execute();

echo JsonOutput::success(array('data','success'));
