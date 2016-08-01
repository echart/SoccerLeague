<main>
	<div class='content'>
    <section class='grid-100'>
      <form>
        <h3>Editar clube</h3>
        <div class='form-field'>
          <label>Nome do clube:</label>
          <input type="text" name="name" value='<?=$this->data['clubname']?>' placeholder="Digite o nome do seu clube">
        </div>
        <div class='form-field'>
          <label>Apelido:</label>
          <input type="text" name="name" value='<?=$this->data['clubinfo']['nickname']?>' placeholder="Digite o apelido do seu clube">
        </div>
        <div class='form-field'>
          <label>Manager:</label>
          <input type="text" name="name"  value='<?=$this->data['clubinfo']['manager']?>' placeholder="Manager">
        </div>
        <div class='form-field'>
          <label>Estádio:</label>
          <input type="text" name="name"  value='<?=$this->data['clubinfo']['stadium']?>' placeholder="Nome do estádio">
        </div>
        <div class='form-field'>
          <label>Torcida:</label>
          <input type="text" name="name"  value='<?=$this->data['clubinfo']['fansname']?>' placeholder="Nome da sua torcida organizada">
        </div>
        <div class='form-field right'>
          <button class='btn bg-success' type='button'>Salvar</button>
        </div>
    </section>
  </div>
</main>
