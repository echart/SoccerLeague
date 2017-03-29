<?
include('helpers/__date.php');
include('helpers/__country.php');

$this->tree=__rootpath($_SERVER['REDIRECT_URL']);
$this->menu  = "club";
$this->submenu = 'club';
$this->title = 'Clube';

if(!isset($this->request['id'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: '.App::url().'club/'.strtolower($_SESSION['SL_club']).'/');

switch ($this->request['subrequest']) {
  case 'overview':
    echo 'mdsaklmkldsa';
    break;
  default:
    $club = new Club($this->get['id']);
    $club->__load();
    $status=$club->status;
    $this->data['club'] = $club;
    $this->data['club']->created = __date($this->data['club']->created);
    $this->data['club']->country = getCountryByID($this->data['club']->id_country);

    $clubinfo = new ClubInfo($club);
    $clubinfo->__load();
    $this->data['clubinfo'] = $clubinfo;

    // var_dump($this->data['club']);
    // var_dump($this->data['clubinfo']);
    break;
}
$this->addCSSFile('club.css');
$this->addCSSFile('trophies.css');
$this->addJSFile('trophies.js');
