<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
<script type="text/javascript" src="lib/SHA-256.js"></script>
<script>
$(document).ready(function(){
	$("#login").click(function(){

	    var password = $("#password").val();
	    var SHApassword = Sha256.hash(password);

		$.ajax({
		      url: "user/user_c.php",
		      type: "POST",
		      data: {"status" : "login", "username" : $("#username").val(), "password" : SHApassword },
		      datatype: "json",
		      success: function(response){// if the returned format is JSON, it should be parsed
				if(response=="1"){
					$("#table").hide();
					$("#logged").show();
				}
		      },
		      error:function(xhr, ajaxOptions, thrownError){
		    	  alert(thrownError);
		      }  
		});
	});


	$("#logout").click(function(){
		$.ajax({
		      url: "user/user_c.php",
		      type: "POST",
		      data: {"status":"logout"},
		      datatype: "json",
		      success: function(response){// if the returned format is JSON, it should be parsed
			      $("p").text("unset");
				if(response=="1"){
					$("#logged").hide();
					$("#table").show();
					
				}
		      },
		      error:function(xhr, ajaxOptions, thrownError){
		    	  alert(thrownError);
		      }  
		});
	});
});
</script>

<style type="text/css">
body{
	margin-left: 300px;
	margin-right: 300px;
}
</style>

<?php
session_start ();
?>
</head>

<body>
	<div class="whole">
		<span id="p"></span>
		
		<div id="image" style="float:left;">
		<img src="pic/logo.jpg">
		</div>

		<div id="logged" style="float:right;">
			<label>Welcome</label>
			<button id="logout">Log out</button>
		</div>

		<div id="table" style="float:right;">

			<input required placeholder="Username" type="text" name="username"	id="username"> <br/>
			<input required placeholder="Password"	type="password" name="password" id="password"> <br/>

			<button id="login" style="margin-right :20px">Login</button>
			<button id="signup"	onclick="javascript: window.location.href='/Shopping/register.php'">Sign up</button>

		</div>
	
	<?php
	if (isset ( $_SESSION ['user'] ) && $_SESSION ['user'] === true) {
		?>
<script>
$("#logged").show();
$("#table").hide();
		</script>


<?php
	} else {
		?>
	<script>
$("#table").show();
$("#logged").hide();
		</script>
<?php
	}
	?>

</div>

</body>
</html>
