<?

class Validation{
	public $form;
	public $rules;
	public $rulesValid = array('required','unique','in','maxsize','minsize','integer','isnull','string');
	public $name;
	public $val;

	public function __construct($form){
		$this->form   = $form;
		$this->errors =  array('length'=> 0);
		return $this;
	}
	public function addRules($rules){
		$this->rules = $rules;
		return $this;
	}
	public function validate(){
		foreach ($this->rules as $name => $rule) {
			// name = $this->post[NAME];
			// rules = 'required';
			if($rule!=''){
				if(strpos($rule,'|')!=false){
					$rul = explode('|',$rule); //$rul[0] = 'required|in:users';
					foreach ($rul as $eachRule) {
						if(strpos($eachRule,':')!=false){
							$ruleValue = explode(':',$eachRule);
							$this->name = $name;
							$this->val = $ruleValue[1];
							$r = $ruleValue[0];
							$this->$r();
						}else{
							$this->name = $name;
							$this->val = '';
							$this->$eachRule();
						}
					}
				}else if(strpos($rule,':')!=false){
					$ruleValue = explode(':',$rule);
					$this->name = $name;
					$this->val = $ruleValue[1];
					$r = $ruleValue[0];
					$this->$r();
				}else{
					$this->name = $name;
					$this->val = '';
					$this->$rule();
				}
			}
		}
		return $this;
	}
	public function required(){
		if(is_null($this->form[$this->name]) === true OR $this->form[$this->name] === '' OR empty($this->form[$this->name]) === true){
			$this->errors['length']++;
			$this->errors['errors'][$this->name][] = 'required';
		}
	}
	public function in(){
		/*
			$this->val must be equal nametable
			$this->name mus be equal column
			$this->form[$this->name] is the value to search at $this->val(table)
		*/
		$query=Connection::getInstance()->connect()->prepare("SELECT $this->name FROM $this->val where $this->name=:val");
		$query->bindParam(':val',$this->form[$this->name]);
		$query->execute();

		if($query->rowCount()>0){
			$this->errors['length']++;
			$this->errors['errors'][$this->name][] = 'in';
		}
	}
	public function maxsize(){
		if(strlen($this->form[$this->name])>$this->val){
			$this->errors['length']++;
			$this->errors['errors'][$this->name][] = 'maxsize';
		}
	}
	public function minsize(){
		if(strlen($this->form[$this->name])<$this->val){
			$this->errors['length']++;
			$this->errors['errors'][$this->name][] = 'minsize';
		}
	}
	public function integer(){}
	public function isnull(){}
	public function string(){}
	public function email(){
		if(!filter_var($this->form[$this->name], FILTER_VALIDATE_EMAIL)){
			$this->errors['length']++;
			$this->errors['errors'][$this->name][] = 'email';
		}
	}
	public function notin(){}
	public function geterrors(){
		return $this->errors;
	}
}
