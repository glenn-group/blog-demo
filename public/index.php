<?php
define('START_TIME', microtime(true));
define('BASE_PATH', realpath('../') . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', BASE_PATH . 'system' . DIRECTORY_SEPARATOR);

use glenn\loader\Loader,
	_\error\ErrorHandler,
	_\router\datastructures\TreeArray,
	_\router\RouterTree,
	_\http\Request,
	_\controller\FrontController as FrontController;

require SYSTEM_PATH . 'classes/loader/Loader.php';
Loader::registerAutoloader();
Loader::registerModules(array(
	'app'   => APP_PATH,
	'glenn' => SYSTEM_PATH
));

ErrorHandler::register();

$tree = new TreeArray();
$tree->addParent('Blog', 'blog', '/', array('get' => 'blog#index', 'post' => 'blog#create'));
$tree->addParent('Category', '<*>', '/blog', '#category');
$tree->addChild('Title', '<*>', '#view');
$tree->addParent('CatchAll', '*', '/', 'blog#index');

$router = new RouterTree('/glenn/demos/blog/public');
$router->addRoutes($tree->toArray());

require_once APP_PATH . 'vendor/ActiveRecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg) {
	$cfg->set_model_directory(APP_PATH . 'classes/model');
	$cfg->set_connections(array('development' => 'sqlite://blog.db'));
});

$request = new Request();
$frontController = new FrontController($router);
$response = $frontController->dispatch($request);
$response->send();

define('END_TIME', microtime(true));
echo 'Time: ' . round((END_TIME-START_TIME)*1000, 2) . ' ms<br />';
echo 'Memory: ' . round(memory_get_peak_usage()/1024, 3). ' KiB';
