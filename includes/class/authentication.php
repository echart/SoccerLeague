<?

class Authentication{
	public $login;
	public $id_account;
	public $password;
	public $conn;

	function __construct($con,$e,$p){
		$this->login=$e;
		$this->password=$p;
		$this->conn=$con;
		session_start();
	}

	public function verifyAuthentication(){
	
	}
	public function getAccountId():int{
		return $_SESSION['SL_account'];
	}
}

class Login{
	public $login;
	public $id_account;
	public $password;
	public $conn;

	function __construct($con,$e,$p){
		$this->login=$e;
		$this->password=$p;
		$this->conn=$con;
		session_start();
	}

	public function verifyLogin(){
		$query=pg_query($this->conn, "SELECT password, id_account FROM account where email ='".$this->login."'");
		if(pg_num_rows($query)>0){
			$data=pg_fetch_array($query);
			$hash=$data['password'];
			if(password_verify($this->password, $hash)){
				$this->id_account=$dados['id_account'];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function login():boolean{
		$_SESSION['SL_session']=session_id();
		$_SESSION['SL_login']=$this->login;
		$_SESSION['SL_account']=$this->id_account;
		return true;
	}
	public function getAccountId():int{
		return $this->id_account;
	}
}