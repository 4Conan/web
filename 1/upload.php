<?php
	require("../php/session.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
<title>无标题文档</title>
	<script>
		function selectOnChange(value)
		{
			alert(value);
		}
	</script>
</head>

	
<body>

	<div class="main">
		<?php include 'top.php' ?>
		<div class="info">
			<form action="../php/upload_file.php" method="post" enctype="multipart/form-data">
				
			<label for="releaseID">当前软件发布版本: </label>
			<select  name="releaseID" id="releaseID"></select>
			<!--<input type="text" name="releaseID" id="releaseID">-->
			<br />
			<label for="dir">保存到那个目录:</label>
			<input type="text" name="dir" id="dir">	
			<br />
			<label for="file">当前文件: </label>
			<input type="file" name="file" id="file" /> 
			<br />
		    <input type="checkbox" id="isPublic" name="isPublic" >
    		<label for="isPublic">公开</label>
			<br />
			<input type="submit" name="submit" value="上传" />
			</form>
	  
		</div>
	</div>

<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
			

		$(function()
		  { 
			var obj = {"mode":"show"};
			sendToServer(obj);
		  });
		function callbackShow(data)
		{
			for (var i = data.length-1;i >= 0; i--) 
			{
				$('#releaseID').prepend("<option value='"+data[i].id+"'>"+data[i].release+"</option>");//添加option到第一
			}
		}
		function sendToServer(obj)
		{
			var s =  document.createElement("script");
			s.src = "../php/upload_file.php?jsonStr=" + JSON.stringify(obj);
			document.body.appendChild(s);
		}
		function callbackDebug(info)
		{
			alert(info);	
		}
</script>	
</body>
</html>