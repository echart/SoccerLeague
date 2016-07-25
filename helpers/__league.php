<?

function __leagueStatus($division,$i){
  if($division==1){
    if($i<=3){
      return 'promotion';
    }else if($i>=11 AND $i<=14){
      return 'playoff-relegation';
    }else if($i<=18 AND $i>=15){
      return 'relegation';
    }
  }else{
    if($i<=3){
      return 'promotion';
    }else if($i>=4 AND $i<=6){
      return 'playoff-promotion';
    }else if($i>=11 AND $i<=14){
      return 'playoff-relegation';
    }else if($i<=18 AND $i>=15){
      return 'relegation';
    }
  }
}
