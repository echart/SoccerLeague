<?
	$tree='../';
	require_once('class/Menu.php');
	require_once('views/head.php');
	$submenu=new menu('club',0);
	require_once('views/header.php');
?>
	
	<div class='content'>
	<h1><?print_r($this->request);?></h1>
	</div>
<?
	require_once('views/footer.php');
?>