<?php
define('ROOT',dirname(__FILE__).'/');
define('APP', ROOT.'application/');
define('CORE', APP.'Core/');

$scope = glob(CORE.'*');
foreach($scope as $file)
{
	require_once($file);
}
require_once(APP.'router.php');
$router = Router::getInstance();
$router->process();

?>