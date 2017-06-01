<?
class Soccer{
  public $minute = 0;
  public $matchengine;
  public function __construct(MatchEngine $matchengine){
    $this->matchengine = $matchengine;
  }

  public function play(){
    $this->matchengine->matchStats->homegoals=0;
    $this->matchengine->matchStats->awaygoals=0;
    $this->matchengine->matchReport->addReport(1,'start','');
    while($this->minute<90){
      $this->minute++;
      if($this->thereIsAction()){
        $who_is = rand(1,100);
        $attack = ($who_is<56) ? 'home':'away';
        $deffensive = ($who_is<56) ? 'away':'home';
        $approach = $this->approach_type();
        if($approach == 'penalty'){
          $playerATK = $this->matchengine->players[$attack][$this->matchengine->tactics[$attack]['players_functions']->penalty];
          $playerDEF = $this->matchengine->players[$deffensive]['gk'][$this->matchengine->tactics[$deffensive]['players_on_field']->gk];
          $this->matchengine->matchReport->addReport($this->minute,'startPenalty',$playerATK->name);
          $this->matchengine->matchReport->addReport($this->minute,'midPenalty',$playerATK->name);
          if($attack=='home'){
            $this->matchengine->matchStats->homepenalty++;
          }else{
            $this->matchengine->matchStats->awaypenalty++;
          }
          //finalizacao, bola parada, concentração, decisao, imprevisibilidade, tecnica
          //mano a mano,h.man,reflexo, concentração, decisao,salto
          //25, 25, 15, 15, 10, 10
          $a = ($playerATK->finish*25)/20;
          $b = ($playerATK->freekick*25)/20;
          $c = ($playerATK->concentration*15)/20;
          $d = ($playerATK->decision*15)/20;
          $e = ($playerATK->unpredictability*15)/20;
          $f = ($playerATK->technical*10)/20;
          $atk = $a+$b+$c+$d+$e+$f+rand(1,30);
          $a = ($playerDEF->oneaone*25)/20;
          $b = ($playerDEF->handling*25)/20;
          $c = ($playerDEF->reflexes*15)/20;
          $d = ($playerDEF->concentration*15)/20;
          $e = ($playerDEF->decision*10)/20;
          $f = ($playerDEF->aerial*10)/20;
          $def = $a+$b+$c+$d+$e+$f+rand(1,50);

          if($atk>$def){
            $this->matchengine->matchReport->addReport($this->minute,'penaltySuccess',$playerATK->name);
            $this->matchengine->matchReport->addReport($this->minute,'goal',$playerATK->name);
            if($attack=='home'){
              $this->matchengine->matchStats->homepenaltysuccess++;
              $this->matchengine->matchStats->homegoals++;
            }else{
              $this->matchengine->matchStats->awaypenaltysuccess++;
              $this->matchengine->matchStats->awaygoals++;
            }
          }else{
            $this->matchengine->matchReport->addReport($this->minute,'penaltyError',$playerATK->name);
          }
        // }else if($approach == 'fault'){
        // }else if($approach == 'corner'){
        //
        // }else{
        }else{
          //35, 35, 10, 10, 10
            if($attack=='home'){
              $playerATK = $this->matchengine->players['home'][$this->matchengine->tactics['home']['players_on_field']];
              $playerDEF = $this->matchengine->players['away'][$this->matchengine->tactics['home']['players_on_field']];
            }else{
              $playerATK = $this->matchengine->players['away'][$this->matchengine->tactics['home']['players_on_field']];
              $playerDEF = $this->matchengine->players['home'][$this->matchengine->tactics['home']['players_on_field']];
            }
          if($approach == 'dribble'){
            $this->matchengine->matchReport->addReport($this->minute,'startPlay',$playerATK->name);
            //drible,imprevisibilidade, tecnica, velocidade, concentracao
            // marcacao, desarme, velocidade, decisao, força
            $a = ($playerATK->dribble*35)/20;
            $b = ($playerATK->unpredictability*35)/20;
            $c = ($playerATK->technical*10)/20;
            $d = ($playerATK->speed*19)/20;
            $e = ($playerATK->concentration*10)/20;
            $atk = $a+$b+$c+$d+$e+rand(1,30);
            $a = ($playerDEF->marking*35)/20;
            $b = ($playerDEF->tackling*35)/20;
            $c = ($playerDEF->speed*10)/20;
            $d = ($playerDEF->decision*10)/20;
            $e = ($playerDEF->stregth*10)/20;
            $def = $a+$b+$c+$d+$e+rand(1,50);
            if($atk>$def){
              $this->matchengine->matchReport->addReport($this->minute,'dribbleSuccess',$playerATK->name);
              if($attack=='home'){
                $playerATK = $this->matchengine->players['home'][$this->matchengine->tactics['home']['players_on_field']];
                $playerDEF = $this->matchengine->players['away'][$this->matchengine->tactics['home']['players_on_field']];
              }else{
                $playerATK = $this->matchengine->players['away'][$this->matchengine->tactics['home']['players_on_field']];
                $playerDEF = $this->matchengine->players[$deffensive]['gk'][$this->matchengine->tactics[$deffensive]['players_on_field']->gk];
              }
                $a = ($playerATK->dribble*35)/20;
                $b = ($playerATK->unpredictability*35)/20;
                $c = ($playerATK->technical*10)/20;
                $d = ($playerATK->speed*19)/20;
                $e = ($playerATK->concentration*10)/20;
                $atk = $a+$b+$c+$d+$e+rand(1,30);
                $a = ($playerDEF->marking*35)/20;
                $b = ($playerDEF->tackling*35)/20;
                $c = ($playerDEF->speed*10)/20;
                $d = ($playerDEF->decision*10)/20;
                $e = ($playerDEF->stregth*10)/20;
                $def = $a+$b+$c+$d+$e+rand(1,50);
                if($atk>$def){
                  $this->matchengine->matchReport->addReport($this->minute,'goal',$playerATK->name);
                  if($attack=='home'){
                    $this->matchengine->matchStats->homepenaltysuccess++;
                    $this->matchengine->matchStats->homegoals++;
                  }else{
                    $this->matchengine->matchStats->awaypenaltysuccess++;
                    $this->matchengine->matchStats->awaygoals++;
                  }
                }else{
                  $this->matchengine->matchReport->addReport($this->minute,'error',$playerATK->name);
                }
            }else{
              $this->matchengine->matchReport->addReport($this->minute,'tackling',$playerATK->name);
            }
          }
        }
      }
    }
    $this->matchengine->matchReport->addReport(91,'end','');
  }
  public function thereIsAction(){
    $vai_ter_lance = rand(0,100);
    if($vai_ter_lance<80){
      return true;
    }else{
      return false;
    }
  }
  public function trouble(){
    return rand(1,3);
  }
  public function approach_type(){
    $x = rand(1,100);
    if($x <= 2){
      return 'penalty';
    }else if($x <= 15){
      return 'fault';
    }else if($x <= 30){
      return 'corner';
    }else if($x <= 100){
      $x = rand(1,100);
      if($x<61){
        return 'pass';
      }else if($x<81){
        return 'cross';
      }else{
        return 'dribble';
      }
    }
  }
}
