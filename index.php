<?php
define('ROOT',dirname(__FILE__).'/');
define('APP', ROOT.'application/');
define('CORE', APP.'Core/');
define('CTRLS', APP.'controllers/');
define('PNF', ROOT.'404.php');

$scope = glob(CORE.'*');
foreach($scope as $file)
{
	require_once($file);
}
require_once(APP.'router.php');
$router = Router::getInstance();
$router->process();

?>