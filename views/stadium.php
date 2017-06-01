<div class='content'>
  <h1 class='page-title'><?=$this->title?></h1>
  <div class='byte'>
    <div class='bit-1'>
      <? if($this->id_club!=$_SESSION['SL_club']){?>
        <div class='bit-2'>
          <div class='box'>
            <div class='box-title'>Estádio</div>
            <div class='box-content'>
              <table class='table'>
                <tbody>
                  <tr><td>Capacidade do Estádio:</td><td><?=$this->capacity?></td></tr>
                  <tr><td>Drenagem:</td><td><?=$this->facilities->draining?></td></tr>
                  <tr><td>Refletores:</td><td><?=$this->facilities->lights?></td></tr>
                  <tr><td>Cobertura do Gramado:</td><td><?=$this->facilities->cover?></td></tr>
                  <tr><td>Aquecimento:</td><td><?=$this->facilities->heating?></td></tr>
                  <tr><td>Irrigadores:</td><td><?=$this->facilities->sprinklers?></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class='bit-2'>
          <div class='box'>
            <div class='box-title'>Instalações</div>
            <div class='box-content'>
              <table class='table'>
                <tbody>
                  <tr><td>Centro de Treinamento:</td><td><?=$this->facilities->tg?></td></tr>
                  <tr><td>Academia de Juniores:</td><td><?=$this->facilities->yd?></td></tr>
                  <tr><td>Centro Médico:</td><td><?=$this->facilities->medical?></td></tr>
                  <tr><td>Fisioterapia:</td><td><?=$this->facilities->physio?></td></tr>
                  <tr><td>Estacionamento:</td><td><?=$this->facilities->parking?></td></tr>
                  <tr><td>Banheiros:</td><td><?=$this->facilities->toilets?></td></tr>
                  <tr><td>Barraca de Cachorro Quente:</td><td><?=$this->facilities->hotdog?></td></tr>
                  <tr><td>Loja do Clube:</td><td><?=$this->facilities->store?></td></tr>
                  <tr><td>Restaurante:</td><td><?=$this->facilities->restaurant?></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?}else{?>
        <div class='bit-3 box'>
          <div class='box-title'>Capacidade</div>
          <div class="box-content">
            <p>Capacidade Atual: <strong><?=$this->capacity?></strong></p>
            <p>Custo de Construção por assento: $ 250</p>
            <p>Manutenção por assento: $ 200</p>
            <p>
              <button type="button" class='capacity btn btn-success' name="button">Expandir</button>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Drenagem</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->draining?></strong></p>
            <p>Custo de Construção: $ 1.000.000</p>
            <p>Manutenção: $ 100.000</p>
            <p>
              <?if($this->facilities->draining>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","draining")'>Diminuir</button><?}?>
              <?if($this->facilities->draining<1){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","draining")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Cobertura do Gramado</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->cover?></strong></p>
            <p>Custo de Construção: $ 1.000.000</p>
            <p>Manutenção: $ 75.000</p>
            <p>
              <?if($this->facilities->cover>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","cover")'>Diminuir</button><?}?>
              <?if($this->facilities->cover<1){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","cover")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Refletores</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->lights?></strong></p>
            <p>Custo de Construção: $ 2.000.000</p>
            <p>Manutenção: $ 200.000</p>
            <p>
              <?if($this->facilities->lights>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","lights")'>Diminuir</button><?}?>
              <?if($this->facilities->lights<1){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","lights")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Irrigadores</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->sprinklers?></strong></p>
            <p>Custo de Construção: $ 1.000.000</p>
            <p>Manutenção: $ 100.000</p>
            <p>
              <?if($this->facilities->sprinklers>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","sprinklers")'>Diminuir</button><?}?>
              <?if($this->facilities->sprinklers<1){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","sprinklers")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Aquecimento</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->heating?></strong></p>
            <p>Custo de Construção: $ 1.000.000</p>
            <p>Manutenção: $ 350.000</p>
            <p>
              <?if($this->facilities->heating>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","heating")'>Diminuir</button><?}?>
              <?if($this->facilities->heating<1){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","heating")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Centro de Treinamento</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->tg?></strong></p>
            <p>Custo de Construção: $ 8.000.000</p>
            <p>Manutenção: $ 1.250.000 por nível</p>
            <p>
              <?if($this->facilities->tg>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","tg")'>Diminuir</button><?}?>
              <?if($this->facilities->tg<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","tg")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Academia de Juniores</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->yd?></strong></p>
            <p>Custo de Construção: $ 8.000.000</p>
            <p>Manutenção: $ 1.250.000 por nível</p>
            <p>
              <?if($this->facilities->yd>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","yd")'>Diminuir</button><?}?>
              <?if($this->facilities->yd<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","yd")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Centro Médico</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->medical?></strong></p>
            <p>Custo de Construção: $ 525.000 por nível</p>
            <p>Manutenção: $ 475.000 por nível</p>
            <p>
              <?if($this->facilities->medical>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","medical")'>Diminuir</button><?}?>
              <?if($this->facilities->medical<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","medical")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Fisioterapia</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->physio?></strong></p>
            <p>Custo de Construção: $ 325.000 por nível</p>
            <p>Manutenção: $ 275.000 por nível</p>
            <p>
              <?if($this->facilities->physio>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","physio")'>Diminuir</button><?}?>
              <?if($this->facilities->physio<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","physio")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Estacionamento</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->parking?></strong></p>
            <p>Custo de Construção: $ 325.000 por nível</p>
            <p>Manutenção: $ 375.000 por nível</p>
            <p>
              <?if($this->facilities->parking>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","parking")'>Diminuir</button><?}?>
              <?if($this->facilities->parking<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","parking")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Banheiros</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->toilets?></strong></p>
            <p>Custo de Construção: $ 325.000 por nível</p>
            <p>Manutenção: $ 375.000 por nível</p>
            <p>
              <?if($this->facilities->toilets>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","toilets")'>Diminuir</button><?}?>
              <?if($this->facilities->toilets<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","toilets")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Barraca de Cachorro Quente</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->hotdog?></strong></p>
            <p>Custo de Construção: $ 75.000 por nível</p>
            <p>Manutenção: $ 35.000 por nível</p>
            <p>
              <?if($this->facilities->hotdog>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","hotdog")'>Diminuir</button><?}?>
              <?if($this->facilities->hotdog<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","hotdog")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Loja do Clube</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->store?></strong></p>
            <p>Custo de Construção: $ 125.000 por nível</p>
            <p>Manutenção: $ 100.000 por nível</p>
            <p>
              <?if($this->facilities->store>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","store")'>Diminuir</button><?}?>
              <?if($this->facilities->store<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","store")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
        <div class='bit-3 box'>
          <div class='box-title'>Restaurante</div>
          <div class="box-content">
            <p>Nível Atual: <strong><?=$this->facilities->restaurant?></strong></p>
            <p>Custo de Construção: $ 125.000 por nível</p>
            <p>Manutenção: $ 75.000 por nível</p>
            <p>
              <?if($this->facilities->restaurant>0){?><button type="button" class='btn btn-danger' name="button"onclick='facilitie("downgrade","restaurant")'>Diminuir</button><?}?>
              <?if($this->facilities->restaurant<10){?><button type="button" class='btn btn-success' name="button" onclick='facilitie("upgrade","restaurant")'>Expandir</button><?}?>
            </p>
          </div>
        </div>
      <?}?>
    </div>
  </div>
</div>
<!-- MODAL capacity -->
<input type="checkbox" id="modal_capacity" />
<div class="modal modal-capacity">
  <div class="modal-content">
    <form action='javascript:capacity()'>
      <div class='form-field'>
          <label for="reason">Capacidade Atual:</label>
          <input type="text" id='old_capacity' name="" disabled value="<?=$this->capacity?>">
      </div>
      <div class='form-field'>
        <label for="description">Nova Capacidade:</label>
        <input id='new_capacity' type='text' class='numeric' name="new_capacity" placeholder="Nova Capacidade">
      </div>
      <div class='form-field'>
        <p class='construction-capacity'>Custo de construção: <strong>$ 0</strong></p>
        <p class='response'></p>
      </div>
      <div class='form-field'>
        <button type='submit' class='btn btn report'>Alterar</button>
      </div>
    </form>
    <label class="modal-close" for="modal_capacity"></label>
  </div>
  <div class='modal-pattern'></div>
</div>
