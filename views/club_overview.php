<main>
  <div class="content grid-container">
    <h3 class='title'>Visão geral da equipe</h3>
    <div class='grid-65'>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content write'>
          <table class='players zebra bordered'>
            <thead>
              <tr>
                <th class='left'></th>
                <th class='left'>Nome</th>
                <th class='left'>Posição</th>
                <th class='left'>Idade</th>
                <th class='left'>REC</th>
                <th class='left'>SI</th>
              </tr>
            </thead>
            <tbody>
              <?
              if(count($this->data['overview']['line'])==0){
                echo '<tr><td colspan="6">Nenhum jogador</td>';
              }else{
                foreach ($this->data['overview']['line'] as $key) {
                  echo '<tr><td>#</td><td>'.$key['name'].'</td><td>'.$key['position'].'</td><td>'.$key['age'].'</td><td>'.$key['rec'].'</td><td>x</td>';
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
        <div class='box-title'>Informações</div>
        <div class='box-content write'>
          dsadsdsa
        </div>
      </div>
    </div>
  </div>
</main>
