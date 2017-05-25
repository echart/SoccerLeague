<div class='content'>
  <h1 class='page-title'><?=$this->title?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></h1>
  <div class='byte'>
    <div class='bit-30'>
      <div class='box bit-1'>
        <div class='box-title'>Fóruns</div>
        <div class='box-content'>
          <div class='club-options'>
            <ul class='subnav'>
              <li><a href="<?=$this->tree;?>forum/<?=$_SESSION['SL_country'];?>/general/1/"><img src="<?=$this->tree?>assets/img/icons/flags/brazil.png" width="32px"><span>Geral</span></a></li>
              <li><a class='' href="<?=$this->tree;?>forum/<?=$_SESSION['SL_country'];?>/help/1/"><img src="<?=$this->tree?>assets/img/icons/flags/brazil.png" width="32px"><span>Ajuda</span></a></li>
              <li><a class='' href="<?=$this->tree;?>forum/int/announcements/1/"><span>Anúncios</span></a></li>
              <li><a class='' href="<?=$this->tree;?>forum/int/development/1/"><span>Desenvolvimento</span></a></li>
              <li><a class='' href="<?=$this->tree;?>forum/int/bugs/1/"><span>Bugs</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class='bit-70'>
      <div class='bit-1'>
        <div class='box'>
          <div class='box-title'>Tópicos</div>
          <div class='box-content'>
            <?
            if(count($this->forum['topics'])==0){
              echo '<p>Nenhum tópico encontrado</p>';
            }
            foreach ($this->forum['topics'] as $topic) {
              $date=new DateTime($topic->topic_date);
              $likes=$topic->likes-$topic->dislikes;
              if($likes>=0){$class='green';}else{$class='red';}
              ?>

              <div class='forum_topic' id-topic='<?=$topic->id_topic?>'>
                <div class='topic_title'><a href='<?=$this->tree;?>forum/<?=$this->country?>/<?=$this->type?>/topic/<?=$topic->id_topic?>'><?=$topic->title?></a> <small>7 respostas</small></div>
                <div class='topic_club'><a href='<?=$this->tree?>club/<?=$topic->id_club?>'><?=Club::getClubnameById($topic->id_club)?></a></div>
                <div class='topic_last'><?=$date->format('d/m/Y');?></div>
                <div class='likes <?=$class?>'><?=$likes?></div>
                <div class='replies'><?=$topic->countReplies();?></div>
              </div>
            <?
            }
            ?>
          </div>
        </div>
      </div>
      <div class='bit-1'>
        <div class='box'>
          <div class='box-title'>Criar tópico</div>
          <div class='box-content'>
            <div class="form-field">
              <label for="">Titulo:</label>
              <input type="text" name="" value="">
            </div>
            <div class="form-field">
              <label for="">Texto:</label>
              <textarea name="name" rows="8" cols="80"></textarea>
            </div>
            <div class="form-field">
              <button class='btn btn-light' type="reset" name="button">Limpar</button>
              <button class='btn btn-success' type="button" name="button">Criar tópico</button>
            </div>
          </div>
        </div>
      </div>

    </div>
