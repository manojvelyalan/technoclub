<?php

namespace Technosmart\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;


class MatchConfirmPassword extends AbstractRule{
    private  $password;
    public function __construct($password) {
        $this->password = $password;
    }
    
    public function validate($confirmPassword){
        return ($confirmPassword === $this->password);
    }
}