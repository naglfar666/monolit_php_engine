<?php
namespace core;

include 'core/router.php';
include 'core/request.php';

include 'handlers/index.php';

include 'controllers/index.php';

use handlers\Routes;

class Core {

  public static $Router;

  private static $Request;

  public function run()
  {
    self::$Router = new Router;
    self::$Request = new Request;
    new Routes;

    Request::parseRequestBody(self::$Request);
    Request::parseRequestQuery(self::$Request);
    Request::parseRequestHeaders(self::$Request);

    $routeFound = self::$Router->findRoute();

    if (sizeof($routeFound) != 0) {
      self::$Request->setParams($routeFound['params']);
      self::$Request->setMethod($routeFound['method']);

      $this->callControllerMethod($routeFound['callback']);
    }
    
  }

  private function callControllerMethod(string $controller) : void
  {
    $Data = call_user_func($controller, self::$Request);
    var_dump($Data);
  }
}
?>
