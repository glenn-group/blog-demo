<?php
namespace app\controller;

use app\model\Post,
glenn\controller\Controller,
    glenn\http\Response;

class BlogController extends Controller
{
public function indexAction()
{
$this->view->posts = Post::all();
}

public function newAction()
{

}

public function destroyAction()
{
	Post::delete( $_POST['myformId'] );
	$message = "The ".$_POST['post']['title']." post has been deleted!";
	$_SESSION['notice'] = $message;
	return Response::redirect('http://localhost/blog-demo/public/', 303);
}

public function createAction()
{
	Post::create( $_POST['post'] );
	$message = "Thank you for your post!";
	$_SESSION['notice'] = $message;
	return Response::redirect('http://localhost/blog-demo/public/', 303);
}


}