<?
/** 
 * singleton Connection class
 * you can use it like this
 * $con=Connection::getInstance();
 * $query=$con->connect(); and after this, you can use pdo methods like
 * $query->prepare();
 */
class Connection {
	private $connection;
	private static $instance;
	private $_config;
	//method to instance or get an instance
	public static function getInstance() {
		//if this shit does not have an instance, make one
		if(!self::$instance) {
			self::$instance = new self();
		}
		//return instance
		return self::$instance;
	}
	//start connection
	private function __construct() {
		try{
			//load the config file with the database,host,password and user data.
			$this->_config=parse_ini_file('_config.ini');

			//make the connection
			$this->connection = new PDO("pgsql:dbname=".$this->_config['db'].";host=".$this->_config['host'].";user=".$this->_config['user'].";password=".$this->_config['pass']);
		}catch(PDOException $e){
			//if pdo excpetion DIE and show the error
			die('Houve um erro ao se conectar com o banco de dados<br>' . $e->getMessage());
		}catch(Exception $e){
			// if gets an general exception, just show and continues
			echo $e->getMessage();
		}
	}
	//avoid duplicate object
	private function __clone() {}
	//return the connection
	public function connect() {
		return $this->connection;
	}
	//disconnect and  unset $instance
	public function disconnect(){
		//make the connection null
		$this->connection=null;
		//unset instance, it's necessary because if doesn't, you can't connect anymore, because you have an instance but not the connection
		unset($instance);
	}
}