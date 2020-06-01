
<?php
	require("php/session.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">  <!--规定 HTML 文档的字符编码-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--将IE8使用edge进行渲染-->
    <title>科凌峰远程管理系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--方便移动端显示正常-->
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/4.2.1/css/bootstrap.min.css"><!--包含bootstrap的css样式-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet"><!--自己的样式-->
   
	  
	  <script type="text/javascript">
			"use strict";
			function downClick()
			{
				alert("downClick");
				var file = document.getElementById("fileID").value;
				var s =  document.createElement("script");
				s.src = "php/download_file.php?file=" + '(31).jpg';
				document.body.appendChild(s);
				
			}
		 
			function callbackFunc(data)
			{
				
			}
	</script>
	  

	 <style type="text/css">
		 
		 ul{
			list-style: none;
		   background-color:#737373;
			 
		 }
		 ul.imglist{
			 margin:0 0 auto;
			 width: 380px;
			 overflow:hidden;
		 }
		 ul.imglist li {
			 float:left;
			 padding: 8px 8px;
			 width: 70px;
		 }
		 ul.imglist li a {
			 color: black;
		 }
		 ul.imglist li img{
			 display: block;
			 width: 100%;
			 height: 100%;
		 }
		 ul.imglist li span{
			 font-size:3px;
			 display: block;
			 width: 100%;
			 height: 30%;
			 line-height: 30px;
		 }
		 .div_list {
			 width: 100%;
			 height: 140px;
			 overflow:hidden;
			 background-color:white;
		 }
		 
		 h3
		 {
			 background-color:#737373;
		 }
/*		 
		 .backDiv {
			 width: 100%;
			 height: 600px;
			 background-color:#FF0004;
		 }

		  .upload {
			 float:left;
			 width: 100%;
			 height: 100px;
			 background-color:aqua;
		 }
		 
		 .download {
			 float:left;
			 width: 100%;
			 height: 100px;
			 background-color:#1800EF;
			 
		 }
		 
		 .file {
			 width: 100%;
			 height: 400px;
			 background-color:#00EBEF;
			 
		 }
		 	
*/
		
    </style>

	  

  </head>
  <body>

		<div class = "upload">
			<form action="php/upload_file.php" method="post" enctype="multipart/form-data">
				
			<label for="releaseID">releaseID: </label>
			<input type="text" name="releaseID" id="releaseID">
			<br />
			<label for="file">Filename: </label>
			<input type="file" name="file" id="file" /> 
			<br />
		    <input type="checkbox" id="isPublic" name="isPublic" >
    		<label for="isPublic">公开</label>
			<br />
			<input type="submit" name="submit" value="上传" />
			</form>
		</div>
	  
		<div class = "download">  
			<form action="php/download_file.php" method="get">
			releaseID: <input type="text" name="releaseID">
			<br />
			fileName: <input type="text" name="fileName">
			<br />
			<input type="submit" value="下载">
			</form>
		</div>


	  <div class = "file">
		  
	   <div class = "div_list">
		   <h3>文件夹</h3>
	  	<div>
			<ul class="imglist">
				<li>
					<a href="#">
						<img src="img/files.jpg" alt="找不到图片" class="img-thumbnail">
						<span>公有</span>
					</a>
				</li>
				
				<li>
					<a href="#">
						<img src="img/files.jpg" alt="找不到图片" class="img-thumbnail">
						<span>私有</span>
					</a>
				</li>
				
				<li>
					<a href="#">
						<img src="img/files.jpg" alt="找不到图片" class="img-thumbnail">
						<span>其他</span>
					</a>
				</li>
				
				<li>
					<a href="#">
						<img src="img/files.jpg" alt="找不到图片" class="img-thumbnail">
						<span>其他</span>
					</a>
				</li>
				
			</ul>
		</div>

	</div>
</div>
</body>
	
</html>	  

