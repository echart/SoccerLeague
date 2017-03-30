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

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_trophies WHERE id_club=:id_club");
    $query->bindParam(':id_club',$this->get['id']);
    $query->execute();

    $i=0;
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $competition = new competition($data->id_competition);
      $competition->__load();
      $this->data['clubtrophies'][$i]['type'] = Competition::getCompetitionType($competition->id_competition_type);
      $this->data['clubtrophies'][$i]['season'] = $competition->season;
      if(Competition::getCompetitionType($competition->id_competition_type)=='L'){
        // $query = Connection::getInstance()->connect()->prepare("select division, group from league inner join league_table using(id_league) where id_competition = 1 and id_club = 1");
        $league = new League($this->)
      }
      var_dump($this->data['clubtrophies']);
      $i++;
    }
    // var_dump($this->data['club']);
    // var_dump($this->data['clubinfo']);
    break;
}
$this->addCSSFile('club.css');
$this->addCSSFile('trophies.css');
$this->addJSFile('trophies.js');
