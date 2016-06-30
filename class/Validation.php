<?

class Validation{
	
	public static function isEqual($a, $b){
		if($a==$b){
			return true;
		}else{
			return false;
		}
	}
	public static function isEmpty($a){
		if($a===''){
			return true;
		}else{
			return false;
		}
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