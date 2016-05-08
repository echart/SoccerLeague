<?

class authentication{
	public $login;
	public $password;
	public $session;
	public $conn;

	function __construct($con,$e,$p){
		$this->login=$e;
		$this->password=$p;
	}
	public function checkAuthentication():void{
		$this->conn=query($this->conn, "SELECT * FROM account where email ='".$this->login."' and password='".$this->password."'");
		

	}
	public function login():boolean{
		
	}
	public function getAccountId():string{

	}
}
