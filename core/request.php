<?php
namespace core;

Class Request {

  private $body;
  private $headers;
  private $url;
  private $query;

  public function getBody() : array
  {
    return $this->body;
  }

  public function setBody(array $data) : void
  {
    $this->body = $data;
  }

  public function getHeaders() : array
  {
    return $this->headers;
  }

  public function setHeaders(array $data) : void
  {
    $this->headers = $data;
  }

  public function getUrl() : string
  {
    return $this->url;
  }

  public function setUrl(string $data) : void
  {
    $this->url = $data;
  }

  public function getQuery() : array
  {
    return $this->query;
  }

  public function setQuery(array $data) : void
  {
    $this->query = $data;
  }

}
?>
