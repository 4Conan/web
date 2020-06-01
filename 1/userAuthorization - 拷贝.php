<?php
	require("../php/session.php");
	require("./fun.Authorization.php");


if ($_SESSION['user']) != 'admin') 
{
	exit();
}

?>


<?php
//session_start();
//$leveStr = $_SESSION['leve'];
//
//$uploadPublic =  $leveStr / 1 % 10;
//$downPublic =  $leveStr / 10 % 10;
//$uploadPrivate =  $leveStr / 100 % 10;
//$downPrivate =  $leveStr / 1000 % 10;
?>

<!DOCTYPE html >
<html>
 <head>
	 <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/css/bootstrap.min.css">
	 	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	 <style>
        fieldset {
            padding: .35em .625em .75em;
            margin: 0 2px;
            border: 1px solid silver;
        }

        legend {
            padding: .5em;
            border: 0;
            width: auto;
        }
		 label{
			  margin: 0 .5em;
		 }
    </style>

</head>

<body>
	<form method="post" action="">
		<table width="50%" border="0" cellspacing="0" cellpadding="0">
			<tr><td>
				 <fieldset>
					<legend>管理用户私有权限</legend>
					 <label>
						 <input type='checkbox' class='checkbox'id='downPrivate' 
								<?php 
									if(canDownPrivate()) 
										echo "checked='checked'" ;
								?>
						 >下载私有
					 </label>
					 <label>
						 <input type='checkbox' class='checkbox'id='uploadPrivate'
								<?php 
									if(canUploadPrivate()) 
										echo "checked='checked'";
								?>
						>上传私有
					 </label>
					 <label>
						 <input type='checkbox' class='checkbox'id='downPublic' 	
								<?php
										if(canDownPublic()) 
										echo "checked='checked'" ;
								?>
						>下载公有
					 </label>
					 <label>
						 <input type='checkbox' class='checkbox' id='uploadPublic' 	
								<?php
										if(canUploadPublic()) 
										echo "checked='checked'" ;
								?>
						>上传公有
					 </label>
				</fieldset>
			</td></tr>
		</table>
		<input type="button" value="确定修改" id="bntChange">
	</form>
<script language="javascript" type="text/javascript"> 
	$('#bntChange').click(function(){
			alert("bntChange click");
			var uploadPublic 	= $('#uploadPublic').is(':checked')?1:0; 
			var downPublic 		= $('#downPublic').is(':checked')?1:0;
			var uploadPrivate 	= $('#uploadPrivate').is(':checked')?1:0;
			var downPrivate 	= $('#downPrivate').is(':checked')?1:0;
			var leveStr = uploadPublic+(downPublic*10)+(uploadPrivate*100)+(downPrivate*1000);
			var obj = {"leveStr":leveStr,"mode":"ModifyPermissions"};
			var s =  document.createElement("script");
			s.src = "./userAuthorization_server.php?jsonStr=" + JSON.stringify(obj);
			document.body.appendChild(s);
		});
	function callbackDebug(info)
	{
		alert(info);	
	}
	function callbackGoUrl(info,url)
	{
		alert(info);
		window.location.href = url;
	}
</script>
 </body>
</html>