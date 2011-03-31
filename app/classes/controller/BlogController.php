<?php
namespace app\controller;

use app\model\Post,
	glenn\controller\Controller,
    glenn\http\Response,
	_\http\Cookie;

class BlogController extends Controller
{
	public function indexAction()
	{
		$cookie = $this->request()->cookie('time');
		if ($cookie !== false) {
			$this->view()->extra = "Cookie was set, value: {$cookie->value()}";
			$cookie->delete();
		} else {
			$cookie = new Cookie('time', time(), Cookie::MINUTE);
			$cookie->save();
			$this->view()->extra = "No cookie exists.";
		}
		$this->view->posts = Post::all();
	}

	public function newAction()
	{
		
	}

	public function createAction()
	{
		return Response::redirect('http://glenn.blog.local/blog/', 303);
	}
}