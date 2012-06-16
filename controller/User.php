<?php

namespace controller;

use \lib\SaltyHashBrowns;
use \controller\BaseController;
use \repository\User as UserRepository;
use \model\User as UserModel;
use \core\Session;

class User extends BaseController
{
	public function indexAction()
	{
		$this->loginAction();
	}

	public function loginAction()
	{
		$this->render('login');
	}

	public function logoutAction()
	{
		$this->render('logout');
	}

	public function registerAction()
	{
		$this->render('register');
	}

	public function authorizeAction()
	{
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		
		// Create a new hasher with the posted password
		$hasher = new SaltyHashBrowns($password);

		// Get info from db based on username
		$userRepo = new UserRepository();

		$user = $userRepo->getUserByUsername($username);

		if ( ! $user) {
			$this->setFlash('Sorry, we were unable to locate you, please check your login info and try again.', 'error');
			$this->redirect('user', 'login');
		}

		$dbPassword = $user->getPassword();

		if ($hasher->isValidHash($dbPassword)) {

			$session = Session::getInstance();
			$session->setUserData($user);

			$this->setFlash('You are logged in!', 'success');
			$this->redirect('members');
		} else {
			$this->setFlash('Password doesn\'t seem quite right', 'error');
			$this->redirect('user', 'login');
		}
	}

	public function deauthorizeAction()
	{
		$session = Session::getInstance();
		$session->terminate();
		$this->redirect('user', 'logout');
	}

	public function registrationAction()
	{
		if ( ! isset($_POST['username']) 
			|| ! isset($_POST['username'][0])
			|| ! isset($_POST['password']) 
			|| ! isset($_POST['password'][0]) 
			|| ! isset($_POST['password_password'])
			|| ! isset($_POST['password_password'][0] )) {

			$this->setFlash('Please try again, ensure all fields are completed', 'error');
			$this->redirect('user', 'register');
		}

		$username = $_POST['username'];

		if ( ! $this->validUserName($username)) {
			$this->setFlash('Please choose a username from 5 to 20 characters long! Choose from letters, numbers and underscores', 'error');
			$this->redirect('user', 'register');
		}

		$password = $_POST['password'];
		$p2 = $_POST['password_password'];
		
		if ($password == $p2) {
			$hasher = new SaltyHashBrowns($password);
			$hashedPassword = $hasher->getHash();
		} else {
			$this->setFlash('Sorry, the passwords did not match!', 'error');
			$this->redirect('user', 'register');
		}

		$user = new UserModel();
		$user->setUsername($username);
		$user->setPassword($hashedPassword);

		$userRepo = new UserRepository();

		if ($userRepo->addUser($user) !== false) {
			$this->setFlash('Registration successful! Please login!', 'success');
			$this->redirect('user', 'login');
		} else {
			$this->setFlash('Sorry! There was an error with your registration. Please try again', 'error');
			$this->redirect('user', 'registration');
		}

	}

	public function errorAction()
	{
		$this->render('loginerrors');
	}

	protected function validUserName($username)
	{
		$pattern = '/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/';

		if (preg_match($pattern, $username)) {
			return true;
		}

		return false;
	}
}