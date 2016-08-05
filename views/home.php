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
        <div class='box-content write'>


          <div class='tweet'>
            <div class='tweet-content'>
              <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/1.jpeg' width='75px' height='75px'></div>
              <div class='tweet2'>
                <div class='tweet-info'>E.C Grêmio Universidad <span class='club-user'>@ecgremiouniversidad</span> - <span class='date'>3h</span></div>
                <div class='tweet-text'>@soccerleague is the new soccer management game <?=$this->data['tweet']?></div>
              </div>
            </div>
            <!-- <input id='newtweet' type="text" name="tweet" placeholder="Write Something"> -->
            <div class='tweet-options'>
              <button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='reply'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='like'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='retweet'></span></button>
              <button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='delete'></span></button>
            </div>
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
</main>

<!--https://www.behance.net/gallery/14286087/Twitter-Redesign-of-UI-details-->
