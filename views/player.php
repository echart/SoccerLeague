<div class='content'>
  <?
  if($this->data['player']['nonexists']==true){ ?>
    <h1 class='page-title'>Resultado não encontrado</h1>
  <?
  exit;
  }?>
  <div class='byte'>
    <div class='bit-1 box right'>
  		<div class='box-content player-info'>
          <div class='player-face'>
            <div class='player-body'>
              <!-- <div class='player-eyes'></div> -->
            </div>
          </div>
          <div class='player-profile'>
            
          <div>
  		</div>
  	</div>
  </div>
  <div class='bit-1 box player-stats'>
    <div class='box-title'>Habilidades</div>
    <div class="box-content">
      <table style='text-align:center'>
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
          <td class='center phi'>x</td>
          <td class='center phi'>x</td>
          <td class='center phi'>x</td>
          <td class='center phi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
          <td class='center psi'>x</td>
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
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
            <td class='center tec'>x</td>
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
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
                <td class='center tec'>x</td>
              </tr>
              <?
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
