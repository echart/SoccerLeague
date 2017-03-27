<div class='content'>
  <?
  if(isset($this->data['nonexists'])){ ?>
    <h1 class='page-title'>Resultado não encontrado</h1>
  <?
  exit;
  }?>
  <div class='byte'>
    <div class='bit-1 box right'>
  		<div class='box-content player-info'>
          <div class='player-face'>
            <div class='player-body'>
              <div class='player-eyes'></div>
              <div class='player-hair'></div>
              <div class='player-bear'></div>
            </div>
          </div>
          <div class='player-options'>
            <!-- <button type="button" class='btn btn-large btn-full btn-success'>Fazer oferta</button> -->
            <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/money.png' width='16px'>Vender jogador</button>
            <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/sell.png' width='16px'>Definir preço</button>
            <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/scout.png' width='16px'>Mandar olheiro</button>
            <!-- <button type="button" class='btn btn-medium btn-full btn-light'>+ Lista de observação</button> -->
            <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/cancel.png' width='16px'>Rejeitar ofertas</button>
            <button type="button" class='btn btn-medium btn-full btn-danger'><img src='<?=$this->tree?>assets/img/icons/trash.png' width='16px'>Demitir jogador</button>
          </div>
          <div class='player-profile'>
            <h1><?=$this->data['player']->name?><img src='<?=$this->tree?>assets/img/icons/flags/Brazil.png' width="24px"></h1>
            <?
            if($this->data['player']->nickname!=''){ ?>
            <h2>'<?=$this->data['player']->nickname?>' <a href='#'>Mudar apelido</a></h2>
            <? }else{ ?>
              <h2> <a href='#'>Definir apelido</a></h2>
            <? } ?>
            <div class='info'>
              <p><strong>Clube:</strong> <span class="tooltip tooltip-effect-1" club='<?=$this->data['player']->id_club?>'>
                  <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->data['player']->id_club?>'><?=$this->data['player']->clubname?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </p>
              <p><strong>Salário:</strong> $500.000</p>
              <p><strong>Idade:</strong> <?=$this->data['player']->age?> anos</p>
              <p><strong>Peso/Altura:</strong>  <?=$this->data['player']->weight?>kg/<?=$this->data['player']->height?>cm</p>
              <p><strong>Índice de Habilidade:</strong> <?=$this->data['player']->skill_index?></p>
              <!-- <p><strong>REC:</strong> 4.73</p> -->
            </div>
	       </div>
       </div>
     </div>
      <div class='bit-1 box player-stats'>
        <div class='box-title'>Habilidades</div>
        <div class="box-content">
          <table style='text-align:center' class='table is-striped skills'>
            <thead>
              <tr>
                <th class='phi'><abbr title='Força'>For</abbr></th>
                <th class='phi'><abbr title='Velocidade'>Vel</abbr></th>
                <th class='phi'><abbr title='Resistência'>Res</abbr></th>
                <th class='phi'><abbr title='Salto'>Sal</abbr></th>
                <th class='psi'><abbr title='Empenho'>Emp</abbr></th>
                <th class='psi'><abbr title='Posicionamento'>Pos</abbr></th>
                <th class='psi'><abbr title='Concentração'>Con</abbr></th>
                <th class='psi'><abbr title='Decisão'>Dec</abbr></th>
                <th class='psi'><abbr title='Visão'>Vis</abbr></th>
                <th class='psi'><abbr title='Imprevisibilidade'>Imp</abbr></th>
                <th class='psi'><abbr title='Comunicação'>Com</abbr></th>
              </tr>
            </thead>
            <tbody>
              <td class='phi'><?=$this->data['player']->stamina;?></td>
              <td class='phi'><?=$this->data['player']->speed;?></td>
              <td class='phi'><?=$this->data['player']->resistance;?></td>
              <td class='phi border'><?=$this->data['player']->jump;?></td>
              <td class='psi'><?=$this->data['player']->workrate;?></td>
              <td class='psi'><?=$this->data['player']->positioning;?></td>
              <td class='psi'><?=$this->data['player']->concentration;?></td>
              <td class='psi'><?=$this->data['player']->decision;?></td>
              <td class='psi'><?=$this->data['player']->vision;?></td>
              <td class='psi'><?=$this->data['player']->unpredictability;?></td>
              <td class='psi border'><?=$this->data['player']->communication;?></td>
            </tbody>
            <?
            if($this->data['player']->position[0]['position']=='GK'){?>
            <thead>
              <tr>
                <th class='tec'>H.Man</th>
                <th class='tec'>Aer</th>
                <th class='tec'>Pés</th>
                <th class='tec'>MaM</th>
                <th class='tec'>Ref</th>
                <th class='tec'>Sai</th>
                <th class='tec'>Chu</th>
                <th class='tec'>Arr</th>
                <th colspan="3"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class='tec'><?=$this->data['player']->handling;?></td>
                <td class='tec'><?=$this->data['player']->aerial;?></td>
                <td class='tec'><?=$this->data['player']->foothability;?></td>
                <td class='tec'><?=$this->data['player']->oneanone;?></td>
                <td class='tec'><?=$this->data['player']->reflexes;?></td>
                <td class='tec'><?=$this->data['player']->rushingout;?></td>
                <td class='tec'><?=$this->data['player']->kicking;?></td>
                <td class='tec'><?=$this->data['player']->throwing;?></td>
              </tr>
              <?
              }else{
              ?>
                <thead>
                  <tr>
                    <th class='tec'>Mar</th>
                    <th class='tec'>Des</th>
                    <th class='tec'>Cru</th>
                    <th class='tec'>Pas</th>
                    <th class='tec'>Tec</th>
                    <th class='tec'>B.Con</th>
                    <th class='tec'>Dri</th>
                    <th class='tec'>Lon</th>
                    <th class='tec'>Fin</th>
                    <th class='tec'>Cab</th>
                    <th class='tec'>B.Par</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class='tec'><?=$this->data['player']->marking;?></td>
                    <td class='tec border'><?=$this->data['player']->tackling;?></td>
                    <td class='tec'><?=$this->data['player']->crossing;?></td>
                    <td class='tec'><?=$this->data['player']->pass;?></td>
                    <td class='tec'><?=$this->data['player']->technical;?></td>
                    <td class='tec'><?=$this->data['player']->ballcontrol;?></td>
                    <td class='tec border'><?=$this->data['player']->dribble;?></td>
                    <td class='tec'><?=$this->data['player']->longshot;?></td>
                    <td class='tec'><?=$this->data['player']->finish;?></td>
                    <td class='tec'><?=$this->data['player']->heading;?></td>
                    <td class='tec'><?=$this->data['player']->freekick;?></td>
                  </tr>
                  <?
              }
              ?>
            </tbody>
          </table>
        </div>
  </div>
  <div class='bit-60 box'>
    <div class="box-title">
      Histórico
    </div>
    <div class="box-content">
      <table>
        <thead>
          <tr>
            <th><abbr title='Temporada'>T</abbr></th>
            <th>Clube</th>
            <th><abbr title='Jogos'>J</abbr></th>
            <th><abbr title='Gols'><!--<img src='<?=$this->tree?>assets/img/icons/ball.png' width='18px'>-->G</abbr></th>
            <th><abbr title='Assistências'>A</abbr></th>
            <th><abbr title='Cartões Amarelos'>CA</abbr></th>
            <th><abbr title='Cartões Vermelhos'>CR</abbr></th>
            <th><abbr title='Melhor jogador da partida'>MVP</abbr></th>
            <th><abbr title='Nota média'>N</abbr></th>
          </tr>
        </thead>
        <tbody>
          <? foreach ($this->data['history'] as $history) { ?>
          <tr>
            <td><?=$history->season?></td>
            <td><?=$history->club?></td>
            <td><?=$history->games?></td>
            <td><?=$history->goals?></td>
            <td><?=$history->assists?></td>
            <td><?=$history->yellowcards?></td>
            <td><?=$history->redcards?></td>
            <td><?=$history->mvp?></td>
            <td><?=$history->rating?></td>
          </tr>
          <?
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class='bit-40 box'>
    <div class="box-title">
      Posições
    </div>
    <div class="box-content">

    </div>
  </div>
</div>
<script type="text/javascript">
  bear = <?=$this->data['player']->bear;?>;
  eyes = <?=$this->data['player']->eyes;?>;
  body = <?=$this->data['player']->body;?>;
  hair = <?=$this->data['player']->hair;?>;
  physical = <?=$this->data['player']->physical();?>;
  technical = <?=$this->data['player']->technical();?>;
  psychologic = <?=$this->data['player']->psychologic();?>;
</script>
