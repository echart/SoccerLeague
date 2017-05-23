<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <div class='box'>
        <div class='box-title'>
          Adicionar
        </div>
        <div class='box-content'>
          <form name='add' action=''>
          <div class='form_field'>
            <label>ID Clube:</label>
            <input type='text' name='id_club' placeholder="ID Clube" pattern="\d*" title="ID CLUB">
          </div>
          <div class='form_field'>
            <label>Permissão:</label><br><br>
            <input type="checkbox" name="permission" value="FT"> Forum Adm.<br>
            <input type="checkbox" name="permission" value="GT"> Game Adm. <br>
            <input type="checkbox" name="permission" value="LT"> Tradutor
          </div>
          <div class='form_field'>
            <button type='button' class='btn btn-light' type='reset'>Limpar</button>
            <button type='button' class='btn' id='save'>Salvar</button>
          </div>
          </form>
        </div>
      </div>
      <div class='box'>
        <div class='box-title'>
          Permissões
        </div>
        <div class='box-content'>
          <table class='table is-bordered'>
            <thead>
              <tr>
                <th width='75%'>Clube</th>
                <th colspan="2">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?
              foreach ($this->data['club'] as $club){?>
              <tr club='<?=$club['id_account']?>'>
                <td>
                  <span class="tooltip tooltip-effect-1" club='<?=$club['id_club']?>'>
                  <span class="tooltip-item"><a href='<?=$this->tree?>club/<?=$club['id_club']?>'><?=$club['clubname']?></a></span>
                    <span class="tooltip-content clearfix">
                        <span class="tooltip-text">Carregando...</span>
                    </span>
                  </span>
                </td>
                <td><a class='btn btn-blue' href="#edit" account='<?=$club['id_account']?>'>Editar</a></td>
                <td><a class='btn btn-danger' href="#delete" account='<?=$club['id_account']?>'>Remover</a></td>
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
