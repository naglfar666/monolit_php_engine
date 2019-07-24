<?php
namespace handlers;

use core\Router;

class Routes extends Router{
  public function __construct()
  {
    $this
      ->get('/api/v1/{product}')
      ->post('/api/v1/{product}/register');
  }

  public function getRoutePatterns() : array
  {
    return $this->routePatterns;
  }
}
?>
