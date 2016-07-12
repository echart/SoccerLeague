<?
$division = $this->request['div'] ?? $_SESSION['SL_div'];
$group = $this->request['group'] ?? $_SESSION['SL_group'];
?>
<div class='content'>
  <?
  echo 'Divisão: ' . $division . '<br>';
  echo 'Grupo: ' .$group . '<br>';
  ?>
</div>
