<header>
	<input type="checkbox" class="menu-mobile" id='menu-mobile'/>
	<label class='menu-mobile' for='menu-mobile'><i></i></label>
	<label class='config' for='menu-mobile'><i></i></label>
	<ul class='submenu'>
		<? $submenu->display(); ?>
	</ul>
</header>
<div class='menu-sidebar'>
	<!-- <div class='logo'><i></i></div> -->
	<ul class='menu'>
		<li><a class='home' href=''><i></i><span>Sede</span></a></li>
		<li><a class='club border' href=""><i></i><span>Clube</span></a>
		<li><a class='squad' href=""><i></i><span>Equipe</span></a></li>
		<li><a class='tactic border' href=""><i></i><span>Táticas</span></a></li>
		<li><a class='calendar' href=""><i></i><span>Calendário</span></a></li>
		<li><a class='league border' href=""><i></i><span>Competições</span></a></li>
		<li><a class='finance' href=""><i></i><span>Finanças</span></a></li>
		<li><a class='transfer border' href=""><i></i><span>Transferências</span></a></li>
		<li><a class='community' href=""><i></i><span>Comunidade</span></a></li>
		<li><a class='pm border' href=""><i></i><span>Mensagens</span><span class='qtd'>0</span></a></li>
		<li><a class='pro' href=""><i></i><span>PRO</span><span class='qtd'>365 dias</span></a></li>
<!-- 		<li><a class='account border' href=""><i></i><span>Conta</span></a></li>
 -->		<li><a class='logoff border' href="<?=$tree.'logout.php'?>"><i></i><span>Sair</span></a></li>
	</ul>
</div>