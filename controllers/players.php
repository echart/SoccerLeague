<?
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Players - SoccerLeague';

if(isset($this->request['id']))
  $this->data['title']='FULANO DA SILVA SAURO - SoccerLeague';
