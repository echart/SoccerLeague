<?
	function __autoload($class){
	    try{
	   		//try get the class
	    	require_once("classes/$class.php");
	    }catch(FatalException $e){
	    	//if not, trow new error
	    	echo "I can't load $class" . $e->getMessage();
	    }
	}
