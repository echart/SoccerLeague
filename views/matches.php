<div class='content'>
  <h1 class='page-title'><?=$this->title?> <?if(PRO::is_pro($this->data['club']->id_club)){?><img width='20px' src='<?=$this->tree?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></h1>
  <div class='byte'>
    <div class='box bit-1'>
      <div class='box-content results'>
        <div class='club-info'>
          <div class='club-logo home'>
            <img src="<?=$this->tree?>assets/img/club_pics/default.png" alt="" width="150px">
          </div>
          <div class="club-name">
            <span class="tooltip tooltip-effect-1" club='<?=$this->match->home?>'>
              <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->match->home?>'><?=Club::getClubNameById($this->match->home)?></a><?if(PRO::is_pro($this->match->away)){?><img width='18px' src='<?=$this->tree;?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></span>
                <span class="tooltip-content clearfix">
                    <span class="tooltip-text">Carregando...</span>
                </span>
            </span>
          </div>
        </div>
        <div class='result'><strong><?=$this->matchStats->homegoals?></strong>x<strong><?=$this->matchStats->awaygoals?></strong></div>
        <div class='club-info'>
          <div class='club-logo away'>
            <img src="<?=$this->tree?>assets/img/club_pics/default.png" alt="" width="150px">
          </div>
          <div class="club-name">
            <span class="tooltip tooltip-effect-1" club='<?=$this->match->away?>'>
              <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$this->match->away?>'><?=Club::getClubNameById($this->match->away)?></a><?if(PRO::is_pro($this->match->away)){?><img width='18px' src='<?=$this->tree;?>assets/img/icons/coin.png'> <small class='pro'>PRO</small><?}?></span>
                <span class="tooltip-content clearfix">
                    <span class="tooltip-text">Carregando...</span>
                </span>
            </span>
          </div>
        </div>
    </div>
  </div>
  <!-- <div class='box bit-1'>
    <div class='box-title'>Estatísticas</div>
    <div class="box-content"></div>
  </div> -->
  <div class='box bit-1'>
    <div class='box-title'>Relatório</div>
    <div class="box-content report">
      <?php foreach ($this->report->report as $minute => $value){
          foreach ($value as $lance) {

            echo '<p><strong class="minute">'.$minute.'</strong> - '.$lance.'</p>';
          }
      } ?>
    </div>
  </div>
</div>
