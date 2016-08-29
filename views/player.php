<?
require_once('helpers/__skill.php');
?>
<main>
  <div class='content grid-container'>
    <div class='grid-100'>
      <div class='player-name'>
        <h3 class='no-padding title'><!--<i class='padding-top flag icon </i>--><?=$this->data['player']['name'];?> <span class='nickname'><?=$this->data['player']['nickname'];?></span></h3>
        <div class='positions'>
          <span class='helper <?=$this->data['player']['area']?>'><?=$this->data['player']['position'];?></span>
        </div>
      </div>
    </div>
    <!-- <div class='grid-35 padding-top right options'>

    </div> -->
    <div class='grid-50'>
      <div class='box'>
        <div class='box-content bg-white'>
          <div class='player'>
            <div class='player-pic'>
              <img src='<?=$this->data['tree']?>assets/img/player.png'>
            </div>
            <div class='player-info'>
              <table class=''>
                <tr><td width='50px'>Clube:</td><td><a href='<?=$this->data['tree']?>club/<?=$this->data['player']['id_player_club']?>'><?=$this->data['player']['club']?></a></td></tr>
                <tr><td width='50px'>País:</td><td>Brasil</td></tr>
                <tr><td width='50px'>Idade</td><td><?=$this->data['player']['age']?></td></tr>
                <tr><td width='50px'>Peso/Altura:</td><td><?=$this->data['player']['weight']."kg/".$this->data['player']['height'].'cm'?></td></tr>
                <tr><td width='50px'>SI:</td><td><?=$this->data['player']['SI']?></td></tr>
                <tr><td width='50px'>REC:</td><td><?=$this->data['player']['REC']?></td></tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class='grid-30'>
      <div class='box'>
        <div class='box-content bg-white'>

        </div>
      </div>
    </div>
    <div class='grid-100'>
      <div class='box'>
        <div class='box-title'>
          Habilidades
        </div>
        <div class='box-content bg-white'>
          <table>
            <thead>
              <tr>
                <th class='phi'>For</th>
                <th class='phi'>Vel</th>
                <th class='phi'>Res</th>
                <th class='phi'>Sal</th>
                <th class='psi'>Emp</th>
                <th class='psi'>Pos</th>
                <th class='psi'>Con</th>
                <th class='psi'>Dec</th>
                <th class='psi'>Vis</th>
                <th class='psi'>Imp</th>
                <th class='psi'>Com</th>
              </tr>
            </thead>
            <tbody>
              <td class='center phi'><?=__skill($this->data['player']['stamina']);?></td>
              <td class='center phi'><?=__skill($this->data['player']['speed']);?></td>
              <td class='center phi'><?=__skill($this->data['player']['resistance']);?></td>
              <td class='center phi'><?=__skill($this->data['player']['jump']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['workrate']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['positioning']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['concentration']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['decision']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['vision']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['unpredictability']);?></td>
              <td class='center psi'><?=__skill($this->data['player']['communication']);?></td>
            </tbody>
            <?
            if($this->data['player']['position']=='GK'){?>
            <thead>
              <tr>
                <th class='tec'>H.Man</th>
                <th class='tec'>Aer</th>
                <th class='tec'>Pés</th>
                <th class='tec'>MaM</th>
                <th class='tec'>Ref</th>
                <th class='tec'>Sai</th>
                <th class='tec'>Chu</th>
                <th class='tec'>Arr</th>
                <th colspan="3"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class='center tec'><?=__skill($this->data['player']['handling']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['aerial']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['foothability']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['oneanone']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['reflexes']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['rushingout']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['kicking']);?></td>
                <td class='center tec'><?=__skill($this->data['player']['throwing']);?></td>
              </tr>
              <?
              }else{
              ?>
                <thead>
                  <tr>
                    <th class='tec'>Mar</th>
                    <th class='tec'>Des</th>
                    <th class='tec'>Cru</th>
                    <th class='tec'>Pas</th>
                    <th class='tec'>Tec</th>
                    <th class='tec'>B.Con</th>
                    <th class='tec'>Dri</th>
                    <th class='tec'>Lon</th>
                    <th class='tec'>Fin</th>
                    <th class='tec'>Cab</th>
                    <th class='tec'>B.Par</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class='center tec'><?=__skill($this->data['player']['marking']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['tackling']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['crossing']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['pass']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['technical']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['ballcontrol']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['dribble']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['longshot']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['finish']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['heading']);?></td>
                    <td class='center tec'><?=__skill($this->data['player']['freekick']);?></td>
                  </tr>
                  <?
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
