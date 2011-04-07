<?php
define('BASE_PATH', realpath('../') . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('EXTRAS_PATH', BASE_PATH . 'extras' . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', BASE_PATH . 'system' . DIRECTORY_SEPARATOR);

use glenn\config\Config,
	glenn\controller\FrontController,
	glenn\http\Request,
	glenn\loader\Loader,
	glenn\error\ErrorHandler,
	glenn\router\RouterTree,
	glenn\router\datastructures\TreeArray,
	glenn\router\datastructures\ClosureTree;

require SYSTEM_PATH . 'classes/loader/Loader.php';
Loader::registerAutoloader();
Loader::registerModules(array(
	'app'   => APP_PATH,
	'glenn' => SYSTEM_PATH
));

ErrorHandler::register();

$request = new Request();
$controller = new \glenn\test\Controller($request, new \glenn\view\View('test'));
$controller->index();
$response = new \glenn\http\Response($controller->view()->render());
$response->send();