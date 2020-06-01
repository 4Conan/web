<?php


require_once("../php/sqli.php");



$obj 			=  json_decode($_GET["jsonStr"], false);
$id 			= check_input($obj->id);
$platform 		= check_input($obj->platform);
$softwareID 	= check_input($obj->softwareID);
$release 		= check_input($obj->release);
$description 	= check_input($obj->description);
$isPublished	= check_input($obj->isPublished);
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
	$softwareArr=array();
	$dbStr = "select * from software;";
	$result = mysqli_query($con, $dbStr);

	if(!$result)
	{
		exitPHP("错误描述:" . mysqli_error($con));
	}
	
	while($row = mysqli_fetch_array($result))
	{

		$arr =array('id'=>$row['softwareID'],'platform'=>$row['platform']);
		array_push($softwareArr,$arr);
	}
	echo "callbackShow(".json_encode($softwareArr).");"; 
}
else if($mode == "addRelease")
{
	
	if(!empty($softwareID) && !empty($release))
	{
			
		$arr = explode('.',$release);
		if(count($arr) < 4)
		{
			exitPHP("请检查版本号填写");
		}
		
		session_start();
		if (!isset($_SESSION['user'])) 
		{
			exitPHP("请先登录！");
		}
		$user =  $_SESSION['user'];
			
		$dbStr = "INSERT INTO info_release(uploadUser,softwareID,majorVersionNumber,minorVersionNumber,
										  revisionNumber,releaseNumber,description)
 				VALUES ('$user','$softwareID','$arr[0]','$arr[1]','$arr[2]','$arr[3]','$description');";
		
		$result = mysqli_query($GLOBALS['con'], $dbStr);
		if($result)
			exitPHP("添加成功！");
		else
			exitPHP("错误描述:" . mysqli_error($con));
	}
	else
	{
		exitPHP("软件平台或者版本号不能为空");
	}

}
else if($mode == "addPlatform")
{
	if(!empty($id) && !empty($platform))
	{
		$dbStr = "INSERT INTO software(softwareID, platform) VALUES ('$id','$platform');";
		$result = mysqli_query($GLOBALS['con'], $dbStr);
		
		if($result)
			echo "callbackPlatform($result);";
		else
			exitPHP("错误描述:" . mysqli_error($con));
		
	}
}
else if($mode == "checkRelease")
{
	$retInfo = array('status'=>0);
	if(!empty($softwareID) && !empty($release))
	{
		$arr = explode('.',$release);
		if(count($arr) < 4)
		{
			exitPHP("请检查版本号填写");
		}
		$dbStr = "SELECT *from info_release 
					where  softwareID = '$softwareID'
					AND majorVersionNumber = '$arr[0]'
					AND minorVersionNumber = '$arr[1]'
					AND revisionNumber = '$arr[2]'
					AND releaseNumber = '$arr[3]';";
		
		$result = mysqli_query($GLOBALS['con'], $dbStr);
		if($result)
		{
			if(mysqli_affected_rows($GLOBALS['con'])>0)
			{
				$retInfo = array('status'=>0,'info'=>'repeat');
			}
			else
			{
				$retInfo = array('status'=>1,'info'=>'ok');
			}
		}
		else
			$retInfo = array('status'=>-1,'info'=>"错误描述:" . mysqli_error($con));
		
		
		echo "callbackCheck(".json_encode($retInfo).");"; 
	}
}
else
{
	


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

mysqli_close($con);
?>