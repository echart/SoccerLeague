<?
ini_set('display_errors','on');
include('../../classes/Connection.php');
include('../../classes/Club.php');
include('../../classes/JsonOutput.php');
include('../__date.php');

$id_club = $_GET['id_club'];

JsonOutput::jsonHeader();

$club = new Club($id_club);
$club->__load();
$status=$club->status;
$query=Connection::getInstance()->connect()->prepare("SELECT leaguename,division,divgroup FROM club inner join competition using(id_country) inner join league using(id_competition) where id_club=:id_club and official=true");
$query->bindParam(':id_club',$id_club);
$query->execute();
$query->setFetchMode(PDO::FETCH_OBJ);
$x=$query->fetch();

$lastlogin = $club->lastlogin()==false ? '...' : __date($club->lastlogin());
$data = array('data'=>array('leaguename'=>$x->leaguename,'clubname'=>$club->clubname,'created'=>__date($club->created),'status'=>$club->status,'country'=>$club->id_country, 'lastlogin'=>$lastlogin));
echo JsonOutput::load($data);
