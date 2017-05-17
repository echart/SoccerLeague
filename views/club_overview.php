<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-30'>
      <div class='box bit-1'>
        <div class='box-title'>Opções</div>
        <div class='box-content'>
          <div class='club-options'>
            <ul class='subnav'>
              <li><a href="<?=$this->tree?>league"><img src="<?=$this->tree?>assets/img/icons/home.png" width="32px"><span>Sede</span></a></li>
              <li><a class='selected' href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>/overview/"><img src="<?=$this->tree?>assets/img/icons/strategy.png" width="32px"><span>Visão geral</span></a></li>
              <li><a href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>/matches/"><img src="<?=$this->tree?>assets/img/icons/calendar.png" width="32px"><span>Partidas</span></a></li>
              <li><a href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>/stadium/"><img src="<?=$this->tree?>assets/img/icons/stadium.png" width="32px"><span>Estádio</span></a></li>
              <!-- <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/statistics"><img src="<?=$this->tree?>assets/img/icons/statistics.png" width="32px"><span>Estatísticas</span></a></li> -->
            </ul>
          </div>
        </div>
      </div>
      <div class='bit-1 box'>
        <div class='box-title'>
          Estatisticas
        </div>
        <div class='box-content'>
          <p><strong>Nº de jogadores: </strong> <?=$this->data['overview']['stats']['players']?></p>
            <p><strong>Média de idade: </strong> <?=number_format($this->data['overview']['stats']['age']/$this->data['overview']['stats']['players'],2)?></p>
            <p><strong>SI total: </strong> <?=$this->data['overview']['stats']['SI']?></p>
            <p><strong>Média de SI: </strong> <?=number_format($this->data['overview']['stats']['SI']/$this->data['overview']['stats']['players'],2)?></p>
            <p><strong>Total de Recomendação: </strong> <?=$this->data['overview']['stats']['REC']?></p>
            <p><strong>Média de Recomendação: </strong> <?=number_format($this->data['overview']['stats']['REC']/$this->data['overview']['stats']['players'],2)?></p>
        </div>
      </div>
    </div>
    <div class='bit-70'>
      <div class='bit-1 box'>
        <div class='box-title'>
          Visão Geral
        </div>
        <div class='box-content'>
          <table id='overal' class='table-responsive'>
            <thead>
              <tr>
                <th><abbr title="Camiseta">#</abbr></th>
                <th data-sort="string"><abbr title="Nome">Nome</abbr></th>
                <th data-sort="string" class='gen'>Posição</th>
                <th class='gen' data-sort="float">Idade</th>
                <th class='gen' width='120px'><abbr title='Recomendação'>REC</abbr></th>
                <th class='gen' data-sort="float"><abbr title='Indice de Habilidades'>SI</abbr></th>
              </tr>
            </thead>
            <tbody>
              <? foreach ($this->data['players']as $player) { ?>
              <tr class='center'>
                <td class='left' width='10px'></td>
                <td class='padding-right left'>
                  <span class="tooltip tooltip-effect-1" player='<?=$player->id_player;?>'>
                    <span class="tooltip-item"><a href="<?=$this->tree?>players/<?=$player->id_player;?>"><?=$player->name;?> <img width='18px' src='<?=$this->tree?>assets/img/icons/flags/<? $c = getCountryByID($player->id_country); echo $c['country']?>.png'</a></span>
                      <span class="tooltip-content clearfix">
                          <span class="tooltip-text">Carregando...</span>
                      </span>
                  </span>
                </td>
                <td class='border gen positions'>
                  <? foreach ($player->position as $position) { ?>
                    <span class='position-<?=$position['position'];?>'><?=$position['position']." " . $position['side'];?></span>
                  <? }
                 ?>
                </td>
                <td class='gen border'><?=$player->age;?></td>
                <td class='gen border'><?=_rec($player->rec, App::url())?></td>
                <td class='gen border'><?=$player->skill_index;?></td>
                <? }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
