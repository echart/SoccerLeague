<?php
  require_once('../class/Connection.php');
  require_once('../class/Player.php');
  require_once('../class/Goalkeeper.php');
  require_once('../class/PlayerFactory.php');
  require_once('../helpers/random.php');

  /**
   * GOALKEEPERS
   */
  for ($i=0; $i < 4; $i++) {
  }
  /**
   * LINEPLAYERS
   */
   $sum=0;
  for ($i=0; $i <32 ; $i++) {
    $indice=1;
    $player = PlayerFactory::createPlayer($indice,1);
    PlayerFactory::savePlayer($player);
  }

  echo 'added players!!!!! yay';
