<?

class Club{
  public $id_club;
  public $id_account;
  public $id_country;

  public $clubname = 'Pending Aproval';
  public $create = date('Y-m-d');
  public $status = 'P';
  public $location;

  public function __construct($id_account=''){
    $this->id_account;
  }

  public function __load(){
    // TODO: load club
  }
  public function __save(){
    $query=Connection::getInstance()->connect()->prepare("INSERT INTO club (id_country,clubname, status) values (:id_country, :clubname, :status)");
		$query->bindParam(':id_country',$this->id_country);
    $query->bindParam(':clubname',$this->clubname);
    $query-bindParam(':status',$this->status);

		$query->execute();
		return Connection::getInstance()->connect()->lastInsertID('club_id_club_seq');
  }
}
