<?
require_once('../class/Connection.php');
require_once('../class/JsonOutput.php');
require_once('../class/Location.php');
JsonOutput::jsonHeader();
if($_GET['method']=='all'){
  echo JsonOutput::success(Location::getAllLocations());
}
exit;
