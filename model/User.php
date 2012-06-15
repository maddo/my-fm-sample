<?php

namespace model;

class User
{
	protected $id;

	protected $username;

	protected $password;


	/**
	 * @return int
	 */
	public function getId()
	{
	    return $this->id;
	}
	
	/**
	 * @param int $id
	 * @return \model\User $this
	 */
	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}


	/**
	 * [getUsername() Get user's unique identifier]
	 *
	 * @return string
	 */
	public function getUsername()
	{
	    return $this->username;
	}
	
	/**
	 * setUsername() Set user's unique identifier
	 *
	 * @param string $username 
	 * @return \model\User $this
	 */
	public function setUsername($newUsername)
	{
	    $this->username = $newUsername;
	    return $this;
	}


	/**
	 * [getPassword() Get user's encrypted password]
	 *
	 * @return [type] [description]
	 */
	public function getPassword()
	{
	    return $this->password;
	}
	
	/**
	 * [setPassword() description here]
	 *
	 * @param  [type] $password [description]
	 * @return [class type]    $this
	 */
	public function setPassword($newPassword)
	{
	    $this->password = $newPassword;
	    return $this;
	}

	public function set($key, $value)
	{
		$this->$key = $value;
	}
}