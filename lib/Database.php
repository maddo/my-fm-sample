<?php

namespace lib;

class Database {

	private $host;
	private $user;
	private $pass;
	private $database;
	private $persistent=0;
	private $last_query;
	private $result;
	private $connection_id;
	private $num_queries=0;
	private static $db;


	public static function getInstance()
	{
		if (!self::$db) {
			self::$db = new Database();
		}

		return self::$db;
	}

	private function __construct()
	{
        $this->configure(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connect();
        $c=$this->connection_id;
	}

	protected function configure($host, $user, $pass, $database, $persistent=0)
	{
		$this->host=$host;
		$this->user=$user;
		$this->pass=$pass;
		$this->database=$database;
		$this->persistent=$persistent;
		return 1;
	}

	protected function connect()
	{
		if( $this->persistent ) {
			$this->connection_id = mysql_pconnect($this->host, $this->user, $this->pass) or $this->connection_error();
		} else {
			$this->connection_id = mysql_connect($this->host, $this->user, $this->pass, 1) or $this->connection_error();
		}

		mysql_select_db($this->database, $this->connection_id);

		return $this->connection_id;
	}

	protected function disconnect()
	{
		if($this->connection_id) { 
			mysql_close($this->connection_id); $this->connection_id=0; return 1; 
		} else { 
			return 0; 
		}
	}

	public function query($query)
	{
		$this->last_query=$query;
		$this->num_queries++;
		$this->result = mysql_query($this->last_query, $this->connection_id) or $this->query_error();
		return $this->result;
	}

	public function fetch_row($result=0)
	{
		if( ! $result) { 
			$result = $this->result; 
		}
		return mysql_fetch_assoc($result);
	}

	public function num_rows($result=0)
	{
		if(!$result) { 
			$result = $this->result; 
		}
		return mysql_num_rows($result);
	}

	protected function connection_error()
	{
		die("<b>FATAL ERROR:</b> Could not connect to database on {$this->host} (".mysql_error().")");
	}

	protected function query_error()
	{
		// die("<b>QUERY ERROR:</b> ".mysql_error()."<br />
		// Query was {$this->last_query}");
		return false;
	}

	public function fetch_single($result=0)
	{
		if( ! $result) {
			$result = $this->result; 
		}
		return mysql_result($result, 0, 0);
	}

	public function escape($text)
	{
		return mysql_real_escape_string($text, $this->connection_id);
	}

	public function affected_rows($conn = NULL)
	{
		return mysql_affected_rows($this->connection_id);
	}
}