<main>
	<div class='content'>
    <h3 class='title'>Opções de conta</h3>
    <div class='box grid-95'>
      <div class='box-title'>Fuso Horário e Idioma</div>
      <div class='box-content padding-left'>
        <h4>Se o seu idioma ainda não está disponível, entre em contato com nossos administradores para virar um tradutor</h4>
				<form action='<?=$this->data['tree']?>account/save' method='POST'>
        <input type='hidden' name='type' value='timezoneandlanguage'>
        <div class='form-field'>
          <label>Fuso Horário:</label>
          <select name='timezone'>
            <?
						$account=Account::getAccount($_SESSION['SL_account']);
						foreach ($this->data['timezones'] as $key) {               ?>
              <option <? if($account->timezone==$key['id_timezone'])echo 'selected';?> value='<?=$key['id_timezone']?>'><?=$key['timezone']?></option>
            <? } ?>
          </select>
        </div>
        <div class='form-field'>
          <label>Idioma</label>
          <select name='language'>
            <? foreach ($this->data['languages'] as $key) {               ?>
              <option value='<?=$key['id_language']?>'><?=$key['language']?></option>
            <? } ?>
          </select>
        </div>
        <div class='form-field left'>
          <button class='btn bg-success' type='submit'>Salvar</button>
        </div>
        </form>
      </div>
    </div>
		<div class='box grid-95'>
      <form action='<?=$this->data['tree']?>account/save' method='POST'>
      <input type='hidden' name='type' value='email'>
			<div class='box-title'>Alterar email</div>
			<div class='box-content padding-left'>
				<div class='form-field'>
          <h4>Note que você usa o email para se logar no site</h4>
					<label>Email:</label>
					<input type="hidden" name="oldemail" value='<?=$this->data['email']?>'>
					<input type="text" name="email" value='<?=$this->data['email']?>' placeholder="Digite o email">
				</div>
        <div class='form-field'>
					<label>Senha atual:</label>
					<input type="password" name="password" placeholder="Digite sua senha atual">
				</div>
				<div class='form-field left'>
					<button class='btn bg-success' type='submit'>Salvar</button>
				</div>
			</div>
			</form>
		</div>
		<div class='box grid-95'>
			<form autocomplete='off' action='<?=$this->data['tree']?>account/save' method='POST'>
      <input type='hidden' name='type' value='password'>
			<div class='box-title'>Alterar a senha</div>
			<div class='box-content padding-left'>
				<div class='form-field'>
					<label>Senha atual:</label>
					<input type="hidden" name="oldemail" value='<?=$this->data['email']?>'>
					<input type="password" autocomplete='new-password' value='' name="oldpassword" placeholder="Digite sua senha atual">
				</div>
        <div class='form-field'>
					<label>Nova senha:</label>
					<input type="password" autocomplete='off' value='' name="newpassword" placeholder="Digite a nova senha">
				</div>
				<div class='form-field'>
					<label>Repetir nova senha:</label>
					<input type="password" autocomplete='off' value='' name="newpasswordR" placeholder="Repita a nova senha">
				</div>
        <div class='form-field left'>
          <button class='btn bg-success' type='submit'>Salvar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</main>
