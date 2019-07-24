<?php
namespace controllers;

Class test{

  public static function test($request)
  {
    print_r($request->getHeaders());
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
