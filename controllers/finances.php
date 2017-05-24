<?
$this->menu  = "club";
$this->submenu = 'finances';
$this->title = 'Finanças';
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$id_club = $_SESSION['SL_club'];

switch($this->request['method']){
  case 'season':
    JsonOutput::jsonHeader();
    $query = Connection::getInstance()->connect()->prepare("SELECT money FROM club_finances_weekly WHERE id_club=:id_club order by week asc");
    $query->bindParam(':id_club',$_SESSION['SL_club']);
    $query->execute();
    $finance = array();
    $i = 0;
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
      $finance[$i] = $data['money'];
      $i++;
    }
    echo JsonOutput::success(array('season'=>$finance));
    exit;
  break;
  case 'wages':
    include('helpers/__country.php');
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
      $this->data['players'][$i]['id_country'] = $player->id_country;
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
    $this->finance['week']['maintenance'] = number_format($finance->maintenance,2,',','.');
    $this->finance['week']['constructions'] = number_format($finance->constructions,2,',','.');
    $this->finance['week']['interests'] = number_format($finance->interests,2,',','.');
    $this->finance['week']['transfers'] = number_format($finance->transfers,2,',','.');
    $this->finance['week']['total'] = number_format($finance->total,2,',','.');

    $this->finance['week']['income'] = $finance->tv + $finance->tickets+ $finance->merchandise+ $finance->food+ $finance->sponsor;
    $this->finance['week']['outcome'] = $finance->constructions+ $finance->maintenance+ $finance->wage;

    $finance->season();
    $this->finance['season']['money'] = number_format($finance->money,2,',','.');
    $this->finance['season']['tv'] = number_format($finance->tv,2,',','.');
    $this->finance['season']['tickets'] = number_format($finance->tickets,2,',','.');
    $this->finance['season']['merchandise'] = number_format($finance->merchandise,2,',','.');
    $this->finance['season']['food'] = number_format($finance->food,2,',','.');
    $this->finance['season']['sponsor'] = number_format($finance->sponsor,2,',','.');
    $this->finance['season']['wage'] = number_format($finance->wage,2,',','.');
    $this->finance['season']['maintenance'] = number_format($finance->maintenance,2,',','.');
    $this->finance['season']['constructions'] = number_format($finance->constructions,2,',','.');
    $this->finance['season']['interests'] = number_format($finance->interests,2,',','.');
    $this->finance['season']['transfers'] = number_format($finance->transfers,2,',','.');
    $this->finance['season']['total'] = number_format($finance->total,2,',','.');



    $this->addJSFile('graphs/finances.week.js');
    $this->addJSFile('graphs/finances.season.js');

  break;
}
