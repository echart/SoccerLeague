<?
$this->menu  = "club";
$this->submenu = 'stadium';
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$id_club = $this->get['id'] ?? $_SESSION['SL_club'];

$stadium = new ClubStadium(new Club($id_club));

$this->title = $stadium->name();
$this->capacity = $stadium->capacity();

$this->addCSSFile('stadium.css');
