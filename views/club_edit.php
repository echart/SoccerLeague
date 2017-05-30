<style>.logo{background-image:url('../../../assets/img/logos/<?=$this->data['clubinfo']->logo?>')}</style>
<main>
	<div class='content'>
		<div class='box grid-95'>
			<div class='box-title'>Editar clube</div>
			<div class='box-content padding-left'>
				<form action='<?=$this->tree?>club/<?=$_SESSION['SL_club']?>/edit' method='POST' enctype="multipart/form-data">
					<input type="hidden" name="save">
					<div class='form-field'>
						<label>Nome do clube <small>(Serão descontados 15 PRO da sua conta por mudança)</small><img width='18px' src='<?=$this->tree?>assets/img/icons/coin.png'><small class='pro'>PRO</small></label>
						<input type="text" name="clubname" value='<?=$this->data['clubinfo']->club->clubname?>' placeholder="Nome do Clube">
					</div>
					<div class='form-field'>
						<label>Apelido:</label>
						<input type="text" name="nickname" value='<?=$this->data['clubinfo']->nickname?>' placeholder="Digite o apelido do seu clube">
					</div>
					<div class='form-field'>
						<label>Manager:</label>
						<input type="text" name="manager"  value='<?=$this->data['clubinfo']->manager?>' placeholder="Manager">
					</div>
					<div class='form-field'>
						<label>Estádio:</label>
						<input type="text" name="stadium"  value='<?=$this->data['clubinfo']->stadium?>' placeholder="Nome do estádio">
					</div>
					<div class='form-field'>
						<label>Torcida:</label>
						<input type="text" name="fansname"  value='<?=$this->data['clubinfo']->fansname?>' placeholder="Nome da sua torcida organizada">
					</div>
					<div class='form-field'>
						<label>Cor principal:</label>
						<input type="color" name="primaryColor">
					</div>
					<div class='form-field'>
						<label>História do clube:</label>
						<textarea name="history"><?=$this->data['clubinfo']->history?></textarea>
					</div>
					<div class='form-field'>
						<label>Escudo <img width='18px' src='<?=$this->tree?>assets/img/icons/coin.png'><small class='pro'>PRO</small>: <small>(no momento, apenas imagens com proporção 200x200 são permitidas)</small> </label>
						<input type='file' name='logo'><br>
						<img src="<?=$this->tree?>assets/img/club_pics/<?=$this->data['clubinfo']->logo?>" width="200px" height="200px">
					</div>
					<div class='form-field'>
						<BR><BR><bR>
						<button class='btn btn-success' type='submit'>Salvar</button>
					</div>
				</form>
			</div>
		</div>
  </div>
</main>
<script type="text/javascript">
	document.querySelector('input[type="color"]').value = '<?=$this->data['clubinfo']->primaryColor?>';
</script>
