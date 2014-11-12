<?php
$root_d = $_SERVER ['DOCUMENT_ROOT'];
require ("$root_d/Shopping/util/DB_Util.php");

$username = $_POST ['username'];

$db = new DB_Util ();
$db->db_conn ();
$result = mysql_query ( "SELECT count(*) From users WHERE username='$username'" );

/*
	how to send json to the clint after select query
 */
//  $response = array();
// while ($row = mysql_fetch_array($result)) {
// 	$array["username"] = $row["username"];
// 	$array["password"] = $row["password"];
// 	array_push($response, $array);
// }
// echo json_encode($response);

$num=mysql_fetch_array($result);
$db->db_close ();
echo $num[0];

?>