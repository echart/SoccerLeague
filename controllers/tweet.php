<?
// RewriteRule ^tweet/user/([a-z0-9-]+)/([a-z0-9-]+)/$ handler.php?request=tweet&type=user&id=$1&method=$2 [NC,L]
if(isset($this->request['type'])){
  $id_club=$this->request['id'];
  switch ($method) {
    case 'all':
      # code...
      break;
    case ''
    default:
      # code...
      break;
  }
}




exit;
