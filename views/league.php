<div class='content'>
  <?
  if($this->data['league']['nonexists']==true){ ?>
    <h1 class='page-title'>Resultado não encontrado</h1>
  <?
  exit;
  }else{ ?>
    <h1 class='page-title'><img class='country-icon' src='<?=$this->tree?>assets/img/icons/flags/Brazil.png' width="30px"><?=$this->title?> (<?=$this->data['league']['div']?>.<?=$this->data['league']['group']?>)</h1>
  <? } ?>
  <div class='byte'>
    <div class='bit-70 box'>
  		<div class='box-title color'>
  			Classificação
  		</div>
  		<div class='box-content'>
        <!-- <select name=''>
          <option value="">Geral</option>
          <option value="">Casa</option>
          <option value="">Fora de casa</option>
        </select> -->
        <table id='overal'>
          <!-- <caption>Campeonato Brasileiro</caption> -->
          <thead>
            <tr>
              <th><abbr title="Posição">Pos</abbr></th>
              <th><abbr title="Clube">Clube</abbr></th>
              <th><abbr title="Jogos">J</abbr></th>
              <th class='hide-on-small'><abbr title="Vitórias">V</abbr></th>
              <th><abbr title="Empates">E</abbr></th>
              <th><abbr title="Derrotas">D</abbr></th>
              <th><abbr title="Gols Pró">GP</abbr></th>
              <th><abbr title="Gols contra">GC</abbr></th>
              <th><abbr title="Saldo">S</abbr></th>
              <th><abbr title="Pontos ganhos">Pts</abbr></th>
            </tr>
          </thead>
          <tbody>
            <?
            foreach ($this->data['league']['table'] as $i => $leaguerow) { ?>
            <tr>
              <td><?=$i+1?></td>
              <td></a>
                <span class="tooltip tooltip-effect-1" club='<?=$leaguerow['id_club']?>'>
                  <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$leaguerow['id_club']?>'><?=$leaguerow['clubname']?></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </td>
              <td><?=$leaguerow['played']?></td>
              <td><?=$leaguerow['win']?></td>
              <td><?=$leaguerow['draw']?></td>
              <td><?=$leaguerow['loss']?></td>
              <td><?=$leaguerow['goalsp']?></td>
              <td><?=$leaguerow['goalsc']?></td>
              <td><?=$leaguerow['goalsp']-$leaguerow['goalsc'];?></td>
              <td><?=$leaguerow['pts']?></td>
            </tr>
            <? } ?>
          </tbody>
        </table>
  		</div>
  	</div>
    <div class='bit-30 box right'>
  		<div class='box-title color'>
  			Rodada anterior
  		</div>
  		<div class='box-content'>
  			<div class='bit-1 last-games'>

        </div>
  		</div>
  	</div>
    <div class='bit-30 box right'>
  		<div class='box-title color'>
  			Próxima rodada
  		</div>
  		<div class='box-content'>
  			<div class='bit-1 next-games'>

        </div>
  		</div>
  	</div>
  </div>
</div>
