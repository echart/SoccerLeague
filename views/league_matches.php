<div class='content'>
  <h1 class='page-title'><?=$this->title?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></h1>
  <div class='byte'>
    <div class='bit-30'>
      <div class='box bit-1'>
        <div class='box-title'>Opções</div>
        <div class='box-content'>
          <div class='club-options'>
            <ul class='subnav'>
              <li><a href="<?=$this->tree?>league"><img src="<?=$this->tree?>assets/img/icons/world-cup.png" width="32px"><span>Tabela</span></a></li>
              <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/team-of-the-round"><img src="<?=$this->tree?>assets/img/icons/strategy.png" width="32px"><span>Time da rodada</span></a></li>
              <li><a class='selected' href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/calendar"><img src="<?=$this->tree?>assets/img/icons/calendar.png" width="32px"><span>Rodadas</span></a></li>
              <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/statistics"><img src="<?=$this->tree?>assets/img/icons/statistics.png" width="32px"><span>Estatísticas</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class='bit-70'>
      <div class='box'>
        <?
        $m = 0;
        foreach ($this->data['matches'] as $match) {
          setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
          date_default_timezone_set( 'America/Sao_Paulo' );
          $date = new DateTime($match['day']);
          $flag = false;
          if($date->format('Y-m-d')<date('Y-m-d')){
            $query = Connection::getInstance()->connect()->prepare('SELECT homegoals,awaygoals FROM matches_stats where id_match = :id_match');
            $query->bindParam(':id_match',$match['id_match']);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            $goals['home'] = $data['homegoals'];
            $goals['away'] = $data['awaygoals'];
            $flag = true;
          }
          if($m!=$date->format('m')){
            if($m!=0){
          ?>
              </table>
            </div>
            <?
            }
            ?>
            <? $m = $date->format('m'); ?>
            <div class='box-title'>
              <?=ucfirst(utf8_encode(strftime( '%B', $date->getTimestamp())));?>
            </div>
            <div class='box-content'>
              <table class='table is-bordered center'>
                <tr><th>Mandante</th><th width='10%'></th><th>Visitante</th><th>Competição</th><th>Dia</th></tr>
          <?
          }
          ?>
            <tr>
              <td width='35%'>
                <span class="tooltip tooltip-effect-1" club='<?=$match['home']?>'>
                  <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$match['home']?>'><?=Club::getClubNameById($match['home']);?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </td>
              <td class='center'>
                <? if($flag==false){?><a href='<?=$this->tree?>matches/<?=$match['id_match']?>'>Ver</a><?}else{?><a href='<?=$this->tree?>matches/<?=$match['id_match']?>'><?=$goals['home']?> x <?=$goals['away']?></a><?}?>
              </td>
              <td width='35%'>
                <span class="tooltip tooltip-effect-1" club='<?=$match['away']?>'>
                  <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$match['away']?>'><?=Club::getClubNameById($match['away']);?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </td>
              <td><?if($match['type']=='L'){echo 'Liga Nacional';}?></td>
              <td><?=$date->format('d/m/Y')?></td>
            </tr>
            <?
          if($m!=$date->format('m')){
            $m = $date->format('m');
            ?>
              </table>
            </div>
          <?
          }
          }
          ?>
      </div>
    </div>
  </div>
</div>
