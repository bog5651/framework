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
		$request = $_SERVER['REQUEST_URI'];
		$path = preg_split("/\//", $request);
		if($path.lenght())
		echo ''.APP.'<BR>'.ROOT.'';
	}
  
  public function route()
  {
    
  }
}
?>