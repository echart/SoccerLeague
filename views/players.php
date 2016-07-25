<?
require_once('helpers/__skill.php');
?>
<main>
  <div class='content'>
    <h3 class='title'><?=$this->data['clubname']?></h3>
    <div class='grid-100'>
      <div class='box'>
        <div class='box-title'>Jogadores</div>
        <div class='box-content'>
          <table class='zebra bordered'>
            <thead>
              <tr>
                <th>Nome</th>
                <th>Posição</th>
                <th>Idade</th>
                <th>For</th>
                <th>Vel</th>
                <th>Res</th>
                <th>Sal</th>
                <th>Emp</th>
                <th>Pos</th>
                <th>Con</th>
                <th>Dec</th>
                <th>Vis</th>
                <th>Imp</th>
                <th>Com</th>
                <th>Mar</th>
                <th>Des</th>
                <th>Cru</th>
                <th>Pas</th>
                <th>Tec</th>
                <th>B.Con</th>
                <th>Dri</th>
                <th>Lon</th>
                <th>Fin</th>
                <th>Cab</th>
              </tr>
            </thead>
            <tbody>
              <?
              for($i=0;$i<count($this->data['playersTable']['line']);$i++){?>
                <tr class='center'>
                  <td class='left'><?=$this->data['playersTable']['line'][$i]['name'];?></td>
                  <td class='border'><?=$this->data['playersTable']['line'][$i]['position'];?></td>
                  <td class='border'><?=$this->data['playersTable']['line'][$i]['age'];?></td>
                  <td class=''><?=__skill($this->data['playersTable']['line'][$i]['stamina']);?></td>
                  <td>Vel</td>
                  <td>Res</td>
                  <td class='border'>Sal</td>
                  <td>Emp</td>
                  <td>Pos</td>
                  <td>Con</td>
                  <td>Dec</td>
                  <td>Vis</td>
                  <td>Imp</td>
                  <td class='border'>Com</td>
                  <td>Mar</td>
                  <td class='border'>Des</td>
                  <td>Cru</td>
                  <td>Pas</td>
                  <td>Tec</td>
                  <td>B.Con</td>
                  <td class='border'>Dri</td>
                  <td>Lon</td>
                  <td>Fin</td>
                  <td>Cab</td>
                </tr>
              <? } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class='box'>
        <div class='box-title'>Goleiros</div>
        <div class='box-content'>

        </div>
      </div>
    </div>
  </div>
</main>
