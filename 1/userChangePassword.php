<?php
	require("../php/session.php");
?>
<!DOCTYPE html>
<html>
  <head>

   
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
 <title>科凌峰远程管理系统</title>
	   <script type="text/javascript">
			"use strict";
			function changePasswordClick()
			{
				var oldPassword = document.getElementById("changePassword-oldPassword").value;
				var password = document.getElementById("changePassword-password").value;
				var obj = { "oldPassword":oldPassword, "password":password, "mode":"changePassword" };
				var s =  document.createElement("script");
				s.src = "../php/loginOrRegister.php?jsonStr="  + JSON.stringify(obj);
				document.body.appendChild(s);
			}
		    function callbackHref(data)
		   	{
				alert(data.info);
				var hrefArr = [" ", "home.php", "login.html"];
				if(data.isSuccess)
				{
					var index = data.href;
					if( index > 0 && index < hrefArr.length)
					{
						window.location.href ="../login.html";
					}
				}
			}
		   	function callbackDebug(info)
			{
				alert(info);	
			}
	</script>
  </head>
  <body>
	<div class="main">
		<?php include 'top.php' ?>
		<div class="info">
		  <p>账号：<?php  session_start();  echo $_SESSION['user'];?></p>
		  <input id="changePassword-oldPassword" class="input-material" type="password" name="changePasswordUsername" placeholder="请输入旧密码" >
			
			<br/><br/>

		
		  <input id="changePassword-password" class="input-material" type="password" name="changePasswordPassword" placeholder="请输入新密码"   >
			<br/><br/>
		
		  <input id="changePassword-passwords" class="input-material" type="password" name="changePasswordPasswords" placeholder="确认密码"   >
			<br/><br/>
		
		  <button id="regbtn" type="button" name="changePasswordSubmit" class="btn btn-primary" onClick="return changePasswordClick()">确定</button>
	</div>
</div>

	   <!-- JavaScript files-->
    <script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <script>
    	$(function(){
    		/*错误class  form-control is-invalid
    		正确class  form-control is-valid*/
    		var flagName=false;
    		var flagPas=false;
    		var flagPass=false;
 
    		var name,passWord,passWords;
    		/*验证密码*/
    		$("#changePassword-password").keyup(function(){
    			passWord=$("#changePassword-password").val();
    			if(passWord.length<6||passWord.length>18){
					alert("新密码应该在6到18位之间！");
    				flagPas=false;
    			}else{

    				flagPas=true;
    			}
    		})
    		/*验证确认密码*/
    		$("#changePassword-passwords").keyup(function(){
    			passWords=$("#changePassword-passwords").val();
    			if((passWord!=passWords)||(passWords.length<6||passWords.length>18)){
    				alert("请确认两次密码输入相同且密码在6到18位之间！");
    				flagPass=false;
    			}else{
    				flagPass=true;
    			}
    		})
    		
    	})
    </script>
	  
	  
  </body>
</html>



