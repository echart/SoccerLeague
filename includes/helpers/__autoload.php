<?
	function __autoload($class){
	    try{
	   		//try get the class
	    	require_once("includes/class/$class.php");
	    }catch(Exception $e){
	    	//if not, trow new error
	    	echo "I can't load $class" . $e->getMessage();
	    }
	}