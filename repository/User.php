<?php

namespace repository;

class User extends \repository\Base {

	public function getUserById($id)
	{
		$q = "SELECT * FROM {$this->name} WHERE id = {$id}";
		$res = $this->db->query($q);
		if ($this->db->num_rows() > 0) {
			$user = $this->db->fetch_row();
			return $this->hydrate($user);
		}
	}

	public function getUserByUsername($username)
	{
		$u = $this->db->escape($username);
		$q = "SELECT * FROM {$this->name} WHERE username = '{$u}'";
		$res = $this->db->query($q);
		if ($this->db->num_rows() > 0) {
			$user = $this->db->fetch_row();
			return $this->hydrate($user);
		}
	}

	public function addUser(\model\User $user)
	{
		$u = $this->db->escape($user->getUsername());
		$password = $user->getPassword();
		$q = "INSERT INTO {$this->name} (username, password) VALUES ('{$u}', '{$password}')";
		$res = $this->db->query($q);
		
	}

}