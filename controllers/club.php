<?


if(!isset($this->request['id'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: '.App::url().'club/'.strtolower($_SESSION['SL_club']).'/');

switch ($this->request['subrequest']) {
  case 'overview':
    error_reporting(E_ALL);
    include($this->tree . 'helpers/__country.php');
    include($this->tree . 'helpers/_rec.php');
    $this->tree=__rootpath($_SERVER['REDIRECT_URL']);
    $this->menu  = "club";
    $this->submenu = 'club';
    $this->title = 'Clube';
    $this->requestURL='club_overview';

    $this->data['overview']['stats']['SI']=0;
    $this->data['overview']['stats']['REC']=0;
    $this->data['overview']['stats']['age']=0;
    $this->data['overview']['stats']['players']=0;
    /*
    Goalkeeper
    */
    $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players inner join players_position using(id_player) where id_player_club=:id_club and id_position=1 group by id_player order by id_player");
    $query->bindParam(":id_club",$this->get['id']);
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $player = Player::__this($data->id_player);
      $player->__loadinfo();
      $player->__loadskills();
      $player->__loadhistory();
      $player->__loadpositions();
      $player->skillIndex();
      $this->data['players'][]=$player;
      $this->data['overview']['stats']['SI']+=$player->skill_index;
      $this->data['overview']['stats']['REC']+=$player->rec;
      $this->data['overview']['stats']['age']+=$player->age;
      $this->data['overview']['stats']['players']+=1;
    }

    $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players inner join players_position using(id_player) where id_player_club=:id_club and id_position!=1 group by id_player order by id_player");
    $query->bindParam(":id_club",$this->get['id']);
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $player = Player::__this($data->id_player);
      $player->__loadinfo();
      // $player->__loadhistory();
      $player->__loadpositions();
      $player->skillIndex();
      $this->data['players'][]=$player;
      $this->data['overview']['stats']['SI']+=$player->skill_index;
      $this->data['overview']['stats']['REC']+=$player->rec;
      $this->data['overview']['stats']['age']+=$player->age;
      $this->data['overview']['stats']['players']+=1;
    }
    $this->addCSSFile('responsive.table.css');
    $this->addJSFile('responsive.table.js');
    break;
  default:
    include($this->tree . 'helpers/__date.php');
    include($this->tree . 'helpers/__country.php');
    $this->tree=__rootpath($_SERVER['REDIRECT_URL']);
    $this->menu  = "club";
    $this->submenu = 'club';
    $this->title = 'Clube';
    $club = new Club($this->get['id']);
    $club->__load();
    $status=$club->status;
    $this->data['club'] = $club;
    $this->data['club']->created = __date($this->data['club']->created);
    $this->data['club']->country = getCountryByID($this->data['club']->id_country);
    $query = Connection::getInstance()->connect()->prepare("SELECT division, divgroup, leaguename from competition inner join league using(id_competition) inner join league_table using(id_league) where id_club = :id_club and season = 1 and official = true");
    $query->bindParam(':id_club',$this->get['id']);
    $query->execute();
    $l = $query->fetch(PDO::FETCH_OBJ);
    $this->data['club']->league['division'] = $l->division;
    $this->data['club']->league['divgroup'] = $l->divgroup;
    $this->data['club']->league['leaguename'] = $l->leaguename;

    $clubinfo = new ClubInfo($club);
    $clubinfo->__load();
    $this->data['clubinfo'] = $clubinfo;

    /*
    TROPHIES LOGIC
    */
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_trophies WHERE id_club=:id_club");
    $query->bindParam(':id_club',$this->get['id']);
    $query->execute();

    $i=0;
    if($query->rowCount()>0){
      while($data=$query->fetch(PDO::FETCH_OBJ)){
        $competition = new competition($data->id_competition);
        $competition->__load();
        $this->data['clubtrophies'][$i]['type'] = Competition::getCompetitionType($competition->id_competition_type);
        $this->data['clubtrophies'][$i]['season'] = $competition->season;
        if(Competition::getCompetitionType($competition->id_competition_type)=='L'){
          $query = Connection::getInstance()->connect()->prepare("SELECT division, divgroup from league inner join league_table using(id_league) where id_competition =:id_competition and id_club = :id_club");
          $query->bindParam(':id_competition',$competition->id_competition);
          $query->bindParam(':id_club',$this->get['id']);
          $query->execute();
          $data = $query->fetch(PDO::FETCH_OBJ);
          $league = new League($competition->id_competition, $data->division, $data->divgroup);
          $league->__loadIDleague();
          $league->__load();
          $this->data['clubtrophies'][$i]['name'] = $league->name;
          $this->data['clubtrophies'][$i]['season'] = $competition->season;
          $this->data['clubtrophies'][$i]['type'] = 'league';
        }
        $i++;
      }
    }else{
      $this->data['clubtrophies'] = null;
    }
    /*
    VISITS LOGIC
    */
    if(Visits::howManyClubsVisitMe($this->get['id'])>0){
      $visitors=Visits::getLastVisitors($this->get['id']);
      foreach ($visitors as $key => $value){
        $this->data['visitors'][$key]['id']=$value;
        $this->data['visitors'][$key]['clubname'] =  Club::getClubNameById($value);
        $this->data['visitors'][$key]['country'] = getCountryByID(Club::getClubCountryById($value));
      }
    }else{
      $this->data['visitors'] = null;
    }
    /*
    FRIENDS LOGIC
    */
    if(Buddy::isPending($_SESSION['SL_club'],$club->id_club)){
      $this->data['friend']['text']='Solicitação Pendente';
      $this->data['friend']['action']='unbuddy';
    }else if(Buddy::isPending($club->id_club,$_SESSION['SL_club'])){
      $this->data['friend']['text']='Aceitar amigo';
      $this->data['friend']['action']='aproval';
    }else if(Buddy::isMyFriend($_SESSION['SL_club'],$club->id_club) or Buddy::isMyFriend($club->id_club,$_SESSION['SL_club'])){
      $this->data['friend']['text']='Desfazer amizade';
      $this->data['friend']['action']='unbuddy';
    }else{
      $this->data['friend']['text']='Fazer novo amigo';
      $this->data['friend']['action']='request';
    }
    /* REQUIRES */
    $this->addCSSFile('modal.css');
    $this->addCSSFile('feed.css');
    $this->addJSFile('modal.js');
    $this->addJSFile('feed.js');
    $this->addCSSFile('club.css');
    $this->addCSSFile('trophies.css');
    $this->addJSFile('trophies.js');
    $this->addJSFile('buddy.js');
    $this->addJSFile('club.search.js');
    break;
}
