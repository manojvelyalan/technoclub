<?php

namespace Technosmart\Middleware;

class CSRFViewMiddleware extends Middleware{

  public function __invoke($request,$response,$next) {
    $this->container->view->getEnvironment()->addGlobal('csrf',[
        'feilds'=>'<input type = "hidden" name="'.$this->container->csrf->getTokenNameKey().'" value="'.$this->container->csrf->getTokenName().'" > <input type = "hidden" name="'.$this->container->csrf->getTokenValueKey().'" value="'.$this->container->csrf->getTokenValue().'" >'
    ]);
      $response = $next($request,$response);
      return $response;

  }

}
