<?php

namespace Technosmart\Controllers;

use  \Slim\Views\Twig as View;

class Controller {
  protected $container;
 // set the container for fetching inside all the home controller..

  public function __construct($container){
    $this->container = $container;
  }

  // it will display the error if we are accessing which is not preasent..
  public function __get($property){
    if($this->container->{$property}){
      return $this->container->{$property};
    }

  }
}
