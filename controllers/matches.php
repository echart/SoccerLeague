<?
$this->title = 'Partida';
$this->menu = 'matches';
$this->submenu = 'matches';
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);

$this->addCSSFile('matches.css');

$this->match = new Match($this->request['id']);
$this->match->__load();
$this->matchStats = new MatchStats($this->match);
$this->matchStats->__load();
$this->report = new MatchReport($this->match);
$this->report->__load();

// var_dump($this->report->report);

$this->report->report = json_decode($this->report->report);
