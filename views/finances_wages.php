<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-2'>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content'>
          <table class='table'>
            <thead>
              <tr>
                <th></th>
                <th>Semanal</th>
                <th>Temporada</th>
              </tr>
            </thead>
            <tbody>
              <?foreach($this->data['players'] as $player){?>
                <tr>
                  <td><span class="tooltip tooltip-effect-1" player='<?=$player['id_player'];?>'>
                    <span class="tooltip-item"><a href="<?=$this->tree?>players/<?=$player['id_player'];?>"><?=$player['name'];?></a> <img width='18px' src='<?=$this->tree?>assets/img/icons/flags/<? $c = getCountryByID($player['id_country']); echo $c['country'];?>.png'></span>
                      <span class="tooltip-content clearfix">
                          <span class="tooltip-text">Carregando...</span>
                      </span>
                  </span></td>
                  <td>$ <?=$player['wageWeek']?></td>
                  <td>$ <?=$player['wageSeason']?></td>
                </tr>
              <?}?>
              <tr>
                <td><strong>Total</strong></td>
                <td>$ <?=$this->data['totalwageWeek']?></td>
                <td>$ <?=$this->data['totalwageSeason']?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class='bit-2'>
      <div class='box'>
        <div class='box-title'>Comissão técnica</div>
        <div class='box-content'>
          <table class='table'>
            <thead>
              <tr>
                <th></th>
                <th>Semanal</th>
                <th>Temporada</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
