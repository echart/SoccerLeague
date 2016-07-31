<header>
	<nav>
		<ul class='submenu'>
			<?
			 $submenu = new Menu($this->data['menu'],0);
			 $submenu->display(); ?>
		</ul>
		<span alt='Soccer League Time' class='options'><strong><span id='sltime'></span></strong> - <?=date('Y-m-d')?></span>
	</nav>
</header>
<aside>
	<div class='menu-sidebar'>
		<div class='logo'><i></i></div>
		<nav>
			<ul class='menu'>
				<li><a class='home' href='<?=$this->data['tree']?>home/'><i></i><span>Home</span></a></li>
				<li><a class='club border' href="<?=$this->data['tree']?>club/"><i></i><span>Clube</span></a></li>
				<li><a class='squad' href="<?=$this->data['tree']?>players/"><i></i><span>Equipe</span></a></li>
				<li><a class='league border' href="<?=$this->data['tree']?>league/"><i></i><span>Competições</span></a></li>
				<li><a class='transfer' href=""><i></i><span>Mercado</span></a></li>
				<li><a class='community' href=""><i></i><span>Comunidade</span></a></li>
				<li><a class='pro border' href=""><i></i><span>PRO</span><span class='qtd'>365 dias</span></a></li>
				<li><a class='logoff' href="<?=$this->data['tree']?>logout/"><span>Opções</span></a></li>
				<li><a class='logoff border' href="<?=$this->data['tree']?>logout/"><i></i><span>Sair</span></a></li>
			</ul>
		</nav>
	</div>
</aside>
