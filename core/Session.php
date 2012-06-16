<?php

namespace core;

class Session
{
	private static $session;
	private $data;

	private function __construct()
	{
		@session_start();
	}

	public function getInstance()
	{
		if (!self::$session) {
			self::$session = new Session();
		}
		return self::$session;
	}

	public function terminate()
	{
		session_destroy();
	}

	public function set($key, $value)
	{
		$data = $this->getSessionData();

		$data[$key] = $value;

		$this->setSessionData($data);
	}

	public function get($key)
	{
		$data = $this->getSessionData();
		if (isset($data[$key])) {
			return $data[$key];
		}
	}

	private function getSessionData()
	{
		if (! isset($_SESSION['sec'])) {
			$_SESSION['sec'] = '';
		}
		$data = $_SESSION['sec'];
		return unserialize($data);
	}

	private function setSessionData($data) 
	{
		$_SESSION['sec'] = serialize($data);
	}

	public function setUserData(\model\User $user)
	{
		$this->set('authorized', true);
		$this->set('username', $user->getUsername());
	}

	public function getUserData()
	{
		if ($this->isLoggedIn()) {
			$userData = array(
				'username' => $this->get('username'),
				'authorized' => $this->get('authorized')
			);
			return $userData;
		} else {
			$userData = array(
				'authorized' => false,
			);
		}

		return $userData;
	}

	public function isLoggedIn()
	{
		return (bool) $this->get('authorized');
	}

	public function getFlash()
	{
		$data = $this->getSessionData();
		return $data['flash'];
	}

	public function setFlash($msg, $key)
	{
		$data = $this->getSessionData();
		if ( ! isset($data['flash']['key'])) {
			$data['flash']['key'] = array();
		}
		$data['flash'][$key][] = $msg;
		$this->setSessionData($data);
	}

	public function clearFlash()
	{
		$data = $this->getSessionData();
		$data['flash'] = null;
		$this->setSessionData($data);
	}
}