<?php

namespace controller;

use \core\Session;

abstract class BaseController
{
	public function __construct($method) 
	{
		$fullMethod = $method . 'Action';
		if (method_exists($this, $fullMethod)) {
			$this->$fullMethod();
		} else {
			$this->redirect('NotFound');
		}
	}

	protected function indexAction()
	{
		$this->render($this->name);
	}

	public function render($name, $data = null)
	{

		$session = Session::getInstance();
		$data['userData'] = $session->getUserData();
		$data['flash'] = $session->getFlash();
		$session->clearFlash();

		ob_start();
		include VIEW_PATH . '/' . $name . '.php';
		$content = ob_get_contents();
		ob_end_clean();

		include VIEW_PATH . '/base.php';
	}

	public function redirect($controller, $method = null)
	{
		$host  = $_SERVER['HTTP_HOST'];

		$uri = array($host, strtolower($controller), strtolower($method));
		$uri = join('/', $uri);
		$url = "http://$uri";

		header("Location: $url");
		die();
	}

	public function setFlash($msg, $key = 'bucket')
	{
		$session = Session::getInstance();
		$session->setFlash($msg, $key);
	}
}