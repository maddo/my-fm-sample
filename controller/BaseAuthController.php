<?php

namespace controller;

use \core\Session;

class BaseAuthController extends BaseController
{
	public function __construct($method) 
	{
		$session = Session::getInstance();
		
		if ($session->isLoggedIn()) {
			parent::__construct($method);
		} else {
			$this->redirect('unauthorized');
		}
	}
}