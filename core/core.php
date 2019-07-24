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

    $this->parseRequestBody();
    $this->parseRequestQuery();
    $this->parseRequestHeaders();

    $routes = self::$Router->getRoutePatterns();
    $this->callControllerMethod($routes[0]['callback']);
  }

  private function parseRequestBody() : void
  {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $phpinput = file_get_contents("php://input");
  		if ($phpinput != ''){
  			$_POST['phpinput'] = $phpinput;
  		}

  		if (isset(getallheaders()['CONTENT_TYPE'])) {
  			if (mb_stristr(getallheaders()['CONTENT_TYPE'], 'application/json')) {
  				$requestBody = json_decode($_POST['phpinput'], true);
  			} else {
          $requestBody = $_POST;
        }
  		}
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
      $requestBody = [];
    }

    self::$Request->setBody($requestBody);
  }

  private function parseRequestQuery() : void
  {

    $queryContainer = [];

    $url = $_SERVER['REQUEST_URI'];

    if (mb_stristr($url, '?')) {
      $startPos = mb_strpos($url, '?');
      $urlQuery = mb_substr($url, $startPos + 1, strlen($url) - 1);

      foreach (explode('&', $urlQuery) as $chunk) {
        $param = explode("=", $chunk);

        if ($param) {
          $queryContainer[urldecode($param[0])] = urldecode($param[1]);
        }
      }
    }

    self::$Request->setQuery($queryContainer);
  }

  private function parseRequestHeaders() : void
  {
    self::$Request->setHeaders(getallheaders());
  }

  private function callControllerMethod(string $controller) : void
  {
    $Data = call_user_func($controller, self::$Request);
    var_dump($Data);
  }
}
?>
