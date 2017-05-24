<?

include('../../classes/Connection.php');
include('../../classes/Admin.php');
include('../../classes/Club.php');
include('../../classes/JsonOutput.php');
session_start();
JsonOutput::jsonHeader();

$admin = new Admin($_SESSION['SL_account']);
if($admin->is_GT()){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_report where id_club_report = :report");
    $query->bindParam(':report',$_POST['id_report']);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    $data['club'] = Club::getClubNameById($data['id_club']);
    $data['club_reported'] = Club::getClubNameById($data['id_club_reported']);
    echo JsonOutput::success(array($data));
}
