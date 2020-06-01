<?php
	require_once("../php/session.php");
	require_once("../php/sqli.php")
?>

<?php
$platform		   =$_GET['platform'];
$releaseVersion    =$_GET['releaseVersion'];
$verArr = explode(".",$releaseVersion);
print_r($verArr);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
<title>下载界面</title>
</head>

	
<body>
	<div class="main">	
		<?php include 'top.php' ?>
		<div class="info">
			<?php 

				if(count($verArr)<4)
					exit();
				
		
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
					$downArr = array();
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
				else
				{
					exit();
				}
					
			?>
			<table class="table table-hover" id="tableInfo">
				<p><Strong>平台：</Strong><?php echo $platform ?></p>
				<p><Strong>版本：</Strong><?php echo $releaseVersion ?></p>
				<p><Strong>描叙：</Strong></p>
				<textarea id="description" rows="10" cols="30"  placeholder="该版本暂时没有描叙" readonly="readonly"><?php echo $description ?></textarea>
				
				</br></br></br>
				<p><Strong>下载：</Strong></p>
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
			</table>

</body>
</html>