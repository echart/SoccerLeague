<?

class menu{
	public $selected=0;
	public $principal=0;
	public static $menu=array(
		'home'=>array(
				0=>array('href'=>'/home/','text'=>'Home'),
				1=>array('href'=>'/calendar/','text'=>'Calendário'),
				2=>array('href'=>'/messages/','text'=>'Mensagens')
		),
		'club'=>array(
				0=>array('href'=>'/club/','text'=>'Clube'),
				1=>array('href'=>'/club/12/overview/','text'=>'Visão Geral'),
				2=>array('href'=>'/club/12/matches/','text'=>'Partidas'),
				3=>array('href'=>'/club/12/statistics/','text'=>'Estatísticas'),
				4=>array('href'=>'/club/12/history/','text'=>'Histórico'),
				5=>array('href'=>'/club/12/stadium/','text'=>'Estádio')
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
		)/*,
		''=>array('submenu'=>
			array(
				0=>array('href'=>'','text'=>''),

			)
		)*/
	);

	function __construct($p,$s){
		$this->principal=$p;
		$this->selected=$s;
	}

	function display(){
		$i=0;
		foreach (menu::$menu[$this->principal] as $key) {
			if($i==$this->selected){
				$class='selected';
			}else{
				$class='';
			}
			echo "<li><a href='".$key['href']."' class='".$class."'>".$key['text']."</a></li>";
			$i++;
		}
	}
}
