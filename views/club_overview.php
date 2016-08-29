<style>table tbody tr td{padding:2.5px 10px}</style>
<main>
  <div class="content grid-container">
    <h3 class='title'>Plantel de <?=$this->data['clubname']?></h3>
    <div class='grid-65'>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content bg-white write'>
          <table class='players zebra bordered'>
            <thead>
              <tr>
                <!-- <th class='left'></th> -->
                <th class='left'>Nome</th>
                <th class='center'>Posição</th>
                <th class='center'>Idade</th>
                <th class='center' width='120px'>REC</th>
                <th class='center'>SI</th>
              </tr>
            </thead>
            <tbody>
              <?
              if(count($this->data['overview']['line'])==0 AND count($this->data['overview']['gk'])==0){
                echo '<tr><td colspan="6">Nenhum jogador</td>';
              }else{
                foreach ($this->data['overview']['gk'] as $key) {
                  
                  echo '<tr class="center"><td class="left"><a href="'.$this->data['tree'].'players/'.$key['id_player'].'">'.$key['name'].'</a></td><td><span class="helper '.$key['area'].'">'.$key['position'].'</span></td><td>'.$key['age'].'</td><td>rec['.$key['REC'].']</td><td>'.$key['SI'].'</td>';
                }
                foreach ($this->data['overview']['line'] as $key) {
                  echo '<tr class="center"><td class="left"><a href="'.$this->data['tree'].'players/'.$key['id_player'].'">'.$key['name'].'</a></td><td><span class="helper '.$key['area'].'">'.$key['position'].'</span></td><td>'.$key['age'].'</td><td>rec['.$key['REC'].']</td><td>'.$key['SI'].'</td>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="grid-35 grid-parent">
      <div class='box'>
        <div class='box-title'>Dados do Plantel</div>
        <div class='box-content bg-white write'>
          <p><strong>Nº de jogadores: </strong> <?=$this->data['overview']['stats']['players']?></p>
          <p><strong>Média de idade: </strong> <?=number_format($this->data['overview']['stats']['age']/$this->data['overview']['stats']['players'],2)?></p>
          <p><strong>SI total: </strong> <?=$this->data['overview']['stats']['SI']?></p>
          <p><strong>Média de SI: </strong> <?=number_format($this->data['overview']['stats']['SI']/$this->data['overview']['stats']['players'],2)?></p>
          <p><strong>Total de Recomendação: </strong> <?=$this->data['overview']['stats']['REC']?></p>
          <p><strong>Média de Recomendação: </strong> <?=number_format($this->data['overview']['stats']['REC']/$this->data['overview']['stats']['players'],2)?></p>
        </div>
      </div>
    </div>
  </div>
</main>
