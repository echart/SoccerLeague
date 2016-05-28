<?
/*
CREATE ACCOUNT CLASS
this class should create account and return account id for create a club
07/05/2015 - ADD checkclub name
*/

class CreateAccount{
	private $email;
	private $password;
	public $father;
	public $id_account;
	public $club;

	public function __construct($e,$p,$f=null){
		$this->email=$e;
		$this->password=password_hash($p, PASSWORD_BCRYPT, array('cost' => 10));
		$this->father=$f;
	}
	public function isset():bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("SELECT id_account FROM account where email=:email ") or die();
			$query->bindParam(':email',$this->email);
			$query->execute();

			$query2=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where clubname= :clubname ") or die();
			$query2->bindParam(':clubname',$this->club);
			$query2->execute();

			if($query->rowCount()>0 OR $query2->rowCount()>0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function create(){
		try{
			$query= Connection::getInstance()->connect()->prepare("INSERT INTO account(email, password, father, language, slvip) values (:email, :password, :father, '1', '15')");
			$query->bindParam(':email',$this->email);
			$query->bindParam(':password',$this->password);
			$query->bindParam(':father',$this->father);

			$query->execute();
			$this->id_account=Connection::getInstance()->connect()->lastInsertID('account_id_account_seq');
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}