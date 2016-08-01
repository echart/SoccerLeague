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

  }else if($this->request['subrequest']=='edit'){
    $this->data['title']='Editar Clube';
    if($_SESSION['SL_club']!=$club){
      echo 'Esse clube não é seu';exit;
    }
    $this->requestURL='editclub';
    $this->data['clubinfo']=ClubInfo::get($club);
  }
}else{
  $this->addCSSfile('club.css');
  $this->addJSfile('buddy.js');

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
  $this->data['clubinfo']['fans']= number_format(ClubFans::howManyFans($club),0,',','.');
  $this->data['clubinfo']['fansname']=ClubFans::getFansName($club);

  if(Buddy::isPending($_SESSION['SL_club'],$club)){
    $this->data['button']['friend']['text']='Solicitação Pendente';
    $this->data['button']['friend']['action']='unMakeBuddy';
  }else if(Buddy::isPending($club,$_SESSION['SL_club'])){
    $this->data['button']['friend']['text']='Aceitar amigo';
    $this->data['button']['friend']['action']='aproval';
  }else if(Buddy::isMyFriend($_SESSION['SL_club'],$club)){
    $this->data['button']['friend']['text']='Desfazer amizade';
    $this->data['button']['friend']['action']='unbuddy';
  }else{
    $this->data['button']['friend']['text']='Fazer novo amigo';
    $this->data['button']['friend']['action']='request';
  }
}
