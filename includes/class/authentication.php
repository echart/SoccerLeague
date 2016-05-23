<?

class Authentication{
	public $login;
	public $id_account;
	public $password;
	public $conn;
	function __construct($c){
		$this->conn=$c;
	}
	public function verifyAuthentication():bool{
			$session=$_SESSION['SL_session'] ?? 'null';

			$query=Connection::connect()->prepare("SELECT valid FROM session WHERE session=:session and valid='true'");
			$query->bindParam(':session',$session);
			$query->execute();

			if($query->rowCount()>0) return true;
			else return false;
	}

	public function getAccountId():int{
		return $_SESSION['SL_account'];
	}
	public function logout(){
		// remove valid of the session table
		$query=Connection::connect()->prepare("UPDATE session SET valid='FALSE' where session=:session and id_account=:id_account");

		$query->bindParam(':session',session_id());
		$query->bindParam(':id_account',$_SESSION['SL_account']);

		$query->execute();
		//remove the session data
		$_SESSION['SL_login']='';
		$_SESSION['SL_account']='';

		//destroy session data
		session_destroy();
		//move uer back to home page
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
		
		$query=Connection::connect()->prepare("SELECT password, id_account FROM account where email=:email");
		$query->bindParam(':email',$this->login);

		$query->execute();

		if($query->rowCount()>0){
			$query->setFetchMode(PDO::FETCH_OBJ);

			$data=$query->fetch();
			$hash=$data->password;
			if(password_verify($this->password, $hash)){
				$this->id_account=$data->id_account;
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
		session_regenerate_id();

		$_SESSION['SL_session']=session_id();
		$_SESSION['SL_login']=$this->login;
		$_SESSION['SL_account']=$this->id_account;

		try{
			$query=Connection::connect()->prepare("INSERT INTO session (id_account,session,valid) values (:id_account, :session,:valid)");
			
			$query->bindParam(':id_account',$this->id_account);
			$query->bindParam(':session',session_id());
			$query->bindParam(':valid','true');

			$query->execute();
		}catch(PDOException $e){
			return false;
			exit;
		}finally{
			return true;
		}
	}
	public function getAccountId():int{
		return $this->id_account;
	}
}