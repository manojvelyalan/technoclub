<?php


namespace Technosmart\Middleware;

class AuthMiddleware extends Middleware{
    
    public function __invoke($request,$response,$next) {
       if(!$this->container->auth->check()){
           $this->container->flash->addMessage("error","You have to logged in before access this page");
           return $response->withRedirect($this->container->router->pathFor('adminsignin'));
           
           
       }
        $response = $next($request,$response);
        return $response;
        
    }
    
}