<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
<script type="text/javascript" src="lib/SHA-256.js"></script>
</head>

<?php
?>
<script>
function match(){
 	var password1 = document.getElementById("adminpassword1");
    var SHApassword1 = Sha256.hash(password1.value);
	password1.value=SHApassword1;

 	var password2 = document.getElementById("adminpassword2");
    var SHApassword2 = Sha256.hash(password2.value);
	password2.value=SHApassword2;

	if(password1.value==password2.value){
		adminsignup.submit();
	}else{
		password2.value="";
		password1.value="";
	}
}

function passtrans(){
 	var password = document.getElementById("loginpassword");
    var SHApassword = Sha256.hash(password.value);
	password.value=SHApassword;
	adminlogin.submit();
}

</script>
<body>

	<div style="text-align: center;">
		<form action="admin/admin_c.php" method="post" name="adminsignup">
		<input type="hidden" name="status" value="adminsignup">
			<span style="color: red">Register</span><br/>
			Admin Name: <input type="text"	name="adminname" id="adminname"> 
			Admin Password: <input type="password" name="adminpassword1" id="adminpassword1"> 
			Comfirm	Password: <input type="password" name="adminpassword2"	id="adminpassword2">
		</form>
		<button onclick="match()">Sign up</button>
		<p></p>
		<form action="admin/admin_c.php" method="post" 	name="adminlogin">
		<input type="hidden" name="status" value="adminlogin">
			<span style="color: red">Log in</span><br/>
			Admin Name: <input type="text" name="loginname" id="loginname"> 
			Admin Password: <input type="password"	name="loginpassword" id="loginpassword">
		</form>
		<button onclick="passtrans()">Login</button>
	</div>
</body>