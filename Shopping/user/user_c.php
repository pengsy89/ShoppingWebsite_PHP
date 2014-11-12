<?php
$root_d = $_SERVER ['DOCUMENT_ROOT'];
require ("$root_d/Shopping/util/DB_Util.php");
// require "../../util/DB_Util.php";
if ($_POST ['status'] == 'register') {
	
	$username = $_POST ['username'];
	$password = $_POST ['password1'];
	$phone = $_POST ['phone'];
	$email = $_POST ['email'];
	$address = $_POST ['address'];
	
	$db = new DB_Util ();
	$db->db_conn ();
	mysql_query ( "INSERT INTO users(username, password, email, phone, address) VALUES ('$username', '$password', '$phone', '$email', '$address')" );
	$db->db_close ();
	echo "<script>location.href='../index.php';</script>";
	
	
} elseif ($_POST ['status'] == 'login') {
	
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	
	$db = new DB_Util ();
	$db->db_conn ();
	$result = mysql_query ( "select username, password from users where username='$username'" );
	
	$row = mysql_fetch_array ( $result );
	
	if ($password == $row ['password']) {
		session_start ();
		$_SESSION ['user'] = true;
		echo "1";
	} else {
		echo "0";
	}
	
	$db->db_close ();
	
}elseif ($_POST ['status'] == 'logout') {
	session_start ();
	unset($_SESSION); 
    session_destroy(); 
	echo "1";
}
?>