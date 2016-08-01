<main>
	<div class='content'>
    <section class='grid-95'>
      <form action='<?=$this->data['tree']?>club/<?=$_SESSION['SL_club']?>/save' method='POST'>
        <h3>Editar clube</h3>
        <!-- <div class='form-field'>
          <label>Nome do clube:</label>
          <input type="text" name="name" value='<?=$this->data['clubname']?>' placeholder="Digite o nome do seu clube">
        </div> -->
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
          <textarea name="clubcolor"><?=$this->data['clubinfo']['history']?></textarea>
        </div>
				<div class='form-field'>
          <label>Logo:</label>
          <img src='<?=$this->data['tree']?>assets/img/logos/<?=$this->data['clubinfo']['logo']?>' width="200px" height="200px">
        </div>
				<div class='form-field'><br>
					<input type="file" id="logo" name="logo" />
				</div>
        <div class='form-field right'>
          <button class='btn bg-success' type='submit'>Salvar</button>
        </div>
    </section>
  </div>
</main>
