<?php

/*

El Model ABOUT

*/

class AboutModel
{
  private $message;

  function __construct(){
    $this->message = "Welcome to the of PHP MVC framework official site.";

  }
  public function nowADays()
          {
              return $this->message = "nowadays everybody wants to be a boss.";
          }
}
