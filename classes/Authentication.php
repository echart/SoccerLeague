<?

class Authentication{
	private $login;
	private $password;
	private $con;

	public function __construct(){
		session_start();
		$this->con=Connection::getInstance()->connect();
	}
	public function verifyAuthentication():bool{
		$session=$_SESSION['SL_session'] ?? 'null';
		$query=$this->con->prepare("SELECT valid FROM session WHERE session=:session and valid='true'");
		$query->bindParam(':session',$session);
		$query->execute();

		if($query->rowCount()>0) return true;
		else return false;
	}
	public function verifyLogin($email,$password):bool{

		$query=$this->con->prepare("SELECT password, id_account FROM account where email=:email");
		$query->bindParam(':email',$email);

		$query->execute();

		if($query->rowCount()>0){
			$query->setFetchMode(PDO::FETCH_OBJ);

			$data=$query->fetch();
			$hash=$data->password;
			if(password_verify($password, $hash)){
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
		$id_club=Club::getClubByAccountId($this->id_account);
		$_SESSION['SL_session']=session_id();
		$_SESSION['SL_login']=$this->login;
		$_SESSION['SL_account']=$this->id_account;
		$_SESSION['SL_club']=$id_club;
		/**
		 * return div and group for the session
		 */
		$query=$this->con->prepare("SELECT division,divgroup FROM league l inner join league_table lt using(id_league) where lt.id_club=:id_club order by lt.id_league_table desc limit 1");
		$query->bindParam(':id_club',$id_club);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
		$_SESSION['SL_div']=$data->division;
		$_SESSION['SL_group']=$data->divgroup;

		$query=$this->con->prepare("SELECT abbreviation from country inner join club using(id_country) where id_club=:id_club");
		$query->bindParam(':id_club',$id_club);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
		$_SESSION['SL_country']=$data->abbreviation;
		/**
		 * insert session in db for authentication
		 */
		try{
			# disable all session before insert a new session(this delete the possibility that two people logged in same club in same time)
			$query=$this->con->prepare("UPDATE session SET valid='false' where id_account=:id_account");
			$query->bindParam(':id_account',$this->id_account);
			$query->execute();
			# insert a new valid session id in database
			$query=$this->con->prepare("INSERT INTO session(id_account,session,valid,ip) values (:id_account, '".session_id()."','true','".self::ip()."')");
			$query->bindParam(':id_account',$this->id_account);
			$query->execute();
		}catch(PDOException $e){
			return false;
			exit;
		}finally{
			return true;
		}
	}
	public function logout(){
		// remove valid of the session table
		$query=$this->con->prepare("UPDATE session SET valid='FALSE' where session=:session and id_account=:id_account");

		$query->bindParam(':session',session_id());
		$query->bindParam(':id_account',$_SESSION['SL_account']);

		$query->execute();
		//remove the session data
		$_SESSION['SL_login']='';
		$_SESSION['SL_account']='';

		//destroy session data
		session_destroy();
		//move user back to home page
		header('location: http://' . $_SERVER['SERVER_NAME']);
	}
}
