<?
/** 
 * Connection Class
 * you can use it like this Connection::connect();
 */
class Connection{
	public $database='sltest';
	public static $con;
	/**
	 * @return Connection
	 */
	public static function connect(){ /*open connection */
		
		try{
			Connection::$con = new PDO('pgsql:dbname=sltest;host=45.55.144.56;user=postgres;password=#echart84015521');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		return Connection::$con;
	}

	public static function getDatabase():string{
		return Connection::$database;
	}

	public static function disconnect(){ /*close connection*/
		Connection::$con=null;
	}
}