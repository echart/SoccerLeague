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
          <div class='box-title'><?=$this->topic->title?></div>
          <div class='box-content'>
          <?
          if($this->request['page']==1){?>
              <div class='topic'>
                <div class='topic_creator'>
                  <div class='topic_logo'>
                    <img src="<?=$this->tree?>assets/img/club_pics/<? $club = new ClubInfo(new Club($this->topic->id_club)); echo $club->__logo()?>" alt="" width="100px">
                  </div>
                  <div class="topic_club">
                    <span class="tooltip tooltip-effect-1" club='<?=$this->topic->id_club?>'>
                      <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->topic->id_club?>'><?=Club::getClubNameById($this->topic->id_club)?></a><?if(PRO::is_pro($this->topic->id_club)){?><img width='18px' src='<?=$this->tree;?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></span>
                        <span class="tooltip-content clearfix">
                            <span class="tooltip-text">Carregando...</span>
                        </span>
                    </span>
                  </div>
                </div>
                <div class='topic_content'>
                  <p>
                    <?=$this->topic->text?>
                  </p>
                </div>
                <?if($_SESSION['SL_club']==$this->topic->id_club OR $this->admin->is_FT()){?>
                  <div class='ft_controller'>
                    <?if($this->admin->is_FT()){?><!--<button type="button" class='btn btn-small' name="button">Fixar</button>--><?}?>
                    <!-- <button type="button" class='btn btn-small' name="button">Editar</button> -->
                    <button type="button" class='topic-delete btn btn-small' id-topic='<?=$this->request['topic']?>' name="button">Excluir</button>
                    <?if($this->admin->is_FT()){?><!--<button type="button" class='btn btn-small btn-danger' name="button">Banir do Fórum</button>--><?}?>

                  </div>
                <?}?>
              </div>
          <?}?>
          <?php foreach ($this->replies as $reply){ ?>
              <div class='topic'>
                <div class='topic_creator'>
                  <div class='topic_logo'>
                    <img src="<?=$this->tree?>assets/img/club_pics/<? $club = new ClubInfo(new Club($reply->id_club)); echo $club->__logo()?>" alt="" width="100px">
                  </div>
                  <div class="topic_club">
                    <span class="tooltip tooltip-effect-1" club='<?=$reply->id_club?>'>
                      <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$reply->id_club?>'><?=Club::getClubNameById($reply->id_club)?></a><?if(PRO::is_pro($reply->id_club)){?><img width='18px' src='<?=$this->tree;?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></span>
                        <span class="tooltip-content clearfix">
                            <span class="tooltip-text">Carregando...</span>
                        </span>
                    </span>
                  </div>
                </div>
                <div class='topic_content'>
                  <p>
                    <?=$reply->topic;?>
                  </p>
                </div>
                <?if($_SESSION['SL_club']==$reply->id_club OR $this->admin->is_FT()){?>
                <div class='ft_controller'>
                  <!--<button type="button" class='btn btn-small' name="button">Editar</button>-->
                  <button type="button" class='reply-delete btn btn-small' name="button" id-reply='<?=$reply->id_reply?>'>Excluir</button>
                  <?if($this->admin->is_FT()){?><!--<button type="button" class='btn btn-small btn-danger' name="button">Banir do Forum</button>--><?}?>
                </div>
                <?}?>
              </div>
          <?php } ?>
            <?
            if($this->topic->countReplies()!=0 and $this->topic->countReplies()>6){
              $page = $this->request['page'];
              $x = $this->topic->countReplies()/6;
              if($x>$this->request['page']) $flag = true; else $flag = false;
              ?>
              <ul class='pages'>
                <? if($this->request['page']!=1){?><li><a href='<?=$this->tree?>forum/<?=$this->request['country']?>/<?=$this->request['type']?>/topic/<?=$this->topic->id_topic?>/<?=$this->request['page']-1?>'><</a></li><?}?>
                <? if($flag==true){?><li><a href='<?=$this->tree?>forum/<?=$this->request['country']?>/<?=$this->request['type']?>/topic/<?=$this->topic->id_topic?>/<?=$this->request['page']+1?>'>></a></li><?}?>
              </ul>
              <?
              }?>
            </div>
          </div>
        </div>
        <div class='bit-1'>
        <div class='box'>
          <div class='box-title'>Responder</div>
          <div class='box-content'>
          <form action='<?=$this->tree?>forum/<?=$this->country?>/<?=$this->request['type']?>/reply' method='POST'>
            <input type='hidden' name='id_topic' value='<?=$this->request['topic']?>'>
            <input type='hidden' name='type' value='<?=$this->request['type']?>'>
            <input type='hidden' name='country' value='<?=$this->request['country']?>'>
            <div class="form-field">
              <label for="">Texto:</label>
              <textarea name="text" rows="8" cols="80" placeholder='Texto do tópico'></textarea>
            </div>
            <div class="form-field">
              <button class='btn btn-light' type="reset" name="button">Limpar</button>
              <button class='btn btn-success' type="submit" name="button">Responder</button>
            </div>
          </form>
          </div>
        </div>
      </div>

    </div>
