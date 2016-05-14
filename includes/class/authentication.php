<?

class Authentication{
	public $login;
	public $id_account;
	public $password;
	public $conn;

	public function verifyAuthentication():bool{
		if(isset($_SESSION['SL_session'])){
			$query=pg_query("SELECT valid FROM session WHERE session='".$_SESSION['SL_session']."' and valid='true'");
			if(pg_num_rows($query)>0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getAccountId():int{
		return $_SESSION['SL_account'];
	}

	public function logout(){
		$query=pg_query("UPDATE session SET valid='false' where session='".session_id()."' and session='".$_SESSION['SL_login']."'");
		//remove the session data
		$_SESSION['SL_login']='';
		$_SESSION['SL_account']='';

		//destroy session data
		session_destroy();
		//move uer back to the initial page
		header('location: http://' . $_SERVER['SERVER_NAME']);
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
	}

	public function verifyLogin():bool{
		$query=pg_query($this->conn, "SELECT password, id_account FROM account where email ='".$this->login."'");
		if(pg_num_rows($query)>0){
			$data=pg_fetch_array($query);
			$hash=$data['password'];
			if(password_verify($this->password, $hash)){
				$this->id_account=$data['id_account'];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function login():bool{
		session_start();
		$_SESSION['SL_session']=session_id();
		$_SESSION['SL_login']=$this->login;
		$_SESSION['SL_account']=$this->id_account;

		$query=pg_query($this->conn, "INSERT INTO session (id_account,session,valid) values ('".$this->id_account."', '".session_id()."','true')");
		return true;
	}
	public function getAccountId():int{
		return $this->id_account;
	}
}