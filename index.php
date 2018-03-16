<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

if ($url == '/') {
  # si la url es / entonces carga el home.
  # Y renderiza la vista home

  require_once __DIR__.'/Models/index_model.php';
  require_once __DIR__.'/Controllers/index_controller.php';
  require_once __DIR__.'/Views/index_view.php';

  $indexModel = New IndexModel();
  $indexController = New IndexController($indexModel);
  $indexView = New IndexView($indexController,$indexModel);

  print $indexView -> index();
} else {
  # Este no es el home. Inicia el controller apropiado
  # y renderiza la vista requerida

  $requestedController = $url[0];

  # Si la segunda parte de la url tiene algo, deberia ser un método

  $requestedAction = isset($url[1])? $url[1] : '';

  # Las partes restantes de la url son consideradas argumentos del metodo
  $requestedParams = array_slice($url, 2);

  # Chequea si el controller existe.
  # Tambien hay que hacerlo para el model y la vista

  $ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';

        if (file_exists($ctrlPath))
        {

            require_once __DIR__.'/Models/'.$requestedController.'_model.php';
            require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
            require_once __DIR__.'/Views/'.$requestedController.'_view.php';

            // ucfirst Convierte el primer caracter de una cadena a mayúsculas
            $modelName      = ucfirst($requestedController).'Model';
            $controllerName = ucfirst($requestedController).'Controller';
            $viewName       = ucfirst($requestedController).'View';

            $controllerObj  = new $controllerName( new $modelName );
            $viewObj        = new $viewName( $controllerObj, new $modelName );


            // If there is a method - Second parameter
            if ($requestedAction != '')
            {
                // then we call the method via the view
                // dynamic call of the view
                print $viewObj->$requestedAction($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
}

 ?>
