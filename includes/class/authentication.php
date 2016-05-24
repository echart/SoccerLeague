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