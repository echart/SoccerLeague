<?
/** 
 * Connection Class
 * you can use it like this Connection::getInstance()->connect();
 */
class Connection {
	private $_connection;
	private static $_instance; //The single instance

	private $_host = "45.55.144.56";
	private $_username = "postgres";
	private $_password = "#echart84015521";
	private $_database = "sltest";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		try{
			$this->_connection = new PDO("pgsql:dbname=".$this->_database.";host=".$this->_host.";user=".$this->_username.";password=".$this->_password);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function connect() {
		return $this->_connection;
	}
	public function disconnect(){
		$this->_connection=null;
	}
}