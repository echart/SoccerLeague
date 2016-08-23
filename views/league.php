<main>
  <div class='content grid-container'>
    <div class='grid-65'>
      <h3 class='title'><?=$this->data['leagueName']?> - (<?=$this->data['division'];?>.<?=$this->data['group'];?>) <i class='padding-top icon <?=$this->data['leagueTable'][0]['country']?>'></i></h3>
    </div>
    <div class='grid-35 padding-top right'>
      <button class='btn bg-success letter-small'>Estatisticas</button>
      <button class='btn bg-success letter-small'>Histórico</button>
    </div>
    <div class='grid-65'>
      <div class='box'>
        <div class='box-title'>Classificação</div>
        <div class='box-content'>
        <table class='zebra bordered'>
          <!-- <caption>Campeonato Brasileiro</caption> -->
          <thead>
            <tr>
              <th>Pos</th>
              <th>Clube</th>
              <th>Jogos</th>
              <th>V</th>
              <th>E</th>
              <th>D</th>
              <th>GP</th>
              <th>GC</th>
              <th>S</th>
              <th>Pontos</th>
            </tr>
          </thead>
          <tbody>
            <?
            for($i=0;$i<18;$i++){?>
            <tr class='<?=$this->data['leagueTable'][$i]['class']?>'>
              <td class='center border <?=$this->data['leagueTable'][$i]['status']?>'><?=$i+1?></td>
              <td class='border'> <a href='<?=$this->data['tree']?>club/<?=$this->data['leagueTable'][$i]['id_club']?>'><?=$this->data['leagueTable'][$i]['clubname']?></a></td>
              <td class='center border'><?=$this->data['leagueTable'][$i]['round']?></td>
              <td class='center'><?=$this->data['leagueTable'][$i]['win']?></td>
              <td class='center'><?=$this->data['leagueTable'][$i]['draw']?></td>
              <td class='center border'><?=$this->data['leagueTable'][$i]['loss']?></td>
              <td class='center'><?=$this->data['leagueTable'][$i]['goalsp']?></td>
              <td class='center'><?=$this->data['leagueTable'][$i]['goalsc']?></td>
              <td class='center border'><?=$this->data['leagueTable'][$i]['goalsp']-$this->data['leagueTable'][$i]['goalsc']?></td>
              <td class='center'><?=$this->data['leagueTable'][$i]['pts']?></td>
            </tr>
            <?}?>
          </tbody>
          <tfoot></tfoot>
        </table>
      </div>
    </div>
    </div>
    <div class='grid-35'>
      <div class='box'>
        <div class='box-title'>Próxima rodada</div>
        <div class='box-content'>
          <p class='center no-padding'>Ainda não há jogos a serem jogados</p>
        </div>
      </div>
    </div>
  </div>
</main>
