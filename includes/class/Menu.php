<?

class menu{
	public $selected=0;
	public $principal=0;
	public static $menu=array(
		'home'=>array(
				0=>array('href'=>'calendar.php?','text'=>'Calendário'), 
				1=>array('href'=>'index.php','text'=>'Feed')
		),
		'club'=>array(
				0=>array('href'=>'index.php','text'=>'Clube'), 
				1=>array('href'=>'players.php','text'=>'Visão Geral'),
				2=>array('href'=>'matches.php','text'=>'Partidas'),
				3=>array('href'=>'statistics.php','text'=>'Estatísticas'),
				4=>array('href'=>'history.php','text'=>'Histórico'),
				5=>array('href'=>'stadium.php','text'=>'Estádio')
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