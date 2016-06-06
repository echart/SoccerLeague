<?
	$tree='../';
	require_once('class/Menu.php');
	require_once('views/_head.php');
	$submenu=new menu('club',0);
	require_once('views/_header.php');
	include('helpers/__dontgetlost.php');
?>
	
	<div class='content'>
	<h1><?print_r($this->request);?></h1>
	<h2><? echo __rootpath($_SERVER['REQUEST_URI']);?></h2>
	</div>
<?
	require_once('views/_footer.php');
?>