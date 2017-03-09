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
			}else{
				$this->name = $name;
				$this->val = '';
				$this->$rule();
			}
		}
	}
	public function required(){
		if(is_null($this->form[$this->name]) === true OR $this->form[$this->name] === '' OR empty($this->form[$this->name]) === true){
			$this->errors['length']++;
			$this->errors['errors'][$this->name] = 'required';
		}
	}
	public function unique(){}
	public function in(){}
	public function maxsize(){}
	public function minsize(){}
	public function integer(){}
	public function isnull(){}
	public function string(){}
	public function email(){}
}

$validation = new Validation($_GET);
$rules = [
	'user' => 'required'
	,'email' => 'in:users|required|maxsize:8'
];
$validation->addRules($rules)->validate();
