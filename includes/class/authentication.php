<?

class Authentication{
	public $login;
	public $password;
	public $session;
	public $conn;

	function __construct($con,$e,$p){
		$this->login=$e;
		$this->password=$p;
		$this->conn=$con;
	}
	public function checkAuthentication(){
		$query=pg_query($this->conn, "SELECT password FROM account where email ='".$this->login."'");
		if(pg_num_rows($query)>0){
			$data=pg_fetch_array($query);
			$hash=$data['password'];
			if(password_verify($this->password, $hash)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function login():boolean{
		
	}
	public function getAccountId():string{

	}
}
