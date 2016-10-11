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
		$this->password=$password;
	}
	public function setRefeer($refeer){
		$this->refeer=$refeer;
	}
	/* actions */
	public function __load(){

	}
	public function __create(){

	}
	public function __update(){

	}
}
