<main>
  <div class='content grid-container'>
    <div class='grid-65'>
      <h3 class='title'><?=$this->data['leagueName']?> - (<?=$this->data['division'];?>.<?=$this->data['group'];?>) <i class='padding-top flag icon <?=$this->data['country']?>'></i></h3>
    </div>
    <div class='grid-35 padding-top right options'>
      <a href='/league/<?=$this->request['country']?>/<?=$this->request['div']?>/<?=$this->request['group']?>' class='btn bg-success letter-small'>Classificação</a>
      <a href='calendar' class='btn bg-success letter-small'>Histórico</a>
    </div>
    <div class='grid-100'>
      <?
      $mes=0;
      $dia=0;
      foreach ($this->data['matches'] as $match) {
        $date=explode('-',$match['date']);
        if($mes!=$date[1]){
          if($mes!=0){
            echo '</tbody></table></div></div>';
          }
          $mes=$date[1];
          ?>
          <div class='box'>
            <div class='box-title'><?=$mes?>/2016</div>
            <div class='box-content'>
        <?
          }
        ?>
            <?

              if($dia!=$date[2]){
                  if($dia!=0){
                    echo '</tbody></table>';
                  }
                  $dia=$date[2];
              ?>
              <table class='center noborder'>
                <thead>
                  <tr><th colspan="3">Dia <?=$dia?></th></tr>
                </thead>
                <tbody>
              <?
              }
              ?>
                <tr>
                  <td width='45%'><?=$match['homeTeam']?></td>
                  <td width='10%'>vs</td>
                  <td width='45%'><?=$match['awayTeam']?></td>
                </tr>
        <?
      }
      ?>
    </div>
  </div>
</main>
