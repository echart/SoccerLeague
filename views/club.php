<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-30'>
      <div class='box bit-1'>
        <div class='box-title'>Opções</div>
        <div class='box-content'>
          <div class='club-options'>
            <ul class='subnav'>
              <li><a class='selected' href="<?=$this->tree?>league"><img src="<?=$this->tree?>assets/img/icons/strategy.png" width="32px"><span>Visão geral</span></a></li>
              <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/team-of-the-round"><img src="<?=$this->tree?>assets/img/icons/calendar.png" width="32px"><span>Partidas</span></a></li>
              <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/calendar"><img src="<?=$this->tree?>assets/img/icons/stadium.png" width="32px"><span>Estádio</span></a></li>
              <li><a href="<?=$this->tree?>league/<?=$this->data['league']['countryabbr']?>/<?=$this->data['league']['div']?>/<?=$this->data['league']['group']?>/statistics"><img src="<?=$this->tree?>assets/img/icons/statistics.png" width="32px"><span>Estatísticas</span></a></li>
            </ul>
            <a type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/plus.png' width='16px'>Adicionar como amigo</a>
            <a class='btn btn-medium btn-full btn-light' href='sendmessage'><img src='<?=$this->tree?>assets/img/icons/letter.png' width='16px'>Mandar mensagem</a>
            <button type="button" class='btn btn-medium btn-full btn-blue'><img src='<?=$this->tree?>assets/img/icons/inactive.png' width='16px'>Inativar clube</button>
            <button type="button" class='btn btn-medium btn-full btn-warning'><img src='<?=$this->tree?>assets/img/icons/report.png' width='16px'>Denunciar clube</button>
            <button type="button" class='btn btn-medium btn-full btn-danger'><img src='<?=$this->tree?>assets/img/icons/trash.png' width='16px'>Banir clube</button>
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
              <h1><?=$this->data['club']->clubname;?> <? if($this->data['clubinfo']->nickname!='null'){?><span class='nickname'>[<?=$this->data['clubinfo']->nickname;?>]<?}?></span><img class='country-icon' src='<?=$this->tree?>assets/img/icons/flags/<?=$this->data['club']->country['country']?>.png' width="30px"></h1>
              <h3><?=$this->data['clubinfo']->manager;?></h3>
              <p><strong>ID do Clube:</strong> <?=$this->data['club']->id_club;?></p>
              <p><strong>Disputando:</strong> <a href='#'>Campeonato Brasileiro</a></p>
              <p><strong>Estádio:</strong> <a href='<?=$this->tree?>club/<?=$this->data['club']->id_club?>/stadium'><? if($this->data['clubinfo']->stadium!='null'){ echo $this->data['clubinfo']->stadium;}else{ echo 'Estádio Municipal';}?></a></p>
              <p><strong>Torcida:</strong> <? if($this->data['clubinfo']->fansname!=null){ echo $this->data['clubinfo']->fansname;} else{echo '...';}?></p>
              <p><strong>Sócios:</strong> ...</p>
              <p><strong>Fundado em:</strong> <?=$this->data['club']->created;?></p>
            </div>
            <div class='club-logo bit-40 right'>
              <div class='logo'>
                <img src="<?=$this->tree?>assets/img/icon.png" width="200px">
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
            if($this->data['clubinfo']->history=='null'){
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
          <!-- <div class='awards'>
            <div>
              <div class='trophy'>
                <img src='<?=$this->tree?>assets/img/awards/liberty.png'>
              </div>
              <div class='trophy-desc'>
                <p>Libertadores da América (Season 3)</p>
              </div>
            </div>
          </div> -->
          <p>Nada conquistado :(</p>
        </div>
      </div>
      <div class='bit-1 box'>
        <div class='box-title'>
          Feed do Clube
        </div>
        <div class='box-content'>
          <p>Feed de noticias</p>
        </div>
      </div>
    </div>
  </div>
</div>
