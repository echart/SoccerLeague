<main>
  <div class="content grid-container">
    <h3 class='title'>Feed de Notícias</h3>
    <div class='grid-65'>
      <div class='box'>
        <div class='box-content write'>
          <div class='form-field'>
            <!-- <input id='newtweet' type="text" name="tweet" placeholder="Write Something"> -->
            <textarea id='newtweet' name='tweet' placeholder="Write Something..."></textarea>
            <div class='tweet-options'>
              <button type='button' class='btn-tweet btn bg-alert white-text'>Tweet</button>
            </div>
          </div>
        </div>
      </div>
      <div class='box'>
        <div class='box-content feed write'>
          <div class='tweet'>
            <p class='center loading bg-alert'>Carregando feed....</p>
          </div>

          <!-- <div class='tweet'>
            <div class='tweet-content'>
              <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/1.jpeg' width='75px' height='75px'></div>
              <div class='tweet2'>
                <div class='tweet-info'>E.C Grêmio Universidad - <span class='date'>3h</span></div>
                <div class='tweet-text'>Aqui é Body Builder Ipsum PORRA! É 13 porra! Não vai dá não. É nóis caraio é trapezera buscando caraio! Negativa Bambam negativa. Que não va</div>
                <div class='tweet-stats'>
                    <ul>
                      <li><span class='retweet icon'></span>20</li>
                      <li><span class='like icon'></span>20</li>
                      <li><span class='reply icon'></span>20</li>
                    </ul>
                </div>
              </div>
            </div>
            <div class='tweet-options'>
              <button type='button' class='btn-tweet btn no-bg no-hover black-text'>20<span class='reply'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover black-text'>12<span class='like'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover black-text'>1<span class='retweet'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='delete'></span></button>
            </div>
          </div> -->

        </div>
      </div>
    </div>
    <div class="grid-35 grid-parent">
      <div class="grid-100">
          <div class='box'>
            <div class='box-title'>Jogos</div>
            <div class='box-content'>
              <p>div box content</p>
            </div>
          </div>
      </div>
      <div class="grid-100">
          <div class='box'>
            <div class='box-title'>Notificações</div>
            <div class='box-content'>
              <p>div box content</p>
            </div>
          </div>
      </div>
      <div class="grid-100">
          <div class='box'>
            <div class='box-title'>Mensagens</div>
            <div class='box-content'>
              <p>div box content</p>
            </div>
          </div>
      </div>
    </div>
  </div>
  <label class='modal-trigger' for='modal_tweet'>tweet</label>
	<input type="checkbox" id="modal_tweet" />
	<div class="modal modal-tweet">
	  <div class="modal-content">

	  </div>
	  <label class="modal-close" for="modal_tweet"></label>
	</div>
</main>
<script>
 id_club=<?=$_SESSION['SL_club'];?>;
</script>
