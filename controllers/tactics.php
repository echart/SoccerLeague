<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$this->menu  = "squad";
$this->submenu = 'tactics';
$this->title = 'Táticas';


switch ($this->get['method']) {
  case 'save':
    $players_on_field = $this->post['players_on_field'];
    $players_on_reserve = $this->post['players_on_reserve'];
    $functions = $this->post['players_on_function'];
    $styles = $this->post['styles'];
    $conditional_orders = $this->post['conditional_orders'];

    $club = new Club($_SESSION['SL_club']);
    $tactics = new Tactics($club);
    if($tactics->__save($players_on_field,$players_on_reserve,$functions,$styles, $conditional_orders)==true){
      echo JsonOutput::success(array('success'));
    }else{
      echo JsonOutput::error('','error');
    }
    exit;
    break;
  case 'load':
    $club = new Club($_SESSION['SL_club']);
    $tactics = new Tactics($club);
    $data = $tactics->__load();
    echo JsonOutput::success($data);
    exit;
  break;
  default:
    $this->addCSSFile('tactics.css');
    $this->addJSFile('table.sort.js');
    $this->addJSFile('players.filters.js');
    $this->addJSFile('tactics.js');
    break;
}
