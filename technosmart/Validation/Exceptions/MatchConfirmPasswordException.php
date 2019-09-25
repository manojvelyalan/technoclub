<?php

namespace Technosmart\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchConfirmPasswordException extends ValidationException{
    
    public static $defaultTemplates  = [
        
        self::MODE_DEFAULT => [
            self::STANDARD => 'Password and Confirm Password not matched',
        ],
    ];
    
}
