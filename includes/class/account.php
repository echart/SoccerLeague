<?

class Account{
	public $account_id;
	protected $email;
	private $password;
	protected $prodays;
	private $refeer_id;
	public $language;
	protected $permissions;
	public $flag;

	public function __construct($id){
		$this->account_id=$id;
	}
	public function setEmail($e):boolean{

	}
	public function getEmail():string{
		return $this->email;
	}
	public function getProDays():int{

	}
	private function setProDays($days):boolean{
		$this->prodays=$days;
	}
	public function setPassword($p):boolean{
		$this->password=$p;
	}
	private function getPassword():string{

	}
	private function getPermission():string{

	}
	private function setPermission($perm){
		$this->permissions=$perm;
	}
	private function deleteAccount():boolean{

	}
}

class CreateAccount{
	private $email;
	private $password;
	public $father;
	public $id_account;

	public $connection;

	public function __construct($c, $e,$p,$f='NULL'){
		$this->email=$e;
		$this->password=$p;
		$this->father=$f;
		$this->connection=$c;
	}
	public function check():int{
		$query=pg_query($this->connection, "SELECT * FROM account where email='".$this->email."'");
		return pg_num_rows($query);
	}

	function create(){
		if($this->check()>0){
			echo 'email já existe em nossa base de dados';			
			return false;
		}else{
			$query=pg_query($this->connection, "INSERT INTO account(email, password, father, language, slvip) values ('".$this->email."', '".$this->password."', ".$this->father.", '1', '15') RETURNING id_account");
			$results=pg_fetch_array($query);
			$this->id_account=$results['id_account'];
		}
	}
}
require_once('connection.php');
$c=new Connection();
$x=new CreateAccount($c->connect(), 'willians.fagundes@hotmail.com','senha5');
$x->create();