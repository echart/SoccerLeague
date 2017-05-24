<div class='content'>
  <h1 class='page-title'><?=$this->title?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></h1>
  <div class='byte'>
    <div class='bit-30'>
      <div class='box bit-1'>
        <div class='box-title'>Opções</div>
        <div class='box-content'>
          <div class='club-options'>
            <ul class='subnav'>
              <li><a class='selected' href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>"><img src="<?=$this->tree?>assets/img/icons/home.png" width="32px"><span>Sede</span></a></li>
              <li><a href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>/overview/"><img src="<?=$this->tree?>assets/img/icons/strategy.png" width="32px"><span>Visão geral</span></a></li>
              <li><a href="<?=$this->tree?>club/<?=$this->data['club']->id_club?>/matches/"><img src="<?=$this->tree?>assets/img/icons/calendar.png" width="32px"><span>Partidas</span></a></li>
              <li><a href="<?=$this->tree?>stadium/<?=$this->data['club']->id_club?>"><img src="<?=$this->tree?>assets/img/icons/stadium.png" width="32px"><span>Estádio</span></a></li>
              <!-- <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/statistics"><img src="<?=$this->tree?>assets/img/icons/statistics.png" width="32px"><span>Estatísticas</span></a></li> -->
            </ul>
            <? if($_SESSION['SL_club']!=$this->data['club']->id_club){?>
            <a type="button" href='#' onclick='buddy(this,"<?=$this->data['friend']['action']?>",<?=$_SESSION['SL_club']?>,<?=$this->data['club']->id_club?>)' class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/plus.png' width='16px'><?=$this->data['friend']['text']?></a>
            <? } ?>
            <? if($_SESSION['SL_club']==$this->data['club']->id_club){?>
            <a type="button" href='<?=$this->tree?>club/<?=$this->data['club']->id_club?>/edit' class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/club.png' width='16px'>Editar clube</a>
            <? } ?>
            <!-- <a class='btn btn-medium btn-full btn-light' href='sendmessage'><img src='<?=$this->tree?>assets/img/icons/letter.png' width='16px'>Mandar mensagem</a> -->
            <label class="btn btn-medium btn-full btn-light" for="modal_searchclub"><img src='<?=$this->tree?>assets/img/icons/search.png' width='16px'>Procurar outro clube</label>
            <label class="btn btn-medium btn-full btn-light" for="modal_report"><img src='<?=$this->tree?>assets/img/icons/report.png' width='16px'>Denunciar clube</label>
            <? if($this->admin->is_GT()){?>
              <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/report.png' width='16px'>Gerenciar permissões</button>
              <?if($this->data['club']->status!='I'){?>
                <button type="button" class='btn btn-medium btn-full btn-blue inactive'><img src='<?=$this->tree?>assets/img/icons/inactive.png' width='16px'>Inativar clube</button>
                <?}?>
              <button type="button" class='btn btn-medium btn-full btn-danger ban'><img src='<?=$this->tree?>assets/img/icons/trash.png' width='16px'><?=($this->data['club']->status!='B') ? 'Banir Clube' : 'Desbanir Clube'?></button>
            <?}?>
          </div>
        </div>
      </div>
      <div class='bit-1 box'>
        <div class='box-title'>
          Visitas Recentes
        </div>
        <div class='box-content visits'>
          <?
          if($this->data['visitors']==null){
            echo '<p>Nenhuma visita recente</p>';
          }else{
            echo '<ul>';
            foreach($this->data['visitors'] as $key => $value){ ?>
              <li><span class="tooltip tooltip-effect-1" club='<?=$this->data['visitors'][$key]['id']?>'>
                <span class="tooltip-item"><img src="<?=$this->tree?>assets/img/icons/flags/<?=$this->data['visitors'][$key]['country']['country']?>.png" width="18px"><a href='<?=$this->tree?>club/<?=$this->data['visitors'][$key]['id']?>'><?=$this->data['visitors'][$key]['clubname']?></a></span>
                  <span class="tooltip-content clearfix">
                      <span class="tooltip-text">Carregando...</span>
                  </span>
              </span></li>
            <?}
            echo '</ul>';
          }
          ?>
        </div>
      </div>
    </div>
    <div class='bit-70'>
      <div class='bit-1 box'>
    		<div class='box-content'>
          <div class='club'>
            <div class='club-info bit-60'>
              <h1><?=$this->data['club']->clubname;?> <?if($this->data['club']->status=='I'){ echo '<strong><span class="blue">(INATIVO)</span></strong>';}?> <? if($this->data['club']->status=='B'){ echo '<strong><span class="red">(BANIDO)</span></strong>';}?> <? if($this->data['clubinfo']->nickname!=null and $this->data['club']->status=='A'){?><span class='nickname'>[<?=$this->data['clubinfo']->nickname;?>]<?}?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></span><img class='country-icon' src='<?=$this->tree?>assets/img/icons/flags/<?=$this->data['club']->country['country']?>.png' width="30px"></h1>
              <h3><?=$this->data['clubinfo']->manager;?></h3>
              <p><strong>ID do Clube:</strong> <?=$this->data['club']->id_club;?></p>
              <p><strong>Disputando:</strong> <a href='<?=$this->tree?>league/<?=$this->data['club']->country['abbreviation']?>/<?=$this->data['club']->league['division']?>/<?=$this->data['club']->league['divgroup']?>'><?=$this->data['club']->league['leaguename'];?></a></p>
              <p><strong>Estádio:</strong> <a href='<?=$this->tree?>club/<?=$this->data['club']->id_club?>/stadium'><? if($this->data['clubinfo']->stadium!=null){ echo $this->data['clubinfo']->stadium;}else{ echo 'Estádio Municipal';}?></a></p>
              <p><strong>Torcida:</strong> <? if($this->data['clubinfo']->fansname!=null){ echo $this->data['clubinfo']->fansname;} else{echo '...';}?></p>
              <p><strong>Sócios:</strong> ...</p>
              <p><strong>Fundado em:</strong> <?=$this->data['club']->created;?></p>
            </div>
            <div class='club-logo bit-40 right'>
              <div class='logo'>
                <img src="<?=$this->tree?>assets/img/club_pics/<?=$this->data['clubinfo']->logo?>" width="200px">
              </div>
            </div>
          </div>
    		</div>
    	</div>
      <div class='bit-1 box'>
        <div class='box-title'>
          História do clube
        </div>
        <div class='box-content'>
          <p>

            <?
            if($this->data['clubinfo']->history==null){
              echo 'Nenhuma história para contar';
            }else{
              echo $this->data['clubinfo']->history;
            }
            ?>
          </p>
        </div>
      </div>
      <div class='bit-1 box'>
        <div class='box-title'>
          Galeria de troféus
        </div>
        <div class='box-content'>
          <?
          if($this->data['clubtrophies']!=null){
            foreach ($this->data['clubtrophies'] as $trophy) { ?>
            <div class='awards'>
              <div>
                <div class='trophy'>
                  <img src='<?=$this->tree?>assets/img/awards/<?=$trophy['type']?>.png'>
                </div>
                <div class='trophy-desc'>
                  <p><?=$trophy['name']?> (Season <?=$trophy['season']?>)</p>
                </div>
              </div>
            </div>
          <?
            }
          }else{ ?>
            <p>Nada conquistado :(</p>
          <?
          }
          ?>
        </div>
      </div>
      <div class='bit-1 box'>
        <div class='box-title'>
          Feed do Clube
        </div>
        <div class='box-content feed feed-principal'>
          <div class='feed-content'>
            <p>Carregando...</p>
          </div>
          <div class='feed-pages'>

          </div>
    		</div>
      </div>
    </div>
  </div>
</div>
<!-- FEED MODAL -->
<input type="checkbox" id="modal_feed" />
<div class="modal modal-feed">
  <div class="modal-content">
    <div class='feed feed-replies'>
      <div class='feed-content'>
        <p>Carregando...</p>
      </div>
    </div>
    <label class="modal-close" for="modal_feed"></label>
  </div>
  <div class='modal-pattern'></div>
</div>
<!-- SEARCH CLUB MODAL -->
<input type="checkbox" id="modal_searchclub" />
<div class="modal modal-search">
  <div class="modal-content">
    <div class='form-field'>
      <form>
        <label for="search-clubname">Nome do Clube:</label>
        <input type='text' id='search-clubname' placeholder="Digite o nome do clube">
      </form>
    </div>
    <table class='table is-bordered club-result'>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Competição</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="3">Nenhum resultado</td>
        </tr>
      </tbody>
    </table>
    <label class="modal-close" for="modal_searchclub"></label>
  </div>
  <div class='modal-pattern'></div>
</div>
<!-- MODAL REPORT -->
<input type="checkbox" id="modal_report" />
<div class="modal modal-report">
  <div class="modal-content">
    <form>
      <div class='form-field'>
          <label for="reason">Motivo(*):</label>
          <select name="type" id='reason'>
            <option value="">Escolha um motivo</option>
            <option value="shield">Escudo Impróprio</option>
            <option value="forum">Conduta no Fórum/Feed</option>
            <option value="cheating">Trapaças/Cheating</option>
            <option value="other">Outros</option>
          </select>
      </div>
      <div class='form-field'>
        <label for="description">Descrição:</label>
        <textarea id='description' name="other" placeholder="Uma breve descrição sobre o porque da denuncia"></textarea>
      </div>
      <div class='form-field'>
        <button type='button' class='btn btn report'>Denunciar</button>
      </div>
    </form>
    <label class="modal-close" for="modal_report"></label>
  </div>
  <div class='modal-pattern'></div>
</div>
<script>
  id_club = <?=$this->data['club']->id_club;?>;
  method = 'club';
  page = 1;
</script>
