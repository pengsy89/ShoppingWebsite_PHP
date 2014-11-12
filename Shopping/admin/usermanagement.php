<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Administrator Control System</title>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
<?php
require 'session_check.php';
?>

<script>
$(document).ready(function(){
	$("#showusers").click(function(){
		$.ajax({
			 url: "admin_c.php",
		      type: "POST",
		      data: {"status" : "showusers" },
		      datatype: "json",
		      success: function(response){// if the returned format is JSON, it should be parsed
// 					alert(response);
					var arr=eval('('+response+')');
					var str="<table border='1' cellpadding='3'><tr><td></td><td>UID</td><td>Username</td><td>Email</td><td>Phone Number</td><td>Address</td><td>Management</td></tr>";
					for(var i=0;i<arr.length;i++){
						str+="<tr><td><input type='checkbox' value='"+i+"' name='select'/></td><td>"+arr[i].uid+"</td><td>"+arr[i].username+"</td><td>"+arr[i].email+"</td><td>"+arr[i].phone+"</td><td>"+arr[i].address+"</td><td><span id='delete"+i+"'>Delete</span></td></tr>";
						}
						str+="</table><button id='selectall'>Select All</button>";
						str+="</table><button id='deletebutton'>Delete</button>";
					$("#users").html(str);

					$("#selectall").click(function(){
							$("input[name='select']").attr("checked",'true');
						});
					
					$("#deletebutton").click(function(){
						var checkednumber="";
					    $("input[name='select']").each(function(){// can't use $("input[name='select'][checked]").each
					        if ("checked" == $(this).attr("checked")) {
					        	checkednumber+=$(this).attr('value')+",";
					        }
					        });
				        alert(checkednumber);
				        deleteAjax(checkednumber);
						});
		      },
		      error:function(xhr, ajaxOptions, thrownError){
		    	  alert(thrownError);
		      }  
			});
	});
});

function deleteAjax(str){
	$.ajax({
		 url: "admin_c.php",
	      type: "POST",
	      data: {"status" : "deleteusers", "checked":str },
	      datatype: "json",
	      success: function(response){// if the returned format is JSON, it should be parsed
				alert("1");
	      },
	      error:function(xhr, ajaxOptions, thrownError){
	    	  alert(thrownError);
	      },
		});
}
</script>

</head>

<body>
	<p></p>

	<button id="showusers">Show All Users</button>
	
	<div id="users"></div>

</body>