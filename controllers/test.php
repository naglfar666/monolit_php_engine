<?php
namespace controllers;

use core\Request;
use core\Response;

Class test{

  public static function test(Request $request, Response $response) : Response
  {
    print_r($request->getHeaders());
    print_r($request->getBody());
    print_r($request->getMethod().PHP_EOL);
    print_r($request->getParams());
    print_r($request->getQuery());

    return $response
      ->setStatus(200)
      ->setMeta(['type'=>'success'])
      ->setData(['some'=>'text'])
      ->toJson();
  }

  public static function test2(Request $request, Response $response) : Response
  {
    print_r($request->getHeaders());
    print_r($request->getBody());
    print_r($request->getMethod().PHP_EOL);
    print_r($request->getParams());
    print_r($request->getQuery());

    return $response
      ->setStatus(200)
      ->setMeta(['type'=>'success'])
      ->setData(['some'=>'text'])
      ->toJson();
  }

}
?>
