<?php

namespace Technosmart\Models\Admin;

use Technosmart\Models\User;
use Technosmart\Models\BaseModel;

class Authentication extends BaseModel {

    public function check(){
        return isset($_SESSION['user']);
    }
    public function userDetails(){
       if( isset($_SESSION['user'])){
            return User::find($_SESSION['user']) ;
       }else{
           return false;
       }
    }
    public function attempt($email,$password){
        $user = User::where('username',$email)->first();
        if(!$user){
            return false;
        }
        if(password_verify($password, $user->password)){           
            $_SESSION['user'] = $user->id;
            return true;
        }
        return false;
    }
    public function logout(){
        unset($_SESSION['user']);
    }
}
