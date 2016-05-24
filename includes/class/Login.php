<?php

class Login{
	public $login;
	public $id_account;
	public $password;

	function __construct($e,$p){
		$this->login=$e;
		$this->password=$p;
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
			$query=Connection::connect()->prepare("INSERT INTO session(id_account,session,valid) values (:id_account, '".session_id()."','true')");
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