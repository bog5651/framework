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
		if(count($path)!=0)
    {
      echo "not null";
      foreach($path as $tip)
      {
        echo $tip."<BR>";
      }
    }
    else
    {
      die();
    }
		echo ''.APP.'<BR>'.ROOT.'';
	}
  
  public function route()
  {
    
  }
}
?>