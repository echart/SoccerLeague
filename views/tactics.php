<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-2 box tactics'>
  		<div class='box-content'>
        <div class='field'></div>
  		</div>
  	</div>
    <div class='bit-2 box'>
      <div class='box-title'>
        Filtros
      </div>
  		<div class='box-content'>
        filtros
  		</div>
  	</div>
    <div class='bit-2 box'>
      <div class='box-title'>
        Jogadores
      </div>
  		<div class='box-content'>
        <table class='table'>
          <thead>
            <tr>
              <th data-sort='string'>Nome</th>
              <th data-sort='string'><abbr title='Posição'>Pos</abbr></th>
              <th data-sort='float'>SI</th>
              <th><abbr title='Condição'>C</abbr></th>
            </tr>
          </thead>
          <tbody>
            <?
            foreach ($this->data['players']['line'] as $player) { ?>
            <tr>
              <td><?=$player->name?></td>
              <td>
                <? foreach ($player->position as $position) { ?>
                  <span class='position-<?=$position['position'];?>'><?=$position['position']." " . $position['side'];?></span>
                <? } ?>
              </td>
              <td><?=$player->skill_index;?></td>
              <td></td>
            </tr>
            <?}?>
          </tbody>
        </table>
  		</div>
  	</div>
  </div>
</div>
