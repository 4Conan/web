<?php

require_once("../php/sqli.php");

$obj 			=  json_decode($_GET["jsonStr"], false);
$mode 			= check_input($obj->mode);

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
	$dbStr = "SELECT  i.majorVersionNumber  ,i.minorVersionNumber ,i.revisionNumber 
					 ,i.releaseNumber, s.platform , i.uploadUser , i.uploadDate
					FROM  software 	AS s
					INNER JOIN info_release AS i
					ON  i.softwareID = s.softwareID
					AND i.isPublished = 1;";
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


		$arr =array('releaseVersion'=>$releaseVersion,'platform'=>$row['platform'],
					'uploadUser'=>$row['uploadUser'],'uploadDate'=>$row['uploadDate']);
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
