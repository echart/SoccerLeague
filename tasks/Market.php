<?
$hash = $_GET['hash'];
if(isset($hash) and $hash == 'da39a3ee5e6b4b0d3255bfef95601890afd80709'){
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  //requires
  require_once('../classes/Connection.php');
  require_once('../classes/Player.php');
  require_once('../classes/Goalkeeper.php');
  require_once('../classes/Lineplayer.php');

  $date = date('Y-m-d');

}
