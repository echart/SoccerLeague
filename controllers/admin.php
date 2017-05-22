<?
$this->tree=__rootpath($_SERVER['REDIRECT_URL']);
$this->menu='admin';
$this->submenu='admin';

switch ($this->get['method']) {
  case 'statistics':
    $this->title='Estatisticas';
    $this->requestURL='admin_statistics';
    $this->addCSSFile('admin_stats.css');

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM countries");
    $query->execute();
    $this->country = $query->rowCount();

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club");
    $query->execute();
    $this->club = $query->rowCount();

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_account inner join club using(id_club) where status='A'");
    $query->execute();
    $this->account = $query->rowCount();

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM competition where season='1' AND id_competition_type='1'");
    $query->execute();
    $this->leagues = $query->rowCount();

    break;
  default:
    header('Location: statistics/');
    break;
}
