<?

class Validation{
	public $form;
	public $rules;
	public $rulesValid = array('required','unique','in','maxsize','minsize','integer','isnull','string');

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
			if(strpos($rule,'|')!=false){
				$rul = explode('|',$rule); //$rul[0] = 'required|in:users';
				print_r($rul);
				foreach ($rul as $eachRule) {
					if(strpos($eachRule,':')!=false){
						$ruleValue = explode(':',$eachRule);
						$r = $eachRule;
						$n = $name;
					}else{
						$n = $name;
						$r = $rul;
					}
				}
			}else{
				$n = $name;
				$r = $rule;
			}
		}
	}
	public function required($name){
		if(is_null($this->form[$name]) === true OR $this->form[$name] === '' OR empty($this->form[$name]) === true){
			$this->errors['length']++;
			$this->errors['errors']["$name"] = 'required';
		}
	}
	public function unique($name){}
	public function in($name){}
	public function maxsize($name){}
	public function minsize($name){}
	public function integer($name){}
	public function isnull($name){}
	public function string($name){}
}

$validation = new Validation($_GET);
$rules = [
	'user' => 'required'
	,'email' => 'in:users|required|maxsize:8'
];
$validation->addRules($rules)->validate();
