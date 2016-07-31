<?
$this->data['menu']='club';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$club = $this->request['id'] ?? $_SESSION['SL_club'];
/**
 * IF ID ISNT SET IN URL, SET.
 */
if(!isset($this->request['id']))
  header('location: http://'.$_SERVER['SERVER_NAME'].'/club/'.$club);

$this->data['title']=Club::getClubNameById($club);
$this->data['clubname']=Club::getClubNameById($club);
/**
 * based on subrequest url make the order.
 */
if(isset($this->request['subrequest'])){
  if($this->request['subrequest']=='overview'){

  }else if($this->request['subrequest']=='history'){

  }else if($this->request['subrequest']=='matches'){

  }else if($this->request['subrequest']=='statistics'){

  }
}else{
  $this->addCSSfile('club.css');
  $this->data['clubinfo']=ClubInfo::get($club);
  if((!isset($this->data['clubinfo']['logo'])) or $this->data['clubinfo']['logo']=='null'){
    $this->data['clubinfo']['logo']='default.png';
  }
  if((!isset($this->data['clubinfo']['clubcolor'])) or $this->data['clubinfo']['clubcolor']=='null'){
    $this->data['clubinfo']['clubcolor']='#5FAD56';
  }
  $data=League::getLeagueById(Club::getClubLeague($club));
  $this->data['clubinfo']['league']=$data['name'].' ('.$data['division'].'.'.$data['divgroup'].')';
  if((!isset($this->data['clubinfo']['manager'])) or $this->data['clubinfo']['manager']==null){
    $this->data['clubinfo']['manager']='The Manager';
  }
  if((!isset($this->data['clubinfo']['history'])) or $this->data['clubinfo']['history']=='null'){
    $this->data['clubinfo']['history']='Não há história pra contar :(';
  }
  $this->data['clubinfo']['buddies']=Buddy::howManyBuddies($club) . ' amigo(s)';
  $this->data['leagueURL']='league/'.$data['abbreviation'].'/'.$data['division'].'/'.$data['divgroup'];
}
