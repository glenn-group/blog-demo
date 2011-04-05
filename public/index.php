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

$closuretree = new ClosureTree();
$closuretree->add('blog', array('get' => 'blog#index', 'post' => 'blog#create', 'delete' => 'blog#destroy'), 'Blog', function($blog){
	$blog->add('new');
	$blog->add('edit');
});
$closuretree->add('user', array('get' => 'user#index', 'post' => 'user#create', 'delete' => 'user#destroy'), 'User', function($users){
	$users->add('new');
});
$closuretree->add('*', 'blog#index', "CatchAll");

$router = new RouterTree('/blog-demo/public');
$router->addRoutes($closuretree->toArray());

require_once APP_PATH . 'vendor/ActiveRecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg) {
	$cfg->set_model_directory(APP_PATH . 'classes/model');
	$cfg->set_connections(array('development' => 'sqlite://blog.db'));
});

$request = new Request();
$frontController = new FrontController($router);
$response = $frontController->dispatch($request);
$response->send();