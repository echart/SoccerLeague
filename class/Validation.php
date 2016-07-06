<?
$a='a';
//Validation::validate($a)->string()->isEqual('b');
// Validation::validate(11)->string()->isEqual(11);
class Validation{
	public static $errors=false;
	public static $errorsMsg=array();
	public static $errorsNum=0;
	public static $validate;
	private static $instance;

	private function __construct() {
		return $this;
	}
	//avoid duplicate object
	private function __clone() {}
	public static function validate($value){
		self::$validate=$value;
		if(!self::$instance) {
			self::$instance = new self();
			self::$errors=false;
			self::$errorsMsg=array();
			self::$errorsNum;
		}
		return self::$instance;
	}
	public static function addError($msg){
		self::$errors=true;
		self::$errorsMsg[]=$msg;
		self::$errorsNum++;
	}
	public static function numeric(){
		if(!is_numeric(self::$validate)){
			self::addError("This is not a numeric");
		}
		return self::$instance;
	}

	public static function string(){
		if(!is_string(self::$validate)){
			self::addError("This is not a string");
		}
		return self::$instance;
	}
	public static function isEqual($b){
		if(self::$validate!=$b){
			 self::addError("They aren't equal");
		}
		return self::$instance;
	}
	public static function isEmpty(){
		if(self::$validate!='' or self::$validate!=null){
			 self::addError("This is not empty!");
		}
		return self::$instance;
	}
	public static function isNotEmpty(){
		if(self::$validate=='' or self::$validate==null){
			 self::addError("This is empty!");
		}
		return self::$instance;
	}
	public static function between($min,$max){
		
	}
	public static function lenght(){
		if(is_string(self::$validate)){
            return strlen(self::$validate);
        }
        if(is_array(self::$validate)){
            return count(self::$validate);
        }
        if(is_int(self::$validate)){
            return strlen((string)self::$validate);
        }
	}
	public static function minLenght($min){
		if(Validation::lenght(self::$validate)>$min){
			return true;
		}else{
			return false;
		}
	}
	public static function maxLenght($max){
		if(Validation::lenght(self::$validate)<$max){
			return true;
		}else{
			return false;
		}
	}
	// public static function validate($){
	// 	if(self::$validate!=null or self::$validate!=''){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }
}