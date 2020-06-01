<?php
require_once("../php/sqli.php");

$obj 			=  json_decode($_GET["jsonStr"], false);
$mode 			= check_input($obj->mode);
$isPublished	= check_input($obj->isPublished);

function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if($mode == "show")
{
	global $con;
	$VerArr=array();
	
	session_start();
	$uploadUser = $_SESSION['user'];
	
	if(empty($uploadUser))
		exitPHP('请先登录','../login.html');
	
	$dbStr = "SELECT i.releaseID, s.platform  ,i.majorVersionNumber  ,i.minorVersionNumber ,i.revisionNumber 
					 ,i.releaseNumber, i.description,i.isPublished, i.uploadDate
						from info_release as i
						INNER JOIN software 	AS s
						ON i.uploadUser = '$uploadUser'
						AND i.isPublished = '$isPublished'
						AND i.softwareID = s.softwareID;";
	$result = mysqli_query($con, $dbStr);

	if(!$result)
	{
		exitPHP("错误描述:" . mysqli_error($con));
	}
	
	while($row = mysqli_fetch_array($result))
	{
		
		$releaseVersion	 =	$row['majorVersionNumber'].'.';
		$releaseVersion	.=	$row['minorVersionNumber'].'.';
		$releaseVersion	.=	$row['revisionNumber'].'.';
		$releaseVersion	.=	$row['releaseNumber'];

		$arr =array('releaseID'=>$row['releaseID'],'releaseVersion'=>$releaseVersion,'platform'=>$row['platform'],
					'isPublished'=>$row['isPublished'],'uploadDate'=>$row['uploadDate']);
		array_push($VerArr,$arr);
	}
	echo "callbackShow(".json_encode($VerArr).");"; 
}


function exitPHP($info,$url = '')
{
	global $con;	
	ob_clean();//清除之前的缓存
	
	if(!empty($url))
		echo "callbackGoUrl(\"$info\",\"$url\");";
	else
		echo "callbackDebug(\"$info\");";
	mysqli_close($con);
	exit();
}
?>
