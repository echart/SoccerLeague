<?

require_once('helpers/__country.php');
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'squad';

if(isset($this->request['id'])){

  $this->addCSSFile('player.css');
  $this->requestURL='player';
}else{

}
