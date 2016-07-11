<?
$division = $this->request['id'] ?? $_SESSION['division'];
$group = $this->request['subrequest'] ?? $_SESSION['group'];
?>
<div class='content'>
  <?
  echo 'Divisão: ' . $division . '<br>';
  echo 'Grupo: ' .$group . '<br>';
  ?>
</div>
