<?
	function __autoload($classe){
	    //busca dentro da pasta classes a classe necessaria...
	    include_once "classes/{$classe}.class.php";
	}	


	$message='eiuaoeuaoiea';
	$message.='Content-Type: text/html; charset=UTF-8';
	$message.='Content-Transfer-Enconding: 8bitnn';
	$sender='teste@test.org';
	$header='From: teste@gmail.com';
	$to='willians.fagundes@hotmail.com';

	echo mail($to,'teste',$message,$header);