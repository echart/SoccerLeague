<?
JsonOutput::jsonHeader();
if($this->request['method']=='all'){
  echo JsonOutput::success(Location::getAllLocations());
}
exit;
