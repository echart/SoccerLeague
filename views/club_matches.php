<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='box'>
        <?
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        $m = 0;
        foreach ($this->data['matches'] as $match) {
          setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
          date_default_timezone_set( 'America/Sao_Paulo' );
          $date = new DateTime($match['day']);
          if($date->format('Y-m-d')<date('Y-m-d')){
            $query = Connection::getInstance()->connect('SELECT homegoas,awaygoals FROM matches where id_match = :id_match');
            $query->bindParam('');
            $goals['home'] = ;
            $goals['away'] = ;
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
                <tr><th>Mandante</th><th></th><th>Visitante</th><th>Competição</th><th>Dia</th></tr>
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
                <a href='<?=$this->tree?>matches/<?=$match['id_match']?>'>Ver</a>
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
