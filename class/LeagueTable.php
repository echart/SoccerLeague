<?

class LeagueTable{
  public $id_league;
  public $id_match;
  public $results=array();

  public function __construct($id_league){
    $this->id_league=$id_league;
  }

  public function addMatch($id_match){
    $this->id_match=$id_match;
  }

  public function addMatchResult($homeGoals,$awayGoals){
    $query = Connection::getInstance()->connect()->prepare("SELECT home,away FROM matches WHERE id_match=:id_match");
    $query->bindParam(":id_match",$this->id_match);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    $home=$data['home'];
    $away=$data['away'];

    $query= Connection::getInstance()->connect()->prepare("SELECT * FROM league_table where id_league=:id_league and id_club=:id_club");
    $query->bindParam(":id_club",$home);
    $query->bindParam(":id_league",$this->id_league);
    $query->execute();
    $home=$query->fetch(PDO::FETCH_ASSOC);
    $query= Connection::getInstance()->connect()->prepare("SELECT * FROM league_table where id_league=:id_league and id_club=:id_club");
    $query->bindParam(":id_club",$away);
    $query->bindParam(":id_league",$this->id_league);
    $query->execute();
    $away=$query->fetch(PDO::FETCH_ASSOC);

    if($homeGoals>$awayGoals){
      $home['pts']+=3;
      $home['win']+=1;
      $home['win_home']+=1;
      $home['goalsp']+=$homeGoals;
      $home['goalsp_home']+=$homeGoals;
      $home['goalsc']+=$awayGoals;
      $home['goalsc_home']+=$awayGoals;
      $home['saldo']=$home['goalsp']-$home['goalsc'];

      $away['pts']+=0;
      $away['loss']+=1;
      $away['loss_away']+=1;
      $away['goalsp']+=$awayGoals;
      $away['goalsp_away']+=$awayGoals;
      $away['goalsc']+=$homeGoals;
      $away['goalsc_away']+=$homeGoals;
      $away['saldo']=$away['goalsp']-$away['goalsc'];

    }else if($awayGoals>$homeGoals){
      $home['pts']+=0;
      $home['loss']+=1;
      $home['loss_home']+=1;
      $home['goalsp']+=$homeGoals;
      $home['goalsp_home']+=$homeGoals;
      $home['goalsc']+=$awayGoals;
      $home['goalsc_home']+=$awayGoals;
      $home['saldo']=$home['goalsp']-$home['goalsc'];

      $away['pts']+=3;
      $away['win']+=1;
      $away['win_away']+=1;
      $away['goalsp']+=$awayGoals;
      $away['goalsp_away']+=$awayGoals;
      $away['goalsc']+=$homeGoals;
      $away['goalsc_away']+=$homeGoals;
      $away['saldo']=$away['goalsp']-$away['goalsc'];

    }else{
      $home['pts']+=1;
      $home['draw']+=1;
      $home['goalsp']+=$homeGoals;
      $home['goalsp_home']+=$homeGoals;
      $home['goalsc']+=$awayGoals;
      $home['goalsc_home']+=$awayGoals;

      $away['pts']+=1;
      $away['draw']+=1;
      $home['goalsp']+=$awayGoals;
      $home['goalsp_away']+=$awayGoals;
      $home['goalsc']+=$homeGoals;
      $home['goalsc_away']+=$homeGoals;
    }
    $query= Connection::getInstance()->connect()->prepare("UPDATE league_table SET saldo=:saldo,pts=:pts, win=:win, win_home=:win_home, win_away=:win_away, loss=:loss, loss_home=:loss_home, loss_away=:loss_away,draw=:draw, goalsp=:goalsp, goalsp_home=:goalsp_home, goalsp_away=:goalsp_away, goalsc=:goalsc, goalsc_home=:goalsc_home,goalsc_away=:goalsc_away where id_club=:id_club and id_league=:id_league");
    $query->bindParam(":pts",$home['pts']);
    $query->bindParam(":win",$home['win']);
    $query->bindParam(":win_home",$home['win_home']);
    $query->bindParam(":win_away",$home['win_away']);
    $query->bindParam(":loss_away",$home['loss_away']);
    $query->bindParam(":loss",$home['loss']);
    $query->bindParam(":loss_home",$home['loss_home']);
    $query->bindParam(":draw",$home['draw']);
    $query->bindParam(":goalsp",$home['goalsp']);
    $query->bindParam(":goalsc",$home['goalsc']);
    $query->bindParam(":goalsp_home",$home['goalsp_home']);
    $query->bindParam(":goalsc_home",$home['goalsc_home']);
    $query->bindParam(":goalsp_away",$home['goalsp_away']);
    $query->bindParam(":goalsc_away",$home['goalsc_away']);
    $query->bindParam(":id_club",$home['id_club']);
    $query->bindParam(":saldo",$home['saldo']);
    $query->bindParam(":id_league",$this->id_league);
    $query->execute();

    $query= Connection::getInstance()->connect()->prepare("UPDATE league_table SET saldo=:saldo,pts=:pts, win=:win, win_home=:win_home, win_away=:win_away, loss=:loss, loss_home=:loss_home, loss_away=:loss_away,draw=:draw, goalsp=:goalsp, goalsp_home=:goalsp_home, goalsp_away=:goalsp_away, goalsc=:goalsc, goalsc_home=:goalsc_home,goalsc_away=:goalsc_away where id_club=:id_club and id_league=:id_league");
    $query->bindParam(":pts",$away['pts']);
    $query->bindParam(":win",$away['win']);
    $query->bindParam(":win_home",$away['win_home']);
    $query->bindParam(":win_away",$away['win_away']);
    $query->bindParam(":loss_away",$away['loss_away']);
    $query->bindParam(":loss",$away['loss']);
    $query->bindParam(":loss_home",$away['loss_home']);
    $query->bindParam(":draw",$away['draw']);
    $query->bindParam(":goalsp",$away['goalsp']);
    $query->bindParam(":goalsc",$away['goalsc']);
    $query->bindParam(":goalsp_home",$away['goalsp_home']);
    $query->bindParam(":goalsc_home",$away['goalsc_home']);
    $query->bindParam(":goalsp_away",$away['goalsp_away']);
    $query->bindParam(":goalsc_away",$away['goalsc_away']);
    $query->bindParam(":saldo",$away['saldo']);
    $query->bindParam(":id_club",$away['id_club']);
    $query->bindParam(":id_league",$this->id_league);
    $query->execute();
  }

  public function updateLeagueTable(){
    $query = Connection::getInstance()->connect()->prepare("SELECT id_club FROM league_table where id_league=:id_league ORDER BY pts asc, saldo asc, win asc, redcards desc, goalsp asc");
    $query->bindParam(":id_league",$this->id_league);
    $query->execute();
    $i=18;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $query2 = Connection::getInstance()->connect()->prepare("UPDATE league_table SET position=:i where id_league=:id_league and id_club=:id_club");
      $query2->bindParam(":id_league",$this->id_league);
      $query2->bindParam(":id_club",$data['id_club']);
      $query2->bindParam(":i",$i);
      $query2->execute();
      $i--;
      $query2 = Connection::getInstance()->connect()->prepare("SELECT round FROM league where id_league=:id_league");
      $query2->bindParam(":id_league",$this->id_league);
      $query2->execute();
      $data=$query2->fetch(PDO::FETCH_ASSOC);
      $query2 = Connection::getInstance()->connect()->prepare("UPDATE league set round=:round where id_league=:id_league");
      $round = $data['round']+1;
      $query2->bindParam(":round",$round);
      $query2->bindParam(":id_league",$this->id_league);
      $query2->execute();
    }
  }
}
