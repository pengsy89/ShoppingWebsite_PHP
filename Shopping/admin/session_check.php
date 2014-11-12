<?php
session_start ();
if(isset($_SESSION['admin']) && $_SESSION['admin']===true)
	echo "Welcome ".$_SESSION['adminname'];
else
	echo "<script>location.href='../admin.php';</script>";
?>