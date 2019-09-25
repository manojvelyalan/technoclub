<?php
namespace Technosmart\Controllers\Admin;
use Respect\Validation\Validator as v;
use Technosmart\Controllers\Controller as BaseController;
use Technosmart\Models\User;

class AuthenticationController extends BaseController {

    public function getSignIn($request,$response){ 
        return $this->view->render($response,"admin/signin.twig");
    }

    public function getSignUp($request, $response){
        return $this->view->render($response,"admin/signup.twig");
    }
    public function postSignUp($request,$response){
        
        $validation  = $this->validator->validate($request,[
            'firstName'=>v::notEmpty()->alpha()->setName('First Name'),
            'lastName'=>v::notEmpty()->alpha()->setName('Last Name'),
            'email'=>v::noWhitespace()->notEmpty()->email()->emailAvailable()->setName('Email'),
            'password'=>v::noWhitespace()->notEmpty()->length(8)->setName('Password'),
            'confirmPassword'=>v::matchConfirmPassword($request->getParam('password')),
        ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('adminsignup'));
        }
       $user =  User::create([
           'firstName' => strtolower($request->getParam('firstName')),
           'lastName' => strtolower($request->getParam('lastName')),
           'username' => strtolower($request->getParam('email')),
           'email' => strtolower($request->getParam('email')),
           'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT,['cost'=>10]),
        ]);
        
       // automatic login after sign up..
       
      //$this->auth->attempt($user->email,$request->getParam('password'));
       
       // redirect..
       $this->flash->addMessage('info','You have been signed up successfully..');
       return $response->withRedirect($this->router->pathFor('adminsignup'));
    }

    public function getSignOut($request,$response){
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor("adminsignin"));
    }
    public function postSignIn($request,$response){
        $auth = $this->auth->attempt($request->getParam('email'),$request->getParam('password'));
        if(!$auth){
             $this->flash->addMessage('error','Your username and password is wrong..');
            return $response->withRedirect($this->router->pathFor('adminsignin'));
        }
        return $response->withRedirect($this->router->pathFor('viewallrequest'));
      }
      

}

?>