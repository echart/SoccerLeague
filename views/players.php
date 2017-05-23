<? include('../helpers/__country.php');?>
<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1 box filters'>
      <div class='box-title color'>
  			Filtros
  		</div>
  		<div class='box-content'>
        <div class='form-field'>
          <label for="">Posições:</label>
          <input type="radio" name="pos" value="all" checked> <span class='position'> Todas</span>
          <input type="radio" name="pos" value="def"> <span class='position-D'>DEF</span>
          <input type="radio" name="pos" value="mid"> <span class='position-DM'>MEI</span>
          <input type="radio" name="pos" value="atk"> <span class='position-F'>ATA</span>
          <input type="radio" name="pos" value="gk"> <span class='position-GK'>GK</span>
        </div>
        <div class='form-field'>
          <label for="visible-attr">Atributos:</label>
          <select id='visible-attr' name="visible-attr">
            <option value="gen">Geral</option>
            <option value="phi">Físico</option>
            <option value="psi">Psicológico</option>
            <option value="tec">Técnico</option>
          </select>
        </div>
      </div>
    </div>
    <div class='bit-1 box right'>
  		<div class='box-title color'>
  			Jogadores
  		</div>
  		<div class='box-content'>
        <table id='overal' class='table-responsive'>
          <thead>
            <tr>
              <th><abbr title="Camiseta">#</abbr></th>
              <th data-sort="string"><abbr title="Nome">Nome</abbr></th>
              <th data-sort="string" class='gen'>Posição</th>
              <th class='gen'><abbr title="País">País</abbr></th>
              <th class='gen' data-sort="float">Idade</th>
              <th class='gen' width='120px'><abbr title='Recomendação'>REC</abbr></th>
              <th class='gen' data-sort="float"><abbr title='Indice de Habilidades'>SI</abbr></th>
              <th class='gen'><abbr title='Salário'>Salário</abbr></th>
              <th class='phi' data-sort="int"><abbr title='Força'>For</abbr></th>
              <th class='phi' data-sort="int"><abbr title='Velocidade'>Vel</abbr></th>
              <th class='phi' data-sort="int"><abbr title='Resistência'>Res</abbr></th>
              <th class='phi' data-sort="int"><abbr title='Salto'>Sal</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Empenho'>Emp</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Posicionamento'>Pos</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Concentração'>Con</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Decisão'>Dec</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Visão'>Vis</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Imprevisibilidade'>Imp</abbr></th>
              <th class='psi' data-sort="int"><abbr title='Comunicação'>Com</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Marcação'>Mar</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Desarme'>Des</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Cruzamento'>Cru</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Passe'>Pas</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Técnica'>Tec</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Controle de Bola'>B.Con</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Drible'>Dri</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Chute Longo'>Lon</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Finalização'>Fin</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Cabeceio'>Cab</abbr></th>
              <th class='tec' data-sort="int"><abbr title='Bola parada'>B.Par</abbr></th>
            </tr>
          </thead>
          <tbody>
            <? foreach ($this->data['players']['line'] as $player) { ?>
            <tr class='center'>
              <td class='left' width='10px'></td>
              <td class='padding-right left'>
                <span class="tooltip tooltip-effect-1" player='<?=$player->id_player;?>'>
                  <span class="tooltip-item"><a href="<?=$this->tree?>players/<?=$player->id_player;?>"><?=$player->name;?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </td>
              <td class='border gen positions'>
                <? foreach ($player->position as $position) { ?>
                  <span class='position-<?=$position['position'];?>'><?=$position['position']." " . $position['side'];?></span>
                  <? } ?>
              </td>
              <td class='border gen'>
                <img width='18px' src='<?=$this->tree?>assets/img/icons/flags/<? $c = getCountryByID($player->id_country); echo $c['country']?>.png'>
              </td>
              <td class='gen border'><?=$player->age;?></td>
              <td class='gen border'><?=_rec($player->rec, App::url())?></td>
              <td class='gen border'><?=$player->skill_index;?></td>
              <td class='border gen'>
                $ <?=$player->wage()?>
              </td>
              <td class='phi'><?=$player->stamina;?></td>
              <td class='phi'><?=$player->speed;?></td>
              <td class='phi'><?=$player->resistance;?></td>
              <td class='phi border'><?=$player->jump;?></td>
              <td class='psi'><?=$player->workrate;?></td>
              <td class='psi'><?=$player->positioning;?></td>
              <td class='psi'><?=$player->concentration;?></td>
              <td class='psi'><?=$player->decision;?></td>
              <td class='psi'><?=$player->vision;?></td>
              <td class='psi'><?=$player->unpredictability;?></td>
              <td class='psi border'><?=$player->communication;?></td>
              <td class='tec'><?=$player->marking;?></td>
              <td class='tec border'><?=$player->tackling;?></td>
              <td class='tec'><?=$player->crossing;?></td>
              <td class='tec'><?=$player->pass;?></td>
              <td class='tec'><?=$player->technical;?></td>
              <td class='tec'><?=$player->ballcontrol;?></td>
              <td class='tec border'><?=$player->dribble;?></td>
              <td class='tec'><?=$player->longshot;?></td>
              <td class='tec'><?=$player->finish;?></td>
              <td class='tec'><?=$player->heading;?></td>
              <td class='tec'><?=$player->freekick;?></td>
            </tr>
            <?
            }
            ?>
          </tbody>
        </table>
  		</div>
  	</div>
    <div class='bit-1 box right'>
  		<div class='box-title color'>
  			Goleiros
  		</div>
  		<div class='box-content'>
        <div class='filters'>
        </div>
        <table id='overal' class='table-responsive'>
          <thead>
            <tr>
              <th><abbr title="Camiseta">#</abbr></th>
              <th data-sort="string"><abbr title="Nome">Nome</abbr></th>
              <th class='gen'>Posição</th>
              <th class='gen'><abbr title='País'>País</abbr></th>
                <th class='gen' data-sort="float">Idade</th>
                <th class='gen' width='120px'><abbr title='Recomendação'>REC</abbr></th>
                <th class='gen' data-sort="float"><abbr title='Indice de Habilidades'>SI</abbr></th>
                <th class='gen'><abbr title='Salário'>Salário</abbr></th>
                <th class='phi' data-sort='int'><abbr title='Força'>For</abbr></th>
                <th class='phi' data-sort='int'><abbr title='Velocidade'>Vel</abbr></th>
                <th class='phi' data-sort='int'><abbr title='Resistência'>Res</abbr></th>
                <th class='phi' data-sort='int'><abbr title='Salto'>Sal</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Empenho'>Emp</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Posicionamento'>Pos</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Concentração'>Con</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Decisão'>Dec</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Visão'>Vis</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Imprevisibilidade'>Imp</abbr></th>
                <th class='psi' data-sort='int'><abbr title='Comunicação'>Com</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Habilidade Manual'>H.Man</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Habilidade aérea'>Aer</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Habilidade com os pés'>Pés</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Mano a mano'>MaM</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Reflexo'>Ref</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Saída do gol'>Sai</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Chute'>Chu</abbr></th>
                <th class='tec' data-sort='int'><abbr title='Arremesso'>Arr</abbr></th>
            </tr>
          </thead>
          <tbody>
            <? foreach ($this->data['players']['gk'] as $player) { ?>
            <tr class='center'>
              <td class='left' width='10px'></td>
              <td class='padding-right left'>
                <span class="tooltip tooltip-effect-1" player='<?=$player->id_player;?>'>
                  <span class="tooltip-item"><a href="<?=$this->tree?>players/<?=$player->id_player;?>"><?=$player->name;?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                </span>
              </td>
              <td class='border gen positions'>
                <? foreach ($player->position as $position) { ?>
                  <span class='position-<?=$position['position'];?>'><?=$position['position'];?></span>
                <? } ?>
              </td>
              <td class='border gen'>
                <img width='18px' src='<?=$this->tree?>assets/img/icons/flags/<? $c = getCountryByID($player->id_country); echo $c['country']?>.png'>
              </td>
              <td class='gen border'><?=$player->age;?></td>
              <td class='gen border'><?=_rec($player->rec,App::url())?></td>
              <td class='gen border'><?=$player->skill_index;?></td>
              <td class='border gen'>
                $ <?=$player->wage()?>
              </td>
              <td class='phi'><?=$player->stamina;?></td>
              <td class='phi'><?=$player->speed;?></td>
              <td class='phi'><?=$player->resistance;?></td>
              <td class='phi border'><?=$player->jump;?></td>
              <td class='psi'><?=$player->workrate;?></td>
              <td class='psi'><?=$player->positioning;?></td>
              <td class='psi'><?=$player->concentration;?></td>
              <td class='psi'><?=$player->decision;?></td>
              <td class='psi'><?=$player->vision;?></td>
              <td class='psi'><?=$player->unpredictability;?></td>
              <td class='psi border'><?=$player->communication;?></td>
              <td class='tec'><?=$player->handling;?></td>
              <td class='tec'><?=$player->aerial;?></td>
              <td class='tec'><?=$player->foothability;?></td>
              <td class='tec'><?=$player->oneanone;?></td>
              <td class='tec'><?=$player->reflexes;?></td>
              <td class='tec'><?=$player->rushingout;?></td>
              <td class='tec'><?=$player->kicking;?></td>
              <td class='tec'><?=$player->throwing;?></td>
            </tr>
            <?
            }
            ?>
          </tbody>
        </table>
  		</div>
  	</div>
  </div>
</div>
