<main>
  <div class="content grid-container">
    <h3 class='title'>Feed de Notícias</h3>
    <div class='grid-65'>
      <div class='box'>
        <div class='box-content write'>
          <div class='form-field'>
            <!-- <input id='newtweet' type="text" name="tweet" placeholder="Write Something"> -->
            <textarea id='newtweet' name='tweet' placeholder="Escreva alguma coisa..."></textarea>
            <div class='tweet-options'>
              <button type='button' onclick='composeTweet()' class='btn-tweet btn no-bg no-hover white-text'><span class='icon arrow'></span></button>
            </div>
          </div>
        </div>
      </div>
      <div class='box'>
        <div class='box-content feed write'>
          <div class='tweet'>
            <p class='center loading bg-alert'>Carregando tweets....</p>
          </div>

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
      <div class='tweet'>
        <div class='tweet-content'>
          <div class='club-logo'><img src='' width='150px' height='150px'></div>
          <div class='tweet2'>
            <div class='tweet-info'><span class='date'>3h</span></div>
            <div class='tweet-text'></div>
          </div>
        </div>
        <div class='tweet-options'>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='reply'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='like'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='retweet'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='delete'></span></button>
        </div>
      </div>
      <div class='replytt'>
        <div class='form-field'>
          <input type='text' name='tweet' placeholder='Escreva uma resposta'>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='icon arrow'</button>
        </div>
      </div>
      <div class='replyt'>
        <div class='tweet-content'>
          <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/1.jpeg' width='75px' height='75px'></div>
          <div class='tweet2'>
            <div class='tweet-info'><span class='date'>3h</span></div>
            <div class='tweet-text'></div>
          </div>
        </div>
        <div class='tweet-options'>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='reply'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='like'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='retweet'></span></button>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='delete'></span></button>
        </div>
      </div>
	  </div>
	  <label class="modal-close" for="modal_tweet"></label>
	</div>
</main>
<script>
 id_club=<?=$_SESSION['SL_club'];?>;
</script>
