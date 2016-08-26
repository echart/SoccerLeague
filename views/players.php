<?
require_once('helpers/__skill.php');
?>
<main>
  <div class='content'>
    <div class='grid-65 padding-top'>
      <h3 class='title'><?=$this->data['clubname']?></h3>
    </div>
    <div class='grid-35 padding-top right'>
      Mostrar atributos:
      <select name='visible-attr'>
        <option value='phi'>Físicos</option>
        <option selected value='psi'>Psicológicos</option>
        <option value='tec'>Técnicos</option>
      </select>
    </div>
    <div class='grid-100'>
      <div class='box'>
        <div class='box-title'>Goleiros</div>
        <div class='box-content'>
          <table class='goalkeepers zebra bordered'>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Posição</th>
                <th>Idade</th>
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
                <th class='tec'>H.Man</th>
                <th class='tec'>Aer</th>
                <th class='tec'>Pés</th>
                <th class='tec'>MaM</th>
                <th class='tec'>Ref</th>
                <th class='tec'>Sai</th>
                <th class='tec'>Chu</th>
                <th class='tec'>Arr</th>
              </tr>
            </thead>
            <tbody>
              <?
              for($i=0;$i<count($this->data['playersTable']['gk']);$i++){?>
                <tr class='center'>
                  <td class='padding-right left'><a href="<?=$this->data['tree']?>players/<?=$this->data['playersTable']['gk'][$i]['id_player']?>"><?=$this->data['playersTable']['gk'][$i]['name'];?></a></td>
                  <td class='border'><span class='helper <?=$this->data['playersTable']['gk'][$i]['area']?>'><?=$this->data['playersTable']['gk'][$i]['position'];?></span></td>
                  <td class='border'><?=$this->data['playersTable']['gk'][$i]['age'];?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['gk'][$i]['stamina']);?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['gk'][$i]['speed']);?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['gk'][$i]['resistance']);?></td>
                  <td class='phi border'><?=__skill($this->data['playersTable']['gk'][$i]['jump']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['workrate']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['positioning']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['concentration']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['decision']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['vision']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['gk'][$i]['unpredictability']);?></td>
                  <td class='psi border'><?=__skill($this->data['playersTable']['gk'][$i]['communication']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['handling']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['aerial']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['foothability']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['oneanone']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['reflexes']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['rushingout']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['kicking']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['gk'][$i]['throwing']);?></td>
                </tr>
                <?}?>
            </tbody>
          </table>
        </div>
      </div>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content'>
          <table class='players zebra bordered'>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Posição</th>
                <th>Idade</th>
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
              </tr>
            </thead>
            <tbody>
              <?
              for($i=0;$i<count($this->data['playersTable']['line']);$i++){?>
                <tr class='center'>
                  <td class='padding-right left'><a href="<?=$this->data['tree']?>players/<?=$this->data['playersTable']['line'][$i]['id_player']?>"><?=$this->data['playersTable']['line'][$i]['name'];?></a></td>
                  <td class='border'><span class='helper <?=$this->data['playersTable']['line'][$i]['area']?>'><?=$this->data['playersTable']['line'][$i]['position'];?></span></td>
                  <td class='border'><?=$this->data['playersTable']['line'][$i]['age'];?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['line'][$i]['stamina']);?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['line'][$i]['speed']);?></td>
                  <td class='phi'><?=__skill($this->data['playersTable']['line'][$i]['resistance']);?></td>
                  <td class='phi border'><?=__skill($this->data['playersTable']['line'][$i]['jump']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['workrate']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['positioning']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['concentration']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['decision']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['vision']);?></td>
                  <td class='psi'><?=__skill($this->data['playersTable']['line'][$i]['unpredictability']);?></td>
                  <td class='psi border'><?=__skill($this->data['playersTable']['line'][$i]['communication']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['marking']);?></td>
                  <td class='tec border'><?=__skill($this->data['playersTable']['line'][$i]['tackling']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['crossing']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['pass']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['technical']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['ballcontrol']);?></td>
                  <td class='tec border'><?=__skill($this->data['playersTable']['line'][$i]['dribble']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['longshot']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['finish']);?></td>
                  <td class='tec'><?=__skill($this->data['playersTable']['line'][$i]['heading']);?></td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
