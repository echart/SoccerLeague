<?
/**
 * @author Willians Echart
 */
class Connection{
	public $database='sltest';
	public static $con;

	public static function connect(){ /*open connection */
		
		try{
			Connection::$con = new PDO('pgsql:dbname=sltest;host=localhost;user=postgres;password=#echart84015521');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		return Connection::$con;
	}

	public static function getDatabase():string{
		return $this->database;
	}

	public static function disconnect(){ /*close connection*/
		$this->con=null;
	}
}
