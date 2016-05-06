<?
namespace classes
/*
======
connection with database class
======
*/
class Connection{
	public $database;
	public $host;
	public $port;
	private $password;
	private $user;
	public $con;
	public function __construct($h='localhost', $p='5432', $db='sltest', $u='postgres', $pass='#echart84015521'){
		$this->host=$h;
		$this->port=$p;
		$this->database=$db;
		$this->user=$u;
		$this->password=$pass;
	}

	public function connect(){ /*open connection */
		
		try{
			$c=pg_connect('host='.$this->host.' port='.$this->port.' dbname='.$this->database.' user='.$this->user.' password='.$this->password);
			if(!$c){
				throw new Exception("Erro ao conectar ao banco de dados", 1);
			}else{
				$this->con=$c;
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
		return $this->con;
	}

	public function getDatabase():string{
		return $this->database;
	}

	public function disconnect(){ /*close connection*/
		try{
			$x=pg_close($this->con);
			if(!$x){
				throw new Exception("Erro ao desconectar ao banco de dados", 1);
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}
$c=new Connection();
$c->connect();
