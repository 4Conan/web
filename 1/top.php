<?php
	require_once("./fun.Authorization.php");
?>
<?php

	if(isset($_GET['logOut']))
	{
		session_destroy();
		echo "<script>alert('跳转到登录界面');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	}
?>

<div class="navigation">
	<nav class="navbar navbar-default" role="navigation">
	   <div class="navbar-header">
		  <a class="navbar-brand" href="#">clefine</a>
	   </div>
	   <div>
		  <!--向左对齐-->
<!--
		<form class="navbar-form navbar-left" role="search">
			 <div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			 </div>
			 <button type="submit" class="btn btn-default">搜索</button>
     	 </form>    
-->
			
<!--		  向右对齐-->
		  <ul class="nav nav-pills pull-right">
			 <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				   <?php 
						session_start();
						echo  $_SESSION['user'];
					?> 
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu pull-right">
				   <li><a href="?logOut=1">退出账号</a></li>
				</ul>
			 </li>
		  </ul>

	   </div>
  </nav>
</div>



<div class="navLeft">
	<ul class="nav nav-pills nav-stacked">
	   <li><a href="set.php" >设置</a></li>
	   <li><a href="downloadPage.php" >下载</a></li>
	   <?php 
			if(canUploadPublic() || canUploadPrivate() )
			{?>
			   <li><a href="publishPage.php" >已发布</a></li>
			   <li><a href="pendingPage.php" >待发布</a></li>
	  <?php }?>
	</ul>
</div>