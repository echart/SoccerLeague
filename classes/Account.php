<?
class Account{
	public $id_account;

	private $email;
	private $password;
	private $refeer;

	public function __construct(int $id_account=0){
		$this->id_account=$id_account;
	}
	/** get and set */
	public function getEmail(){
		return $this->email;
	}
	public function getPassword(){
		return $this->email;
	}
	public function getRefeer(){
		return $this->refeer;
	}
	public function setEmail($email){
		$this->email=$email;
	}
	public function setPassword($password){
		$this->password=password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
	}
	public function setRefeer($refeer){
		$this->refeer=$refeer;
	}
	/* actions */
	public function __load(){
		$query=Connection::getInstance()->connect()->prepare("SELECT email, refeer, password FROM account where id_account=:id");
		$query->bindParam(':id',$this->id_account);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();

		$this->email=$data->email;
		$this->refeer=$data->refeer;
		$this->password=$data->password;
	}
	public function __create(){
		try{
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
	public function __update():bool{
		$query= Connection::getInstance()->connect()->prepare("UPDATE account SET email=:email, password=:password where id_account=:id_account");
		$query->bindParam(':email',$this->email);
		$query->bindParam(':password',$this->password);
		$query->bindParam(':id_account',$this->id_account);

		if($query->execute()) return true; else return false;
	}
}
