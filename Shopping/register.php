<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
<script type="text/javascript" src="lib/SHA-256.js"></script>
<script>
$(document).ready( function() {
	$("#username").blur(function (){
		$.ajax({
		      url: "Ajax/username_a.php",
		      type: "POST",
		      data: {"username" : $(this).val()},
		      datatype: "json",
		      success: function(response){// if the returned format is JSON, it should be parsed
 			      if(response>0)
		    	  $("#username_exist").text("The username is existed!");
 			      else
  			   	  $("#username_exist").text("You can use this username!");
		      },
		      error:function(xhr, ajaxOptions, thrownError){
		    	  alert(thrownError);
		      }   
		    }); 
	});
	
	$("#password2").blur(function (){
		$ps2=Sha256.hash($(this).val());
		$ps1=Sha256.hash($("#password1").val());
		
		if( $ps1 != $ps2){ //first should consider if password is null
			$("#confirm").text("Not match!");
		}else{
			$("#confirm").text("Match!");
		}
	});
});
</script>

<title>Register</title>
</head>

<body>
	<div id="login_div">
		<form action="user/user_c.php" method="post" id="login_form"
			name="login_form">
			<input type="hidden" name="status" value="register">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" id="username"></td>
					<td><span id="username_exist"></span></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password1" id="password1"></td>
					<td></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input type="password" name="password2" id="password2"></td>
					<td><span id="confirm"></span></td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td><input type="text" name="email" id="email"></td>
					<td></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><input type="number" name="phone" id="phone"></td>
					<td></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><input type="text" name="address" id="address"></td>
					<td></td>
				</tr>
			</table>
		</form>
			<button onclick="reg()">Submit</button>
	</div>


	<script type="text/javascript">  
function reg()
{
 	var password1 = document.getElementById("password1");
    var SHApassword1 = Sha256.hash(password1.value);
	password1.value=SHApassword1;

 	var password2 = document.getElementById("password2");
    var SHApassword2 = Sha256.hash(password2.value);
	password2.value=SHApassword2;

	if(password1.value==password2.value){
		login_form.submit();
	}else{
		password2.value="";
		password1.value="";
	}
}
</script>
</body>
</html>