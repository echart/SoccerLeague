<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-2 box tactics'>
  		<div class='box-content'>
        <div class='field'>
          <div class='lines f-field'>
            <div class='line l'><div class='t-shirt'></div></div>
            <div class='line c'></div>
            <div class='line r'></div>
          </div>
          <div class='lines om-field'></div>
          <div class='lines m-field'></div>
          <div class='lines dm-field'></div>
          <div class='lines d-field'></div>
          <div class='lines gk-field'></div>
        </div>
  		</div>
  	</div>
    <div class='bit-2 box'>
      <div class='box-title'>
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
  		</div>
  	</div>
    <div class='bit-2 box'>
      <div class='box-title'>
        Jogadores
      </div>
  		<div class='box-content players-list'>
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
            foreach ($this->data['players']['line'] as $player) {
              $n = explode(' ', $player->name);
              ?>
              <tr target-id='<?=$player->id_player?>' target-name='<?=$n[0]?>'>
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
