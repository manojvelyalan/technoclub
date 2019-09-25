<?php

namespace Technosmart\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator{

protected $errors = [];

public function validate($request,array $rules){
  foreach ($rules as $field => $rule) {
		try {
			$rule->assert($request->getParam($field));
		} catch (NestedValidationException $e) {
			$this->errors[$field] = $e->getMessages();
		}
	}
  /*foreach($rules as $feild=>$rule){
    try{
      $rule->setName($feild)->assert($request->getParam($feild));
    }catch(NestedValidationException $e){
      $this->errors[$feild] = $e->getMessages();
    }
  }*/
  
  $_SESSION['errors'] = $this->errors;

  return $this;
}
public function failed(){
  return !empty($this->errors);
}

}
