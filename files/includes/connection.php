<?php
//define constants
// constants are variables that do not change

define("DB_SERVER", "localhost");
define("DB_USER", "leanneab_dbadmin");
define("DB_PASSWORD", "UNe?{w9g*7wG");
define("DB_NAME", "leanneab_getInMyBelly");

class Connection {

	//attributes
	private $mysqli;


	public function __construct() {
		$this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

	}

	//Close connection
	public function close_connection() {
		$this->mysqli->close();
	}

	//execute the passed in query and return result
	public function query($sql) {

		//execute query
		$result = $this->mysqli->query($sql);
		return $result;
	}


	// fetch a row from result_set as an associative array
	public function fetch_array($result_set) {
		return $result_set->fetch_assoc();
	}

	public function get_insert_id() {
		return $this -> mysqli -> insert_id;
	}

	public function escape ($sValue){

		return $this -> mysqli -> real_escape_string($sValue);
	}

}
