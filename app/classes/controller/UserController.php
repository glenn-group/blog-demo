<?php 
namespace app\controller;

use app\model\User,
glenn\controller\Controller,
glenn\http\Response;

class UserController extends Controller {

    public function indexAction() {
        $this->view->users = User::all();
    }

    public function newAction() {

    }

    public function viewAction() {

        //$pageURL = 'http';
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
        $this->view->user = User::find($theid);

    }

    public function destroyAction() {

        $user = User::find($_POST['userform']);
        $user->delete();
        $message = "The user has been deleted!";
        $_SESSION['notice'] = $message;
        return Response::redirect('http://localhost/blog-demo/public/user', 303);
    }

    public function createAction() {
        User::create( $_POST['user'] );
        $message = "User registered!";
        $_SESSION['notice'] = $message;
        return Response::redirect('http://localhost/blog-demo/public/user', 303);
    }
     public function updateAction() {

         
        $username = $_POST['user']['username'];
        $pass = $_POST['user']['password'];
        $user = User::find($username);
        $user->update_attributes(array('user' => $username, 'content' => $pass));
        return Response::redirect('http://localhost/blog-demo/public/blog/user', 303);

    }


}