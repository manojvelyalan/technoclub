<?php

namespace Technosmart\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MatchPasswordException extends ValidationException{
    
    public static $defaultTemplates  = [
        
        self::MODE_DEFAULT => [
            self::STANDARD => 'Your Password doesnot match',
        ],
    ];
    
}
