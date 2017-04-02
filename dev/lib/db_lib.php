<?php
class db {
	private $db;
	public $error;
	public $error_msg;

	/**
	 * Initialize the db connection based on the variables from the config.php and set db encoding format to utf8
	 */
	public function __construct() {
		
		//include the config file
		require_once('config.php');

		if($this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {

			//Set every possible values to utf-8 encoding format
			$this->db->query("SET NAMES 'utf8'");
			$this->db->query("SET CHARACTER SET 'utf8'");
			$this->db->query('SET character_set_results = "utf8",' .
        		'character_set_client = "utf8", character_set_connection = "utf8",' .
        		'character_set_database = "utf8", character_set_server = "utf8"');
		} else {
			$this->error = true;
			$this->error_msg = "Unable to connect to DB";
		}
	}

	/**
	 * Check whether the error exists on sqli query function
	 * @param  sqli_function $function db query function
	 * @param  user_query $query    [description]
	 * @return boolean           Return false if there is no error otherwise return true if error exists
	 */
	private function error_tests($function, $query) {
		echo $this->db->error;
		if($this->error_msg = $this->db->error) {
			$this->error  = true;
		} else {
			$this->error = false;
		}
	}

	/**
	 * Create a standard date format for insertion of data from php into mysql
	 * @param  date $php_date Pass the date parameter
	 * @return date           Converting into standard date format
	 */	
	public function date($php_date) {
		return date('Y-m-d H:i:s', strtottime($php_date));
	}


	/**
	 * All text added to the DB should be cleaned with mysqli_real_escape_string inorder to block sql injection queries
	 * @param  string $str content
	 * @return string      escaped string
	 */
	public function escape($str) {
		return $this->db->real_escape_string($str);
	}

	/**
	 * Check whether the query exists to particular condition
	 * @param  string $table table_name
	 * @param  string $where sql_query_condition
	 * @return boolean        Returns true if exists otherwise returns false if not exists in table
	 */
	public function in_table($table, $where) {
		$query = "SELECT * FROM ".$table." WHERE ".$where;
		$result = $this->db->query($query);
		// print_r($result);
		$this->error_tests('select',$query);
		return $result->num_rows > 0;
	}

	/**
	 * Check whether the query exists to particular condition
	 * @param  string $table table_name
	 * @param  string $field_id choose_particular_field
	 * @param  string $where sql_query_condition
	 * @return boolean        Returns true if exists otherwise returns false if not exists in table
	 */
	public function get_num_rows($table, $field_id, $where) {
		if($where) 
			$query = "SELECT * FROM ".$table." WHERE ".$where;
		else 
			$query = "SELECT ".$field_id." FROM ".$table;
		
		$result = $this->db->query($query);
		$this->error_tests('select',$query);
		return $result->num_rows;
	}

	/**
	 * Perform generic select query
	 * @param  string $query select_query
	 * @return Pointer        return a pointer to the result
	 */
	public function select($query) {
		$result = $this->db->query($query);
		$this->error_tests('select', $query);
		return $result;
	}

	/**
	 * Perform generic insert query
	 * @param  string $query select_query
	 * @return Pointer        return a pointer to the result
	 */
	 public function insert($table, $field_values) {
		 $query = 'INSERT INTO '.$table.' SET '.$field_values;
		 $result = $this->db->query($query);
		 $this->error_tests('insert',$query);
		 return $result;
	 }

	 /**
	 * Perform generic update query
	 * @param  string $query update_query
	 * @return Pointer        return a pointer to the result
	 */
	 public function update($table, $field_values, $where) {
		 $query = 'UPDATE '.$table.' SET '.$field_values.' WHERE '.$where;
		 $result = $this->db->query($query);
		 echo $this->db->error;
		 $this->error_tests('update', $query);
		 return $result;
	 }

	 /**
	  * Perform delete operation
	  * @param  string $table enter_table_name
	  * @param  string $where Condition__query_for_deletion
	  * @return [type]        [description]
	  */
	 public function delete($table, $where) {
	 	$query = 'DELETE FROM '.$table.' WHERE '.$where;
	 	$result = $this->db->query($query);
	 	$this->error_tests('delete', $query);
	 	return $result;
	 }

	 /**
	 * Perform SQL Close 
	 */
	 public function __destruct(){ 
		$this->db->close();
	 }
}

?>