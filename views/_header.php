<!--navigation -->
<div class='navbar bit-6'>
	<!-- <div class='soccerleague'></div> -->
	<nav>
		<ul>
			<li><a <?=($this->menu=='home') ? "class='selected'" : '';?> href='<?=$this->tree?>home'><i class='home'></i><span>Home</span></a></li>
			<li><a <?=($this->menu=='club') ? "class='selected'" : '';?> href='<?=$this->tree?>club'><i class='club'></i><span>Clube</span></a></li>
			<li><a <?=($this->menu=='squad') ? "class='selected'" : '';?> href='<?=$this->tree?>players'><i class='squad'></i><span>Equipe</span></a></li>
			<li><a <?=($this->menu=='league') ? "class='selected'" : '';?> href='<?=$this->tree?>league'><i class='league'></i><span>Competições</span></a></li>
			<li><a <?=($this->menu=='transfers') ? "class='selected'" : '';?> href='<?=$this->tree?>transfers'><i class='market'></i><span>Mercado</span></a></li>
			<li><a <?=($this->menu=='forum') ? "class='selected'" : '';?> href='<?=$this->tree?>forum'><i class='world'></i><span>Comunidade</span></a></li>
			<li><a <?=($this->menu=='buy-pro') ? "class='selected'" : '';?> href='<?=$this->tree?>PRO'><i class='slpro'></i><span>PRO</span></a></li>
			<?if($this->admin->is_GT()==true){?>
				<li><a <?=($this->menu=='admin') ? "class='selected'" : '';?> href='<?=$this->tree?>admin/statistics'><i class='admin'></i><span>Administrador</span></a></li>
			<?}?>
			<li><a <?=($this->menu=='logout') ? "class='selected'" : '';?> href='<?=$this->tree?>logout'><i class='exit'></i><span>Sair</span></a></li>
		</ul>
	</nav>
</div>
<!--header-->
<header>
	<div class='menu-mobile'>
		<div class='bar1'></div>
		<div class='bar2'></div>
		<div class='bar3'></div>
	</div>
	<?
	$arraySubmenu = array();
	$arraySubmenu['home'] = array(array('Home','home')/*,array('Calendário','calendar'),array('Mensagens','messages')*/);
	$arraySubmenu['club'] = array(array('Clube','club'),array('Finanças','finances'),array('Estádio','stadium'),array('Patrocinadores','sponsor'));
	$arraySubmenu['squad'] = array(array('Jogadores','players'),array('Táticas','tactics'),array('Treinamento','training'),array('Categoria de Base','youthdevelopment'));
$arraySubmenu['league'] = array(array('Liga','league')/*,array('Liga amistosa','friendlyleague'),array('Copa','cup')*/);
	$arraySubmenu['transfers'] = array(array('Transferências','tranfers'),array('Lista de Observação','watchlist'),array('Olheiros','scouts'));
$arraySubmenu['buy-pro'] = array(array('Sobre PRO','PRO')/*,array('O que é PRO?','about-pro')*/);
	$arraySubmenu['forum'] = array(array('Fórum','forum'), array('Manual do jogo','guide'),array('Sobre o SL','about'));
	$arraySubmenu['admin'] = array(array('Estatísticas','admin/statistics'),array('Denúncias','admin/reports'));
	?>
	<ul class='submenu'>
		<?
		foreach ($arraySubmenu[$this->menu] as $array) {
			$class='';
			if($this->submenu == $array[1])
				$class="class='selected'";
			echo "<li><a $class href='".$this->tree.$array[1]."'>".$array[0]."</a></li>";
		}
		?>
	</ul>
	<div class='submenu-mobile'></div>
</header>
