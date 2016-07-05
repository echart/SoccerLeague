<?

class Validation{
	public static $errors=false;
	public static $errorsMsg=array();
	public static $errorsNum=0;

	private static $instance;
	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new self();
			self::$errors=false;
		}
		return self::$instance;
	
	private function __construct() {

	}
	//avoid duplicate object
	private function __clone() {}

	public static function numeric($a){
		if(!is_numeric($a)){
			self::$erros=true;
			self::$errorsMsg[]="This is not a numeric";
			self::$errorsNum++;
		}
	}

	public static function string($a){
		if(!is_string($a)){
			self::$erros=true;
			self::$errorsMsg[]="This is not a string";
			self::$errorsNum++;
		}
	}

	public static function isEqual($a, $b){
		if($a!=$b and self::$errors!=false){
			 self::$erros=true;
			 self::$errorsMsg[]="They aren't equal";
			 self::$errorsNum++;
		}
		return $self::$instance;
	}
	public static function isEmpty($a){
		if($a!='' or $a!=null){
			self::$erros=true;
			 self::$errorsMsg[]="This is not empty!";
			 self::$errorsNum++;
		}
		return self::$instance;
	}
	public static function isNotEmpty($a){
		if($a=='' or $a==null){
			self::$erros=true;
			 self::$errorsMsg[]="This is empty!";
			 self::$errorsNum++;
		}
		return self::$instance;
	}
	public static function lenght($a){
		if(is_string($a)){
            return strlen($a);
        }
        if(is_array($a)){
            return count($a);
        }
        if(is_int($a)){
            return strlen((string)$a);
        }
	}
	public static function minLenght($a, $min){
		if(Validation::lenght($a)>$min){
			return true;
		}else{
			return false;
		}
	}
	public static function maxLenght($a, $max){
		if(Validation::lenght($a)<$max){
			return true;
		}else{
			return false;
		}
	}
	public static function validate($a){
		if($a!=null or $a!=''){
			return true;
		}else{
			return false;
		}
	}

}