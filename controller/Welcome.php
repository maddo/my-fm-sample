<?php

namespace controller;

use \controller\BaseController;

class Welcome extends BaseController
{
	public function indexAction()
	{
		$this->render('welcome');
	}
}