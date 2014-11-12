<?php

class sql_help{
	private $username;
	private $password;
	private $dbname;
	private $host;
	private $conn;

	public function __construct($host,$username,$password,$dbname){
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
	}

	public function getConnection(){
		$this->conn = mysql_connect($this->host,$this->username,$this->password)
		or die("cannot connect to database".mysql_error());
		mysql_select_db($this->dbname,$this->conn)
		or die("cannot use the input database".mysql_error());
	}

	//transfer information from pointer to array.
	public function execute_dql($sql){
		$res = mysql_query($sql,$this->conn)
		or die("there is an error in the SQL".mysql_error());
		//get poiner pointing to first of the information searched
		$arr = array();
		$i = 0;
		while( $row = mysql_fetch_row($res)){
			$arr[$i++] = $row;
			//save the information into an array, the reason is to free this pointer in this function
		}
		mysql_free_result($res);
		//free the pointer, if information have not saved in above array,
		//the pointer cannot be freed here coz it is still needed to be used.
		return $arr;
	}

	public function execute_dml($sql){
		mysql_query($sql,$this->conn)
		or die("there is an error in the SQL".mysql_error());
		$num = mysql_affected_rows();
		return $num;
	}

	public function closeConnection(){
		mysql_close($this->conn)
		or die("cannot close the connection".mysql_error());
	}

}

?>
