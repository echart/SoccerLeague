<?
$this->menu  = "club";
$this->submenu = 'finances';
$this->title = 'Finanças';
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$id_club = $_SESSION['SL_club'];

switch($this->request['method']){
  case 'wages':
    $this->requestURL = 'finances_wages';
    $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players where id_player_club=:id_club group by id_player order by id_player");
    $query->bindParam(":id_club",$_SESSION['SL_club']);
    $query->execute();
    $i=0;
    $this->data['totalwageWeek']=0;
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $player = Player::__this($data->id_player);
      $player->__loadinfo();
      $player->wage();
      $this->data['players'][$i]['id_player']=$player->id_player;
      $this->data['players'][$i]['name']=$player->name;
      $wage = $player->wage();
      $this->data['totalwageWeek'] += $wage;
      $wageseason = $wage*12;
      $this->data['players'][$i]['wageWeek']=number_format($wage,2,',','.');
      $this->data['players'][$i]['wageSeason']=number_format($wageseason,2,',','.');
      $i++;
    }
    $this->data['totalwageSeason'] = number_format($this->data['totalwageWeek']*12,2,',','.');
    $this->data['totalwageWeek'] = number_format($this->data['totalwageWeek'],2,',','.');
  break;
  case 'maitenance':
  break;
  default :
    $finance = new ClubFinances(new Club($id_club));
    $finance->week();

    $this->finance['week']['money'] = number_format($finance->money,2,',','.');
    $this->finance['week']['tv'] = number_format($finance->tv,2,',','.');
    $this->finance['week']['tickets'] = number_format($finance->tickets,2,',','.');
    $this->finance['week']['merchandise'] = number_format($finance->merchandise,2,',','.');
    $this->finance['week']['food'] = number_format($finance->food,2,',','.');
    $this->finance['week']['sponsor'] = number_format($finance->sponsor,2,',','.');
    $this->finance['week']['wage'] = number_format($finance->wage,2,',','.');
    $this->finance['week']['constructions'] = number_format($finance->constructions,2,',','.');
    $this->finance['week']['interests'] = number_format($finance->interests,2,',','.');

  break;
}
