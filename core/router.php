<?php
namespace core;

class Router {

  private $routePatterns = [];

  public function get($path, $callback) : Router
  {
    $this->routePatterns[$path] = [
      'method' => 'GET',
      'callback' => $callback,
    ];
    return $this;
  }

  public function post($path, $callback) : Router
  {
    $this->routePatterns[$path] = [
      'method' => 'POST',
      'callback' => $callback,
    ];
    return $this;
  }

  public function getRoutePatterns() : array
  {
    return $this->routePatterns;
  }

  public function findRoute() : array
  {
    // $pattern = $this->preparePattern('/api/v1/{product}/');
    // print_r($pattern.PHP_EOL);
    // $Matching = preg_match('#^api/route/(?<product>\w+)/(?<action>\w+)$#','api/route/osago/get',$data);
    // var_dump($Matching);
    // print_r($data);
    // exit;
    $Patterns = $this->getRoutePatterns();
    foreach ($Patterns as $pattern => $values) {
      if (strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($values['method'])) {
        $pattern = $this->preparePattern($pattern);
        // $url = $this->prepareUrl();

        if (preg_match($pattern['regex'],$this->prepareUrl(),$params)) {
          $paramsResult = [];
          for ($i = 0; $i < count($pattern['expectedParams']); $i++) {
            $paramsResult[$pattern['expectedParams'][$i]] = $params[$pattern['expectedParams'][$i]];
          }

          return array_merge($values,['params'=>$paramsResult]);
        }
      }


      // var_dump($pattern);
      // var_dump($url);
      //
      // $Matching = preg_match($pattern,$url,$params);
      // var_dump($Matching);
      // var_dump($params);
      // print_r($pattern.PHP_EOL);
      // print_r($_SERVER['REQUEST_URI'].PHP_EOL);
      // $Matching = preg_match('#^/' . ltrim($pattern, '/') . '$#', $_SERVER['REQUEST_URI'], $params);
      //
      // var_dump($Matching);
      // var_dump($params);
    }

    return [];
  }

  public function preparePattern(string $pattern) : array
  {
    $patternArray = explode('/', trim($pattern, '/'));
    $expectedParams = [];
    foreach ($patternArray as $key => $value) {
      if (stristr($value, '{')) {

        $expectedParams[] = preg_replace('/[^A-Za-z0-9]/', '', $value);

        $value = str_replace('{', '(?<', $value);
        $patternArray[$key] = str_replace('}', '>\w+)', $value);
      }
    }
    return [
      'regex' => '#^'.implode('/',$patternArray).'$#',
      'expectedParams' =>$expectedParams,
    ];
  }

  public function prepareUrl() : string
  {
    $url = $_SERVER['REQUEST_URI'];

    if (stristr($url, '?')) {
      $startPos = mb_strpos($url, '?');
      $url = mb_substr($url, 0, $startPos);
    }

    return trim($url,'/');
  }
}
?>
