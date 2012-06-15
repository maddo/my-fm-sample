<?php

namespace controller;

use \lib\SaltyHashBrowns;
use \controller\BaseController;

class Unauthorized extends BaseController
{
	public function indexAction()
	{
		$this->render('unauthorized');
	}
}