<?
class Account{
	public static $instance;

	private $_prodays;
	public $language;
	private $permissions;

	public $id_account;
	private $email;
	private $password;
	private $refeer;

	public function __construct($id=''){
		$this->id_account=$id;

		if($this->id_account!=''){
			$query=Connection::getInstance()->connect()->prepare("SELECT email, refeer,prodays, slvip, language FROM account where id_account=:id");
			$query->bindParam(':id',$this->id_account);
			$query->exec();

			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();


			$this->email=$data->email;
			$this->refeer=$data->refeer;
			$this->language=$data->language;
			$this->_prodays=$data->slvip;

		}else{
			$this->language='en_US';
			$this->_prodays=15;
		}
	}
	public static function getAccount($id=''){
		if($id==''){
			return new self($_SESSION['id_account']);
		}else{
			return new self($id);
		}
	}

	public function setRefeer($id){
		$this->refeer=$id;
	}
	public function getRefeer(){
		return $this->refeer;
	}

	public function setEmail($email){
		$this->email=$email;
	}
	public function getEmail():string{
		return $this->email;
	}

	private function setProDays($days):bool{
		$this->_prodays=$days;
	}
	public function getProDays():int{
		return $this->_prodays;
	}

	public function setPassword($p):bool{
		$this->password=$p;
	}

	public function setLanguage($l):bool{
		$this->language=$l;
	}
	public function getLanguage($l){
		return $this->language;
	}
	private function update():bool{
		try{
			$query= Connection::getInstance()->connect()->prepare("UPDATE account SET email=:email, password=:password, refeer=:refeer, slpro=:prodays, language=:language");
			$query->bindParam(':email',$this->email);
			$query->bindParam(':password',$this->password);
			$query->bindParam(':refeer',$this->refeer);
			$query->bindParam(':language',$this->language);
			$query->bindParam(':prodays',$this->_prodays);

			if($query->execute()) return true; else return false;

		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	private function create(){
		try{
			$query= Connection::getInstance()->connect()->prepare("INSERT INTO account(email, password, refeer, language, slvip) values (:email, :password, :refeer, '1', '15')");
			$query->bindParam(':email',$this->email);
			$query->bindParam(':password',$this->password);
			$query->bindParam(':refeer',$this->refeer);

			$query->execute();
			$this->id_account=Connection::getInstance()->connect()->lastInsertID('account_id_account_seq');
			return $this->id_account;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	private function delete():bool{
		try{
			$query= Connection::getInstance()->connect()->prepare("DELETE FROM account where id_account=:id");
			$query->bindParam(':id',$this->id_account);

			$query->execute();
			$this->id_account=Connection::getInstance()->connect()->lastInsertID('account_id_account_seq');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	private static function validEmail($email):bool{
		$query=Connection::getInstance()->connect()->prepare("SELECT id_account FROM account where email=:email");
		$query->bindParam(':email',$email);
		$query->execute();

		if($query->rowCount()>0) return false; else return true;
	}
}