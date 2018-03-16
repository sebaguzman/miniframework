<?php

/*

El Model HOMEPAGE

*/

class IndexModel
{
  private $message = 'Bienvenidos a la Home Page';

  function __construct(){

  }

  public function welcomeMessage(){
    return $this->message;
  }
}
