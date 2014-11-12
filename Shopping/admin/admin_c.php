<?php
$root_d = $_SERVER ['DOCUMENT_ROOT'];
require ("$root_d/Shopping/util/DB_Util.php");

if ($_POST ['status'] == 'adminlogin') {
	$adminname = $_POST ['loginname'];
	$adminpassword = $_POST ['loginpassword'];
	
	$db = new DB_Util ();
	$db->db_conn ();
	$result = mysql_query ( "select adminname, adminpassword from admin where adminname='$adminname'" );
	$row = mysql_fetch_array ( $result );
	if ($adminpassword == $row ['adminpassword']) {
		session_start ();
		$_SESSION ['admin'] = true;
		$_SESSION ['adminname'] = $adminname;
		echo "<script>location.href='adminindex.php';</script>";
	} else {
		echo "fail";
	}
	$db->db_close ();
} elseif ($_POST ['status'] == 'adminsignup') {
	$adminname = $_POST ['adminname'];
	$adminpassword = $_POST ['adminpassword1'];
	
	$db = new DB_Util ();
	$db->db_conn ();
	mysql_query ( "INSERT INTO admin (adminname, adminpassword) VALUES ('$adminname', '$adminpassword')" );
	$db->db_close ();
	echo "<script>location.href='../admin.php';</script>";
}elseif($_POST['status']=='showusers'){
	$db = new DB_Util ();
	$db->db_conn ();
	$result=mysql_query ( "select uid, username, email, phone, address from users" );
	$return_users=array();
	while($row=mysql_fetch_array ( $result )){
		$temp=array();
		$temp['uid']=$row['uid'];
		$temp['username']=$row['username'];
		$temp['email']=$row['email'];
		$temp['phone']=$row['phone'];
		$temp['address']=$row['address'];
		array_push($return_users, $temp);
	}
	
	$return=json_encode($return_users);
	
	echo $return;
	$db->db_close ();
}elseif($_POST['status']=='deleteusers'){
	echo "1";
}

?>