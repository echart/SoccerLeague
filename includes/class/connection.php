<?
/**
 * @author Willians Echart
 */
class Connection{
	public $database;
	public $host;
	public $port;
	private $password;
	private $user;
	public static $con;
	public function __construct($h='localhost', $p='5432', $db='sltest', $u='postgres', $pass='#echart84015521'){
		$this->host=$h;
		$this->port=$p;
		$this->database=$db;
		$this->user=$u;
		$this->password=$pass;
	}

	public static function connect(){ /*open connection */
		
		try{
			$this->con = new PDO('pgsql:dbname=sltest;host=localhost;user=postgres;password=#echart84015521');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		return $this->con;
	}

	public function getDatabase():string{
		return $this->database;
	}

	public static function disconnect(){ /*close connection*/
		$this->con=null;
	}
}
