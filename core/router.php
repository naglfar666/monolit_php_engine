<?php
namespace core;

class Router {

  private $routePatterns = [];

  public function get($path, $callback) : Router
  {
    $this->routePatterns[] = [
      'pattern' => $path,
      'method' => 'GET',
      'callback' => $callback,
    ];
    return $this;
  }

  public function post($path, $callback) : Router
  {
    $this->routePatterns[] = [
      'pattern' => $path,
      'method' => 'POST',
      'callback' => $callback,
    ];
    return $this;
  }

  public function getRoutePatterns() : array
  {
    return $this->routePatterns;
  }
}
?>
