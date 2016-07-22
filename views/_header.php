<header>
	<input type="checkbox" class="menu-mobile" id='menu-mobile'/>
	<label class='menu-mobile' for='menu-mobile'><i></i></label>
	<label class='config' for='menu-mobile'><i></i></label>
	<ul class='submenu'>
		<?
		 $submenu = new Menu($this->data['menu'],0);
		 $submenu->display(); ?>
	</ul>
</header>
<div class='menu-sidebar'>
	<div class='logo'><i></i></div>
	<ul class='menu'>
		<li><a class='home' href='<?=$this->data['tree']?>home/'><i></i><span>Visão geral</span></a></li>
		<li><a class='club border' href="<?=$this->data['tree']?>club/"><i></i><span>Clube</span></a>
		<li><a class='squad' href="<?=$this->data['tree']?>players/"><i></i><span>Equipe</span></a></li>
		<li><a class='league border' href="<?=$this->data['tree']?>league/"><i></i><span>Competições</span></a></li>
		<li><a class='transfer border' href=""><i></i><span>Mercado</span></a></li>
		<li><a class='community' href=""><i></i><span>Comunidade</span></a></li>
		<li><a class='pro' href=""><i></i><span>PRO</span><span class='qtd'>365 dias</span></a></li>
<!-- 	<li><a class='account border' href=""><i></i><span>Conta</span></a></li>-->
		<li><a class='logoff border' href="<?=$this->data['tree']?>logout/"><i></i><span>Sair</span></a></li>
	</ul>
</div>
