<?php


// Este archivo redirecciona todo lo que tenga en la variable PATH_INFO a la segunda parte 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SERVER['PATH_INFO'])) {
  echo "Home Page";
  exit();
} else {
  echo "otra pagina";
}

 ?>
