<?php
  include('../class/Connection.php');
  include('../class/Player.php');
  include('../class/Goalkeeper.php');
  include('../class/PlayerFactory.php');
  include('../helpers/random.php');

  $odds=array();
  $odds[1]=15.1;
  $odds[2]=10.1;
  $oddds[3]=5;
  /**
   * GOALKEEPERS
   */
  for ($i=0; $i < 4; $i++) {
    // $gk = PlayerFactory::createGoalkeper();
    // $gk->stamina=random(10.1,20.0);
    // $gk->speed=random(10.1,20.0);
    // $gk->jump=random(10.1,20.0);
    // $gk->resistance=random(10.1,20.0);
    // $gk->injury_prop=random(10.1,20.0);
    // $gk->professionalism=random(10.1,20.0);
    // $gk->agressive=random(10.1,20.0);
    // $gk->adaptability=random(10.1,20.0);
    // $gk->leadership=random(10.1,20.0);
    // $gk->learning=random(10.1,20.0);
    // $gk->workrate=random(10.1,20.0);
    // $gk->concentration=random(10.1,20.0);
    // $gk->decision=random(10.1,20.0);
    // $gk->positioning=random(10.1,20.0);
    // $gk->vision=random(10.1,20.0);
    // $gk->unpredictability=random(10.1,20.0);
    // $gk->communication=random(10.1,20.0);
    // $gk->handling=random(10.1,20.0);
    // $gk->aerial=random(10.1,20.0);
    // $gk->foothability=random(10.1,20.0);
    // $gk->oneaone=random(10.1,20.0);
    // $gk->reflexes=random(10.1,20.0);
    // $gk->rushingout=random(10.1,20.0);
    // $gk->kicking=random(10.1,20.0);
    // $gk->throwing=random(10.1,20.0);
  }
  /**
   * LINEPLAYERS
   */
   $sum=0;
  for ($i=0; $i <25 ; $i++) {
    $indice=$odds[1];
    $player = PlayerFactory::createPlayer($indice);
  }
