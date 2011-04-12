<?php
define('BASE_PATH', realpath('../') . DIRECTORY_SEPARATOR);
define('APP_PATH', BASE_PATH . 'app' . DIRECTORY_SEPARATOR);
define('EXTRAS_PATH', BASE_PATH . 'extras' . DIRECTORY_SEPARATOR);
define('SYSTEM_PATH', BASE_PATH . 'system' . DIRECTORY_SEPARATOR);

use glenn\config\Config,
	glenn\controller\Dispatcher,
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
/*
$closuretree->add(
	$string in format "controller#action", "#action" or array('get' => $string, 'otherhttpmethod' => $string),
	$pattern = $action,
	$name = ucfirst($action),
	$sub => function($childtree) {
		$childtree->add(.....)
		$childtree->add(....... , function($childtree2){
		
		})
	
	}
EXAMPLES...
	 )

*/
$closuretree ->add('', 'blog#index','index');

$closuretree->add('blog', array('get' => 'blog#index', 'post' => 'blog#create', 'put' => 'blog#update', 'delete' => 'blog#destroy'), 'Blog',function($blog){
	$blog->add("new"); // pattern => blog/edit
	$blog->add("*", array('get' => 'notSpecified!', 'delete' => 'blog#destroy'), 'id', function($id) {
            $id->add('edit');
        });
	
	
	//$blog->add("#category","<*>","Category",function($category){
			
		//$category->add("#view","<*>","Title");
	//});
});
$closuretree->add('user',array('get' => 'user#index', 'post' => 'user#create', 'delete' => 'user#destroy'), 'User', function($user){
	$user->add("new");
	$user->add("login");

});
$closuretree->add('*', 'blog#index', "CatchAll");

$router = new RouterTree('/glenn-blog/public');
$router->addRoutes($closuretree->toArray());

require_once APP_PATH . 'vendor/ActiveRecord/ActiveRecord.php';
ActiveRecord\Config::initialize(function($cfg) {
	$cfg->set_model_directory(APP_PATH . 'classes/model');
	$cfg->set_connections(array('development' => 'sqlite://blog.db'));
});

$request = new Request();
$frontController = new Dispatcher($router);
$response = $frontController->dispatch($request);
$response->send();