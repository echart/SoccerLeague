<?
$division = $this->requestURL['id'] ?? $_SESSION['division'];
$group = $this->requestURL['subrequest'] ?? $_SESSION['group'];
?>
<div class='content'>
  <?
  echo $division . '<br>';
  echo $group . '<br>';
  ?>
</div>
?>
