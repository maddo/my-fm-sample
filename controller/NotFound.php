<?php
namespace controller;

use controller\BaseController;

class NotFound extends BaseController
{
	public function __construct($method = 'index') 
	{
		parent::__construct($method);
	}

	public function indexAction()
	{
		$this->render('404');
	}
}