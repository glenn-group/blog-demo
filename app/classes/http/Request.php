<?php
namespace app\http;

class Request extends \glenn\http\Request
{
	public function __construct($uri = null, $method = null)
	{
		parent::__construct($uri, $method);
		echo 'Overridden.';
	}

}