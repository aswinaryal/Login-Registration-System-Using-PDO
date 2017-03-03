<?php
class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = Db::getInstance();
	}
	public function check($source,$items = array()){
		foreach ($items as $item =>$rules) {
			foreach($rules as $rule => $rule_value){

				$value = trim($source[$item]);
				$item = escape($item);

				if($rule === 'required' && empty($value)){
					$show = ucwords(str_replace("_", " ", $item));
					$this->addError("{$show} is required");
						
				}
				
				else if(!empty($value)){
                    $show = ucwords(str_replace("_", " ", $item));
                    $ruled_value = ucwords(str_replace("_"," ",$rule_value));
					switch ($rule) {
						case 'min':
							if(strlen($value) < $rule_value){

								$this->addError("{$show} must be a minimum of {$ruled_value} characters");
							}
							break;

							case 'max':
							if(strlen($value) > $rule_value){
								$this->addError("{$item} must be a maximum of {$ruled_value} characters");
							}
							
							break;

							case 'matches':
							if($value != $source[$rule_value]){
								$this->addError("{$ruled_value} must match with {$show} field");
							}
							
							break;

							case 'notmatches':
							if(strtolower($value) == strtolower($source[$rule_value]) ){
								$this->addError("We expect you have different {$ruled_value} and {$show}");
							}
							
							break;

							case 'unique':
							$check = $this->_db->get($rule_value,array($item,'=',$value));
							if($check->count()){
								$this->addError("{$item} already exists");
							}
							break;

							case 'email_reg_match':
							$email_filter = filter_var($value, FILTER_VALIDATE_EMAIL);
							if (!$email_filter) {
     								$this->addError("{$item} is invalid");
     							}
							break;

							case 'reg_match':
							$show = preg_match('/^[A-Za-z][A-Za-z0-9]{3,19}$/', $value);
							if(!$show){
									$this->addError("{$item} starts with a letter and must not contain any special characters");
								}
								break;

							case 'varyPass':
							if(strtolower($value) == strtolower($source[$rule_value]) ){
								
								$this->addError("{$rule_value} and {$item} must be different");
							}
							break;

						
					
					}
				}
			}
		}

		if(empty($this->_errors)){
			$this->_passed = true;
		}
		return $this;
	}
	private function addError($error){
		$this->_errors[] = $error;
	}
	public function errors(){
		return $this->_errors;
	}
	public function passed(){
		return $this->_passed;
	}
}
?>