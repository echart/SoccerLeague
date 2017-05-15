<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='bit-2 box players'>
        <div class='box-title'>
          Jogadores
        </div>
        <div class='box-content players-list'>
          <div class='filters'>
            <label for="">Filtros:</label>
            <input type="radio" name="pos" value="def" id='radio' checked> <span class='position-D'>DEF</span>
            <input type="radio" name="pos" value="mid"> <span class='position-DM'>MEI</span>
            <input type="radio" name="pos" value="atk"> <span class='position-F'>ATA</span>
            <input type="radio" name="pos" value="gk"> <span class='position-GK'>GK</span>
          </div>
          <table class='table'>
           <thead>
             <tr>
               <th data-sort='string'><abbr title='ctrl + clique no nome do jogador para abrir perfil'>Nome</abbr></th>
               <th data-sort='string'><abbr title='Posição'>Pos</abbr></th>
               <th data-sort='float'><abbr title='Indice de Habilidade'>SI</abbr></th>
                <th data-sort='float'><abbr title='Recomendação'>REC</abbr></th>
               <th><abbr title='Condição'>C</abbr></th>
             </tr>
           </thead>
           <tbody>
             <tr><td colspan='5'>Carregando...</td></tr>
           </tbody>
          </table>
        </div>
      </div>
      <div class='bit-2'>
        <div class='box'>
          <div class='box-content tactics'>
            <div class='bit-2 lastsaved'>

            </div>
            <div class='bit-2 advanced'>
              <a href='#'>Editar Opções avançadas</a>
            </div>
            <div class='bit-75'>
              <div class='field'>
                <div class='field_line forwards'>
                  <div class='left_block'></div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='fcl' >
                      <div class='playershirt forward'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='fc' >
                      <div class='playershirt forward'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='fcr' >
                      <div class='playershirt forward'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'></div>
                </div>
                <div class='field_line off_midfielders'>
                  <div class='left_block'>
                    <div class='field_player' player-id='' player-name='' position='oml' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='omcl' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='omcr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'>
                    <div class='field_player' player-id='' player-name='' position='omr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                </div>
                <div class='field_line midfielders'>
                  <div class='left_block'>
                    <div class='field_player' player-id='' player-name='' position='ml' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='mcl' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='mc' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='mcr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'>
                    <div class='field_player' player-id='' player-name='' position='mr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                </div>
                <div class='field_line def_midfielders'>
                  <div class='left_block'>
                    <div class='field_player' player-id='' player-name='' position='dml' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='dmcl' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='dmcr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'>
                    <div class='field_player' player-id='' player-name='' position='dmr' >
                      <div class='playershirt midfielder'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                </div>
                <div class='field_line defenders'>
                  <div class='left_block'>
                    <div class='field_player' player-id='' player-name='' position='dl' >
                      <div class='playershirt defender'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='dcl' >
                      <div class='playershirt defender'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='dc' >
                      <div class='playershirt defender'></div>
                      <p class='playername'></p>
                    </div>
                    <div class='field_player' player-id='' player-name='' position='dcr' >
                      <div class='playershirt defender'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'>
                    <div class='field_player' player-id='' player-name='' position='dr' >
                      <div class='playershirt defender'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                </div>
                <div class='field_line goalkeeper'>
                  <div class='left_block'></div>
                  <div class='center_block'>
                    <div class='field_player' player-id='' player-name='' position='gk' >
                      <div class='playershirt goalkeeper'></div>
                      <p class='playername'></p>
                    </div>
                  </div>
                  <div class='right_block'></div>
                </div>
              </div>
            </div>
            <div class='bit-25'>
              <div class='field_reserves'>
                <p class='title'>Reservas:</p>
                <div class='line_reserves'>
                  <p class='reserve_function'>Atacante</p>
                  <div class='reserve_player' player-id='' player-name='' position='fc' >
                    <div class='playershirt forward'></div>
                    <p class='playername'></p>
                  </div>

                </div>
                <div class='line_reserves'>
                  <p class='reserve_function'>Ala</p>
                  <div class='reserve_player' player-id='' player-name='' position='ml' >
                    <div class='playershirt midfielder'></div>
                    <p class='playername'></p>
                  </div>
                </div>
                <div class='line_reserves'>
                  <p class='reserve_function'>Meio Campo</p>
                  <div class='reserve_player' player-id='' player-name='' position='mc' >
                    <div class='playershirt midfielder'></div>
                    <p class='playername'></p>
                  </div>

                </div>
                <div class='line_reserves'>
                  <p class='reserve_function'>Defensor</p>
                  <div class='reserve_player' player-id='' player-name='' position='dc' >
                    <div class='playershirt defender'></div>
                    <p class='playername'></p>
                  </div>

                </div>
                <div class='line_reserves'>
                  <p class='reserve_function'>Goleiro</p>
                  <div class='reserve_player' player-id='' player-name='' position='gk' >
                    <div class='playershirt goalkeeper'></div>
                    <p class='playername'></p>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  players_by_id = [
  <? foreach ($this->data['players']as $player) {
       echo $player->id_player.",";
     }
    //  foreach ($this->data['players']['gk'] as $player) {
    //    echo $player->id_player.",";
    //  }
     ?>
  ];
</script>
