<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-40 box right'>
  		<div class='box-title color'>
  			Próximo Jogo
  		</div>
  		<div class='box-content'>
  			<div class='bit-1 next-game'>
          <div class='match'>
            <div class='home'>
              <img src='<?=$this->tree?>assets/img/icon.png'>
              <p><span class="tooltip tooltip-effect-1" club='<?=$this->data['next-match']['home']['id']?>'>
              <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->data['next-match']['home']['id']?>'><?=$this->data['next-match']['home']['name']?></a></span>
                <span class="tooltip-content clearfix">
                    <span class="tooltip-text">Carregando...</span>
                </span>
              </span></p>
            </div>
              <span>vs</span>
            <div class='away'>
              <img src='<?=$this->tree?>assets/img/icon.png'>
              <p><span class="tooltip tooltip-effect-1" club='<?=$this->data['next-match']['away']['id']?>'>
                <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->data['next-match']['away']['id']?>'><?=$this->data['next-match']['away']['name']?></a></span>
                  <span class="tooltip-content clearfix">
                      <span class="tooltip-text">Carregando...</span>
                  </span>
                </span>
              </p>
            </div>
            <table class='table is-bordered'>
              <tr>
                <td><strong>Data:</strong> Dia <?=$this->data['next-match']['day']?>, às <?=$this->data['next-match']['hour']?></td>
              </tr>
              <tr>
                <td><strong>Estádio:</strong><?=$this->data['next-match']['location']?></td>
              </tr>
              <tr>
                <td><strong>Competição:</strong> <?=$this->data['next-match']['competition']?></td>
              </tr>
              <tr>
                <td style='text-align:center'><a href='<?=$this->tree?>matches/<?=$this->data['next-match']['id_match']?>'>Ver partida</a></td>
              </tr>
            </table>
          </div>
        </div>
  		</div>
  	</div>
    <div class='bit-60 box'>
  		<div class='box-title color'>
  			Feed
  		</div>
  		<div class='box-content feed'>
        <div class='create-content'>
          <textarea placeholder='O que você está pensando?'></textarea>
          <button class='btn btn-medium btn-light'>Publicar</button>
        </div>
        <div class='feed-content'>
          <p>Carregando...</p>
        </div>
  		</div>
  	</div>
  </div>
</div>
