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
      echo "<BR>not null ";
      $controller = CTRLS.ucfirst($path[1]).".php";
      $controller_name = ucfirst($path[1]);
      echo $controller;
      if($this->findController($controller_name))
      {
        if(file_exists($controller))
        {
          require_once($controller);
        }
        else
        {
          echo "<BR>file not fount";
          require_once PNF;
        }
      }
      else
      {
        echo "<BR>Controller not found in array";
      }
    }
    else
    {
      die();
    }
	}
  
  private function findController(string $ctrl)
  {
    for($i = 0;$i<count($this->routes['any']);$i++)
    {
      if($this->routes['any'][$i]['route']==$ctrl)
      {
        return true;
      }
    }
    return false;
  }
  
  public function route(string $route, string $handler, string $method = "any")
  {
    //добавление массива роутов по методу
    if(empty($this->routes[$method]))
    {
      $this->routes[$method] = [];
    }
    //добавление роута
    $this->routes[$method][] = array(
      'route'   => $route,
      'handler'  => $handler
    );
  }
}
?>