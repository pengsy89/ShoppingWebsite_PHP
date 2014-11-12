<?php
class DB_Util {
	private $conn="";
	function db_conn() {
		$this->conn = mysql_connect ( "localhost", "root", "" );
		mysql_select_db ( "shopping" );
		if (!($this->conn))
			die ( 'Could not connect: ' . mysql_error () );
	}
	function db_close() {
		mysql_close ($this->conn);
		$this->conn = "";
	}
}
?>