<?
include('../../classes/Connection.php');
include('../../classes/JsonOutput.php');
include('../../classes/Club.php');

$id_club = $_GET['id_club'];

JsonOutput::jsonHeader();

$club = new Club($id_club);
$club->__load();

$data = array('data'=>array('clubname'=>$club->clubname,'created'=>$club->created,'status'=>$club->status,'country'=>$club->id_country, 'lastlogin'=>$club->lastlogin()));
echo JsonOutput::load($data);
