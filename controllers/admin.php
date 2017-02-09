<?
  $pagepermission=array('FT');
  $userpermissions = new Permission(new Account($id_account));
  $userpermissions->verifyPermission($pagepermission);
?>
