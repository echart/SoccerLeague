<div class='content'>
  <h1 class='page-title'><?=$this->title?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='box'>
        <div class='box-title'>Jogadores em leilão</div>
        <div class='box-content'>
          <table>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Posição</th>
                <th>Idade</th>
                <th>País</th>
                <th>SI</th>
                <th>REC</th>
                <th>Expira</th>
                <th>Valor</th>
              </tr>
            </thead>
            <tbody>
              <?
              foreach($this->transfer as $player){
                $enddate = DateTime::createFromFormat("Y-m-d H:i:s",$player['transfer']['enddate']);
                ?>
              <tr>
                <td>
                  <span class="tooltip tooltip-effect-1" player='<?=$player['player']->id_player;?>'>
                    <span class="tooltip-item"><a href="<?=$this->tree?>players/<?=$player['player']->id_player;?>"><?=$player['player']->name;?></a></span>
                      <span class="tooltip-content clearfix">
                          <span class="tooltip-text">Carregando...</span>
                      </span>
                  </span>
                </td>
                <td>
                  <? foreach ($player['player']->position as $position) { ?>
                    <span class='position-<?=$position['position'];?>'><?=$position['position']." " . $position['side'];?></span>
                    <? } ?>
                </td>
                <td><?=$player['player']->age?></td>
                <td><img width='16px' src='<?=$this->tree?>assets/img/icons/flags/<?$c=getCountryByID($player['player']->id_country);echo $c['country']?>.png'></td>
                <td><?=$player['player']->skill_index?></td>
                <td><?=_rec($player['player']->rec, App::url());?></td>
                <td><?=$enddate->format('d/m/Y H:i:s');?></td>
                <td><?=number_format($player['transfer']['value'],2,',','.');?></td>
              </tr>
              <?}?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
