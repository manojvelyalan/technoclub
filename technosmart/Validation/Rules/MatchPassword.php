<?php

namespace Technosmart\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;


class MatchPassword extends AbstractRule{
    private  $password;
    public function __construct($password) {
        $this->password = $password;
    }
    
    public function validate($input){
        return password_verify($input, $this->password);
    }
}