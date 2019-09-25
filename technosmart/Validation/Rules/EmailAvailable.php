<?php
namespace Technosmart\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Technosmart\Models\User;

class EmailAvailable extends AbstractRule{
    
    public function validate($input){
        return User::where('email',$input)->count() === 0;
    }
}