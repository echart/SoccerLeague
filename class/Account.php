<?
// namespace soccerleague\AccountInterface;
//
// interface Account{
// 	public function __construct();
// 	public function setRefeer($id);
// 	public function setEmail($email);
// 	public function setProDays($pro);
// 	public function setPassword($password);
// 	public function setCountry($country);
// }
//
// namespace soccerleague\AccountCreate;
// use soccerleague\AccountInterface as AccountLayout;
//
// class Account implements AccountLayout{
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

	private function setProDays($days){
		$this->_prodays=$days;
	}
	public function getProDays():int{
		return $this->_prodays;
	}

	public function setPassword($p){
		$this->password=$p;
	}

	public function setLanguage($l){
		$this->language=$l;
	}
	public function getLanguage($l){
		return $this->language;
	}
	public function update():bool{
		try{
			$query= Connection::getInstance()->connect()->prepare("UPDATE account SET email=:email, password=:password where id_account=:id_account");
			$query->bindParam(':email',$this->email);
			$query->bindParam(':password',$this->password);
			$query->bindParam(':id_account',$this->id_account);

			if($query->execute()) return true; else return false;

		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function create(){
		try{
			$this->password=password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 12]);
			$query= Connection::getInstance()->connect()->prepare("INSERT INTO account(email, password, refeer) values (:email, :password, :refeer)");
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
	public function delete():bool{
		try{
			$query= Connection::getInstance()->connect()->prepare("DELETE FROM account where id_account=:id");
			$query->bindParam(':id',$this->id_account);

			$query->execute();
			$this->id_account=Connection::getInstance()->connect()->lastInsertID('account_id_account_seq');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
 	public function validEmail():bool{
			$query=Connection::getInstance()->connect()->prepare("SELECT id_account FROM account where email=:email ") or die();
			$query->bindParam(':email',$this->email);
			$query->execute();
			if($query->rowCount()==0){
				return true;
			}else{
				return false;
			}
	}
}
