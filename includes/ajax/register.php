<?
header('Content-type: application/JSON');


use Connection;
$c=new Connection();
$x=new CreateAccount($c->connect(), 'willians.fagundes@hotmail.com','senha5');
$x->create();