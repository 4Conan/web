 <?php
	require_once("../php/session.php");
	require_once("../php/sqli.php")
?>

<?php
$platform		   =$_GET['platform'];
$releaseVersion    =$_GET['releaseVersion'];
$isPublished    =$_GET['isPublished'];
$verArr = explode(".",$releaseVersion);
$downArr = array();

if(count($verArr)<4)
{
	exit();
}
$dbStr = "SELECT i.releaseID,u.realFileName, s.platform  ,u.isPublic ,u.uploadDate, i.description
			FROM upload_file_info 	AS u
			INNER JOIN software 	AS s
			INNER JOIN info_release AS i
				ON  s.platform = '$platform'
				AND i.majorVersionNumber = '$verArr[0]'
				AND i.minorVersionNumber = '$verArr[1]'
				AND i.revisionNumber = '$verArr[2]'
				AND i.releaseNumber = '$verArr[3]'   
				AND u.releaseID = i.releaseID 
				AND i.softwareID = s.softwareID;";
$result = mysqli_query($GLOBALS['con'], $dbStr);
if($result)
{
	while($row = mysqli_fetch_array($result))
	{
		$description = $row['description'];
		$platform = $row['platform'];
		$releaseID = $row['releaseID'];
		$realFileName = $row['realFileName'];
		$array = array('releaseID'=>$releaseID,'realFileName'=>$realFileName);
		array_push($downArr,$array);//尾部插入
	}
}
if(count($downArr)<1)
{
	$dbStr = "SELECT i.releaseID,i.description 
				FROM info_release AS i 
				INNER JOIN software AS s 
				ON  s.platform = '$platform'
				AND i.majorVersionNumber = '$verArr[0]'
				AND i.minorVersionNumber = '$verArr[1]'
				AND i.revisionNumber = '$verArr[2]'
				AND i.releaseNumber = '$verArr[3]'   
				AND i.softwareID = s.softwareID;";
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	if($result)
	{
		$row = mysqli_fetch_array($result);
		$description = $row['description'];
		$releaseID = $row['releaseID'];
	}
	
	echo $dbStr;

}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
<title>发表界面</title>
</head>

	
<body>
	<div class="main">	
		<?php include 'top.php' ?>
		<div class="info">
			<form action="../php/upload_file.php" method="post" enctype="multipart/form-data" id="formInfo">
					<Strong>平台：</Strong> <input type="text" name="platform" readonly value="<?php echo $platform ?>"/><br/>
  					<Strong>版本：</Strong> <input type="text" name="releaseVersion" readonly value="<?php echo $releaseVersion ?>"/><br/>
				
					<input type="text" id="releaseID" name="releaseID"  style="display:none;" readonly value="<?php echo $releaseID ?>"/>
				
					<Strong>描叙：</Strong><br/>
					<textarea id="description" name="description" rows="10" cols="30" 
							  <?php echo ($isPublished)? 'readonly':'';?> placeholder="该版本暂时没有描叙"><?php echo $description ?></textarea>
				
					<br/><br/><br/>
					
					<?php 
						if(!$isPublished)
						{
					?>
							<input type="file" 	id="uploads" name='uploads[]'   multiple="multiple" style="display:none;"> </input> 
							<input type="button" id="btn_select" value="选择文件"></input> 

							<input type="checkbox" id="isPublic" name="isPublic"></input> 
							<label for="isPublic">当前上传文件全部为公开权限</label><br/>   
							<p id="waitFile"></p>
					<?php } ?>
					<br /><br />

					<p><Strong>已上传文件：</Strong></p>
					<?php
						foreach($downArr as $arr)
						{
							$realFileName = $arr['realFileName'];
							$releaseID = $arr['releaseID'];

					?>
							<p>
							<a href="../php/download_file.php?releaseID=<?php echo $releaseID ?>&fileName=<?php echo $realFileName ?>">
							<?php echo $realFileName ?>
							</a></p>
				   <?php } ?>
				
				<input type="checkbox" id="isPublished" name="isPublished" style="display:none;" />
				
					
		</form>

		<?php 
			if(!$isPublished)
			{
		?>
			<button id="save">保存</button>
			<button id="savePublish">保存并发布</button>
		<?php
			}else{	
		?>
			<button id="back">返回</button>
		<?php } ?>
	
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_select").click(function(){
		$("#uploads").trigger("click");
		});
	});
		
		
	$('#uploads').change(function()
	{
		var file = document.getElementById('uploads').files;
		var waitFiles='';
		for(i=0;i<file.length;i++)
		{  
			//if(waitFiles.indexOf(file[i].name) != -1)
			{
				waitFiles+=file[i].name;
				waitFiles+="&nbsp;&nbsp;&nbsp;&nbsp;";
				$('#waitFile').html(waitFiles);
			}
		} 

	});

	$("#save").click(function()
	{
    	$("#formInfo").submit();
  	}); 
	
	$("#savePublish").click(function()
	{
    	$("#formInfo").submit();
		//UpladFile();
  	}); 
	$("#back").click(function()
	{
    	window.history.back(-1);
  	}); 
</script>
	

</body>
</html>