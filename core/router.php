<?php
namespace core;

class Router {

  public $routePatterns = [];

  public function route()
  {
    // code...
  }

  public function get($path)
  {
    $this->routePatterns[] = [
      'pattern' => $path,
      'method' => 'GET'
    ];
    return $this;
  }

  public function post($path)
  {
    $this->routePatterns[] = [
      'pattern' => $path,
      'method' => 'POST'
    ];
    return $this;
  }
}
?>
