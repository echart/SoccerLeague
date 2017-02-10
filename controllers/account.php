<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
echo $this->request['method'];
switch ($this->request['method']) {
  case 'create':

    break;
  case 'delete':
    break;
  case 'update':
    break;
}
exit;
?>
