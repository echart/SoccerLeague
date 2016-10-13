<?
$menu=array('home'=>array(
		0=>array('href'=>'/home/','text'=>'Home'),
		1=>array('href'=>'/calendar/','text'=>'Calendário'),
		2=>array('href'=>'/messages/','text'=>'Mensagens')
),
'club'=>array(
		0=>array('href'=>'/club/'.$this->request['id'],'text'=>'Clube'),
		1=>array('href'=>'/club/'.$this->request['id'].'/overview/','text'=>'Visão Geral'),
		2=>array('href'=>'/club/'.$this->request['id'].'/matches/','text'=>'Partidas'),
		3=>array('href'=>'/club/'.$this->request['id'].'/statistics/','text'=>'Estatísticas'),
		4=>array('href'=>'/club/'.$this->request['id'].'/history/','text'=>'Histórico'),
		5=>array('href'=>'/club/'.$this->request['id'].'/stadium/','text'=>'Estádio')
),
'league'=>array(
	0=>array('href'=>'/league/', 'text'=>'Liga'),
	1=>array('href'=>'/cup/','text'=>'Copa'),
	2=>array('href'=>'/friendly-league/','text'=>'Liga Amistosa'),
	4=>array('href'=>'/international/','text'=>'Internacional'),
	3=>array('href'=>'/national-team/','text'=>'Seleção'),
	4=>array('href'=>'/quickmatch/','text'=>'Partidas rápidas'),
	// 5=>array('href'=>'/ranking/','text'=>'Ranking de clubes')
),
'players'=>array(
	0=>array('href'=>'/players/','text'=>'Plantel'),
	1=>array('href'=>'/tactics/','text'=>'Táticas'),
	3=>array('href'=>'/training/','text'=>'Treinamento'),
	2=>array('href'=>'/dev/','text'=>'Categorias de Base'),
),
'options'=>array(
		0=>array('href'=>'/account','text'=>'Opções'),
),
'admin'=>array(
		0=>array('href'=>'/admin','text'=>'Admin'),
)
);
?>
<header>
	<nav>
		<ul class='submenu'>
			<?
			$i=0;
			if(isset($this->menu)){
				foreach ($menu[$this->menu] as $key) {
					if($i==$this->submenu){
						$class='selected';
					}else{
						$class='';
					}
					echo "<li><a href='".$key['href']."' class='".$class."'>".$key['text']."</a></li>";
					$i++;
				}
			}
			?>
		</ul>
		<span alt='Soccer League Time' class='options'><span class='icon clock'></span><?=date('Y-m-d')?> - <strong><span id='sltime'></span></strong></span>
	</nav>
</header>
<aside>
	<div class='menu-sidebar'>
		<div class='logo'><i></i></div>
		<nav>
			<ul class='menu'>
				<li><a class='<? echo($this->menu=='home') ? 'selected' : '' ?> home' href='<?=$this->tree?>home/'><i></i><span>Home</span></a></li>
				<li><a class='<? echo($this->menu=='club') ? 'selected' : '' ?> club border' href="<?=$this->tree?>club/"><i></i><span>Clube</span></a></li>
				<li><a class='<? echo($this->menu=='players') ? 'selected' : '' ?> squad' href="<?=$this->tree?>players/"><i></i><span>Equipe</span></a></li>
				<li><a class='<? echo($this->menu=='league') ? 'selected' : '' ?> league border' href="<?=$this->tree?>league/"><i></i><span>Competições</span></a></li>
				<li><a class='transfer' href=""><i></i><span>Mercado</span></a></li>
				<!-- <li><a class='community' href=""><i></i><span>Comunidade</span></a></li> -->
				<li><a class='pro border' href=""><i></i><span>PRO</span><span class='qtd'><?=$account->getProDays();?> dias</span></a></li>
				<li><a class='<? echo($this->menu=='options') ? 'selected' : '' ?> setting' href="<?=$this->tree?>account/"><i></i><span>Opções</span></a></li>
				<? if($this->isAdmin==true){?>
					<li><a class='<? echo($this->menu=='admin') ? 'selected' : '' ?> admin' href='<?=$this->tree?>admin/'><i></i><span>Administrar</span></a></li>
				<?}?>
				<li><a class='logoff border' href="<?=$this->tree?>logout/"><i></i><span>Sair</span></a></li>
			</ul>
		</nav>
	</div>
</aside>
