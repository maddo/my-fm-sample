<?php

namespace repository;

use \lib\Database;

abstract class Base
{
	protected $name;
	protected $model;
	protected $db;

	public function __construct()
	{
		$this->db = Database::getInstance();
		$this->name = strtolower( (string) $this);
        $this->model = '\model\\' . (string) $this;
	}

	protected function hydrate($res)
	{
		$obj = new $this->model;
		foreach($res as $key => $value)
		{
			$obj->set($key, $value);
		}
		return $obj;
	}

	public function __toString() { 
		$class = explode('\\', get_class($this)); 
		$name = end($class); 
		return $name;
	} 
}
        