<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$this->menu  = "squad";
$this->submenu = 'tactics';
$this->title = 'Táticas';


switch ($this->get['method']) {
  case 'save':
    $players_on_field = $this->post['players_on_field'];
    $players_on_reserve = $this->post['players_on_reserve'];
    $functions = $this->post['functions'];
    $styles = $this->post['styles'];
    $conditional_orders = $this->post['conditional_orders'];

    $club = new Club($_SESSION['SL_club']);
    $tactics = new Tactics($club);

    if($tactics->__save($players_on_field,$players_on_reserve,$functions,$styles, $conditional_orders)==true){

    }else{

    }

    exit;
    break;
  default:
    $this->addCSSFile('tactics.css');
    $this->addJSFile('table.sort.js');
    $this->addJSFile('players.filters.js');
    $this->addJSFile('tactics.js');
    break;
}
