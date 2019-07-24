<?php
namespace core;

include 'core/router.php';
include 'handlers/index.php';

use core\Router;

use handlers\Routes;

class Core {

  public function run()
  {
    $routes = new Routes();
    print_r($routes->getRoutePatterns());
  }
}
?>
