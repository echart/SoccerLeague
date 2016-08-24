<style>.logo{background-image:url('../../../assets/img/logos/<?=$this->data['clubinfo']['logo']?>')}</style>
<main>
	<div class='content'>
		<div class='box grid-95'>
			<div class='box-title'>Editar clube</div>
			<div class='box-content'>
				<form action='<?=$this->data['tree']?>club/<?=$_SESSION['SL_club']?>/save' method='POST'>
					<div class='form-field'>
						<label>Apelido:</label>
						<input type="text" name="nickname" value='<?=$this->data['clubinfo']['nickname']?>' placeholder="Digite o apelido do seu clube">
					</div>
					<div class='form-field'>
						<label>Manager:</label>
						<input type="text" name="manager"  value='<?=$this->data['clubinfo']['manager']?>' placeholder="Manager">
					</div>
					<div class='form-field'>
						<label>Estádio:</label>
						<input type="text" name="stadium"  value='<?=$this->data['clubinfo']['stadium']?>' placeholder="Nome do estádio">
					</div>
					<div class='form-field'>
						<label>Torcida:</label>
						<input type="text" name="fansname"  value='<?=$this->data['clubinfo']['fansname']?>' placeholder="Nome da sua torcida organizada">
					</div>
					<div class='form-field'>
						<label>Cor principal:</label>
						<input type="color" name="clubcolor" value='<?=$this->data['clubinfo']['clubcolor']?>'>
					</div>
					<div class='form-field'>
						<label>História do clube:</label>
						<textarea name="history"><?=$this->data['clubinfo']['history']?></textarea>
					</div>
					<div class='form-field'>
						<label>Logo: <small>(for better quality, try use 200x200 image)</small></label>
						<div id='logo' class='logo'></div>
					</div>
					<div class='form-field right'>
						<button class='btn bg-success' type='submit'>Salvar</button>
					</div>
				</forn>
			</div>
		</div>
  </div>
</main>
<?
if(isset($this->request['action'])){
	echo "<script>
	window.addEventListener('load', function(){
		newAlert('success','Dados salvos',6000,'top');
	}, false );
	</script>";
}
?>
<!-- http://www.croppic.net/ -->
