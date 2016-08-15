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
	// 4=>array('href'=>'/quickmatch/','text'=>'Partidas rápidas'),
	5=>array('href'=>'/ranking/','text'=>'Ranking de clubes')
),
'players'=>array(
	0=>array('href'=>'/players/','text'=>'Plantel'),
	1=>array('href'=>'/tactics/','text'=>'Táticas'),
	3=>array('href'=>'/training/','text'=>'Treinamento'),
	2=>array('href'=>'/dev/','text'=>'Categorias de Base'),
)
);
?>
<header>
	<nav>
		<ul class='submenu'>
			<?
			$i=0;
			foreach ($menu[$this->data['menu']] as $key) {
				if($i==$this->data['submenu']){
					$class='selected';
				}else{
					$class='';
				}
				echo "<li><a href='".$key['href']."' class='".$class."'>".$key['text']."</a></li>";
				$i++;
			}

			?>
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
