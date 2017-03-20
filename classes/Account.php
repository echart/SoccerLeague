<?
class Account{
	public $id_account;

	private $email;
	private $password;
	private $refeer;

	public function __construct($id_account=''){
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
		$this->refeer= $refeer ?? null;
	}
	/* actions */
	public function __delete(){
		$query=Connection::getInstance()->connect()->prepare("DELETE FROM account where id_account=:id");
		$query->bindParam(':id',$this->id_account);
		$query->execute();
	}
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

			$query= Connection::getInstance()->connect()->prepare("INSERT INTO account_data(id_account) values (:id_account)");
			$query->bindParam(':id_account',$this->id_account);
			$query->execute();
			return $this->id_account;
		}catch(PDOException $e){
			return $e->getMessage();
		}
	}
	public function __update():bool{
		$query= Connection::getInstance()->connect()->prepare("UPDATE account SET email=:email, password=:password where id_account=:id_account");
		$query->bindParam(':email',$this->email);
		$query->bindParam(':password',$this->password);
		$query->bindParam(':id_account',$this->id_account);

		if($query->execute()) return true; else return false;
	}
	public function __loadData(){
		//TODO: load data from account data table
	}
	public function __createData(){
		//TODO:	create data to account data table
	}
	public function __updateData(){
		//TODO: update data from account data table
	}
}
