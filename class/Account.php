<?
class Account{
	public static $instance;
	public $con;

	protected $_prodays;
	public $language;
	protected $permissions;

	public $id_account;
	protected $email;
	private $password;
	private $refeer;

	public function __construct($id=''){
		/* CONFIGS */
		$this->id_account=$id;
		$this->con=Connection::getInstance()->connect();

		if($this->id_account!=''){
			$query=$this->con->prepare("SELECT email, refeer,prodays, slvip, language FROM account where id_account=:id");
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

	public function setEmail($e):boolean{
		try{
			$query=$this->con->prepare("SELECT id_account FROM account where email=:email ") or die();
			$query->bindParam(':email',$this->email);
			$query->execute();

			if($query->rowCount()>0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function getEmail():string{
		return $this->email;
	}

	private function setProDays($days):bool{
		$this->_prodays=$days;
	}
	public function getProDays():int{

	}

	public function setPassword($p):bool{
		$this->password=$p;
	}

	private function create():bool{
		try{
			$query= $this->con->prepare("INSERT INTO account(email, password, refeer, language, slvip) values (:email, :password, :refeer, '1', '15')");
			$query->bindParam(':email',$this->email);
			$query->bindParam(':password',$this->password);
			$query->bindParam(':refeer',$this->refeer);

			$query->execute();
			$this->id_account=$this->con->lastInsertID('account_id_account_seq');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	private function delete():bool{
		try{
			$query= $this->con->prepare("DELETE FROM account where id_account=:id");
			$query->bindParam(':id',$this->id_account);

			$query->execute();
			$this->id_account=$this->con->lastInsertID('account_id_account_seq');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}