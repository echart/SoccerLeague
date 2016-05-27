<?php

class Login{
	private $login;
	public $id_account;
	private $password;
	private $con;
	function __construct($e,$p){
		$this->login=$e;
		$this->password=$p;
		$this->con=Connection::getInstance()->connect();
	}

	public function verifyLogin():bool{
		
		$query=$this->con->prepare("SELECT password, id_account FROM account where email=:email");
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
			$query=$this->con->prepare("INSERT INTO session(id_account,session,valid) values (:id_account, '".session_id()."','true')");
			$query->bindParam(':id_account',$this->id_account);
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