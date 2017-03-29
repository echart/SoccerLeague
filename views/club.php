<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-70 box'>
  		<div class='box-content'>
        <div class='club'>
          <div class='club-logo'>
            <div class='logo'>
              <img src="<?=$this->tree?>assets/img/icon.png" width="200px">
            </div>
          </div>
          <div class='club-info'>
            <h1><?=$this->data['club']->clubname;?> <? if($this->data['clubinfo']->nickname!='null'){?><span class='nickname'>[<?=$this->data['clubinfo']->nickname;?>]<?}?></span><img class='country-icon' src='<?=$this->tree?>assets/img/icons/flags/<?=$this->data['club']->country['country']?>.png' width="30px"></h1>
            <h3><?=$this->data['clubinfo']->manager;?><a href=''>Alterar informações</a></h3>
            <p><strong>ID do Clube:</strong> <?=$this->data['club']->id_club;?></p>
            <p><strong>Disputando:</strong> <a href='#'>Campeonato Brasileiro</a></p>
            <p><strong>Estádio:</strong> <a href='#'><? if($this->data['clubinfo']->stadium!='null'){ echo $this->data['clubinfo']->stadium;}else{ echo 'Estádio Municipal';}?></a></p>
            <p><strong>Torcida:</strong> <? if($this->data['clubinfo']->fansname!=null){ echo $this->data['clubinfo']->fansname;} else{echo '...';}?></p>
            <p><strong>Sócios:</strong> ...</p>
            <p><strong>Fundado em:</strong> <?=$this->data['club']->created;?></p>
          </div>
        </div>
  		</div>
  	</div>
    <div class='bit-30 box'>
      <div class='box-title'>Opções</div>
      <div class='box-content'>
        <div class='club-options'>
            <a class='btn btn-medium btn-full btn-light' href='sendmessage'><img src='<?=$this->tree?>assets/img/icons/letter.png' width='16px'>Mandar mensagem</a>
            <button type="button" class='btn btn-medium btn-full btn-light'><img src='<?=$this->tree?>assets/img/icons/plus.png' width='16px'>Adicionar como amigo</button>
            <button type="button" class='btn btn-medium btn-full btn-blue'><img src='<?=$this->tree?>assets/img/icons/inactive.png' width='16px'>Inativar clube</button>
            <button type="button" class='btn btn-medium btn-full btn-danger'><img src='<?=$this->tree?>assets/img/icons/trash.png' width='16px'>Banir clube</button>
        </div>
      </div>
    </div>
    <div class='bit-2 box'>
      <div class='box-title'>
        Galeria de troféus
      </div>
      <div class='box-content'>
      </div>
    </div>
    <div class='bit-2 box'>
      <div class='box-title'>
      História do clube
      </div>
  		<div class='box-content'>
        <p>
          <?=$this->data['clubinfo']->history?>
        </p>
      </div>
    </div>
    <div class='bit-70 box'>
      <div class='box-title'>
        Feed do Clube
      </div>
      <div class='box-content'>
        feed de noticias
      </div>
    </div>
    <div class='bit-30 box'>
      <div class='box-title'>
        Visitas Recentes
      </div>
      <div class='box-content'>
        ultimas visitas
      </div>
    </div>
  </div>
</div>
