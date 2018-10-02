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
	
	public function process()
	{
		$request = strtolower($_SERVER['REQUEST_URI']);
		$path = preg_split("/\//", $request);
		if(count($path)!=0)
    {
      echo "not null ";
      $controller = CTRLS.ucfirst($path[1]).".php";
      echo $controller;
      if($this ->routes[])
      if(file_exists($controller))
      {
        require_once($controller);
      }
      else
      {
        echo " file not fount";
        require_once PNF;
      }
    }
    else
    {
      die();
    }
	}
  
  private function findController( string $ctrl)
  {
    foreach()
  }
  
  public function route(string $route, string $handler, string $method = "any")
  {
    //добавление массива роутов по методу
    if(empty($this->routes[$method]))
    {
      $this->routes[$method] = [];
    }
    //добавление роута
    $this->routes[$method][] = [
      'route'   => $route,
      'handler'  => $handler
    ];
  }
}
?>