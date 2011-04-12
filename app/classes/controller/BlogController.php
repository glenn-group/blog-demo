<?php
namespace app\controller;

use app\model\Post,
glenn\controller\Controller,
glenn\http\Response;

class BlogController extends Controller {
    public function indexAction() {
        $this->view->posts = Post::all();
    }

    public function newAction() {

    }

    public function editAction() {
        $pageURL = 'http';
        //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        //$pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        $parts = explode('/', $pageURL);
        $theid = $parts[4];
        $this->view->post = Post::find($theid);

    }



    public function viewAction() {

        $pageURL = 'http';
        //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        //$pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }

        $parts = explode('/', $pageURL);
        $theid = $parts[4];
        $this->view->post = Post::find($_POST[$theid]);

    }

    public function destroyAction() {

        $post = Post::find($_POST['myformid']);
        $post->delete();
        $message = "The post has been deleted!";
        $_SESSION['notice'] = $message;
        return Response::redirect('http://localhost/blog-demo/public/', 303);
    }

    public function createAction() {
        Post::create( $_POST['post'] );
        $message = "Thank you for your post!";
        $_SESSION['notice'] = $message;
        return Response::redirect('http://localhost/blog-demo/public/', 303);
    }
    public function updateAction() {

        $toEdit = Post::find( $_POST['post'] );
        echo 'katt';
    //    return Response::redirect('http://localhost/blog-demo/public/blog', 303);

    }

}