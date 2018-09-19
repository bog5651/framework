<?php
class Router{
 private static $instance = null;
  
 public $routes = null;
  
 public static function getInstance()
  {
    if(is_null(self::$instance))
    {
      self::$instance = new Router();
    }
    return self::$instance;
  }
  public static process()
  {
    $request = $_SERVER['REQUEST_URI'];
    $metod
  }
}
?>