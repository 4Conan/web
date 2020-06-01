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
</head>

	
<body>

	<div class="main">	
		<?php include 'top.php' ?>
		<div class="info">
			 <a href="userChangePassword.php" class="btn  btn-primary">修改密码</a>
			 <?php 
					session_start();
					if($_SESSION['user'] == 'admin')
					{?>
			 			<a href="userAuthorization.php" class="btn  btn-primary">修改权限</a>
			 <?php  }?>
		</div>
	</div>
</body>
</html>