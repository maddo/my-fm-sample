<?php

namespace controller;

use \lib\SaltyHashBrowns;
use \controller\BaseController;

class Members extends BaseAuthController
{
	public function indexAction()
	{
		$this->render('members');
	}
}