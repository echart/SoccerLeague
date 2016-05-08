<?
header('Content-type: application/JSON');

include('../class/connection.php');
include('../class/account.php');
include('../class/authentication.php');
include('../class/club.php');

$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';

?>