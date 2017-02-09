<?
class Permission{
  public $id_account;
  private $userpermissions = array();
  private $permission;

  public function __construct(Account $account){
    $this->id_account = $account->id_account;
    //TODO: load permissions;
  }
  public function verifyPermission(array $pagePermission){
    $i = 0;
    foreach ($pagePermission as $permission) {
      if(in_array($permission, $this->userpermissions))
        $i++;
    }
    if($i==0){
        header('HTTP/1.0 403 Forbidden');
        header('location: /403/');exit;
        exit;
    }
  }
}
