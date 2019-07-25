<?php
namespace controllers;

Class test{

  public static function test($request)
  {
    print_r($request->getHeaders());
    print_r($request->getBody());
    print_r($request->getMethod());
    print_r($request->getParams());
    $Data = 'asdasd';
    return $Data;
  }

  public static function test2($req)
  {
    $Data = 'asdasd2';
    return $Data;
  }

}
?>
