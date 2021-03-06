<?php
class Router
{
	private static $instance = null;

	public $routes = null;

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new Router();
		}
		return self::$instance;
	}
  
  private function __construct() 
  {
    $this->routes = [];
  }

	public function process()
	{
		$url = preg_replace('~[?].*~', '', $_SERVER['REQUEST_URI']);
		$type_request = strtolower($_SERVER['REQUEST_METHOD']);
		$request = strtolower($url);
		$path = explode("/", $request);
		if (count($path) > 1) {
			//echo "<BR>not null ";
			$controller_path = ucfirst($path[1]);
			$controller_name = $this->findController(ucfirst($path[1]), $type_request) . 'Controller';
			$controller_file = CTRLS . $this->findController($controller_path, $type_request) . '_Controller.php';
			//echo "<BR>name ".$controller_name;
			//echo "<BR>file ".$controller_file;
			//echo $controller;
			if ($this->findController($controller_path, $type_request) != false) {
				if (file_exists($controller_file)) {
					require_once($controller_file);
					if (!class_exists($controller_name)) {
						echo 'Controller class not exists!';
						require_once PNF;
						die();
					}

					$obj = new $controller_name();
					if (array_key_exists(2, $path)) {
						$method = $path[2];
					} else {
						$method = 'index';
					}
					//проверка метода
					if (!method_exists($obj, $method)) {
						echo "<BR>Required method not exists!";
						require_once PNF;
						die();
					} else {
						if (count($path) > 3) {
							//echo '<BR>count = ' . count($path);
							for ($i = 3; $i < count($path); $i++) {
								$args[] = $path[$i];
							}
							call_user_func_array([$controller_name, $method], $args);
							return;
						} else {
							$obj->$method();
							return;
						}
					}
				} else {
					echo "<BR>file not fount";
					require_once PNF;
					die();
				}
			} else {
				echo "<BR>Controller not found in array";
				require_once PNF;
				die();
			}
		} else {
			die();
		}
	}

	private function findController(string $ctrl, string $metod)
	{
		//echo "STRl = " . $ctrl;
		for ($i = 0; $i < count($this->routes[$metod]); $i++) {
			if ($this->routes[$metod][$i]['route'] == $ctrl) {
				return $this->routes[$metod][$i]['handler'];
			}
		}
		for ($i = 0; $i < count($this->routes['any']); $i++) {
			if ($this->routes['any'][$i]['route'] == $ctrl) {
				return $this->routes['any'][$i]['handler'];
			}
		}
		return false;
	}

	public function route(string $route, string $handler, string $method = "any")
	{
	//добавление массива роутов по методу
		if (empty($this->routes[$method])) {
			$this->routes[$method] = [];
		}
	//добавление роута
		$this->routes[$method][] = array(
			'route' => $route,
			'handler' => $handler
		);
	}
}
?>