<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='box'>
        <div class='box-content'>
          <table class='table is-bordered'>
            <thead>
              <tr>
                <th>Clube denunciante</th>
                <th>Clube denunciado</th>
                <th>Motivo</th>
                <th width='5%'></th>
              </tr>
            </thead>
            <tbody>
              <?
              foreach ($this->data['reports'] as $report) {
                ?>
                <tr>
                  <td>
                    <span class="tooltip tooltip-effect-1" club='<?=$report['id_club']?>'>
                      <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$report['id_club']?>'><?=Club::getClubNameById($report['id_club'])?></a></span>
                        <span class="tooltip-content clearfix">
                            <span class="tooltip-text">Carregando...</span>
                        </span>
                    </span>
                  </td>
                  <td>
                    <span class="tooltip tooltip-effect-1" club='<?=$report['id_club_reported']?>'>
                      <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$report['id_club_reported']?>'><?=Club::getClubNameById($report['id_club_reported'])?></a></span>
                        <span class="tooltip-content clearfix">
                            <span class="tooltip-text">Carregando...</span>
                        </span>
                    </span>
                  </td>
                  <td><?=$report['reason']?></td>
                  <td><label for='modal_report' class='btn btn-blue' onclick='getReport(this)' report='<?=$report['id_club_report']?>'>Avaliar</label></td>
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
</div>
<!-- MODAL REPORT -->
<input type="checkbox" id="modal_report" />
<div class="modal modal-report">
  <div class="modal-content">
    <div class='form-field'>
      <label for="">Clube denunciante</label>
      <input type="text" disabled value="" id='club'>
      <input type="hidden" disabled value="" id='id_club'>
    </div>
    <div class='form-field'>
      <label for="">Clube denunciado</label>
      <input type="hidden" disabled value="" id='id_reported'>
      <input type="text" disabled value="" id='reported'>
    </div>
    <div class='form-field'>
      <label for="">Motivo</label>
      <input type="text" disabled value="" id='reason'>
    </div>
    <div class='form-field'>
      <label for="">Descrição</label>
      <textarea name="name" disabled rows="8" cols="80" id='desc'></textarea>
    </div><br>
    <div class='form-field'>
      <button class='btn btn-light shield'>Redefinir Escudo</button>
      <button class='btn btn-light money'>Multa 10M</button>
      <button class='btn btn-danger ban'>Banir</button>
    </div>
    <label class="modal-close" for="modal_report"></label>
  </div>
  <div class='modal-pattern'></div>
</div>
