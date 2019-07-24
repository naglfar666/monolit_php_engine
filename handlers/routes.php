<?php
namespace handlers;

use core\Core;

class Routes{
  public function __construct()
  {
    $testController = '\controllers\test';

    Core::$Router
      ->get('/api/v1/{product}', $testController.'::test')
      ->post('/api/v1/{product}/register', $testController.'::test2');
  }
}
?>
