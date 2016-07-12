<?
$club = $this->request['id'] ?? $_SESSION['SL_club'];


if(!isset($this->request['id'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: http://'.$_SERVER['SERVER_NAME'].'/club/'.$club);
