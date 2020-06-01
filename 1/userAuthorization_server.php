<?php
require_once("../php/sqli.php");
require_once("./fun.Authorization.php");

$obj 			=  json_decode($_GET["jsonStr"], false);
$username 		= check_input($obj->username);
$leveStr 		= check_input($obj->leveStr);
$mode 			= check_input($obj->mode);

function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


if('ModifyPermissions' == $mode)
{
	
	$dbStr = "UPDATE user_info SET leveStr = '$leveStr ' WHERE username = '$username'";
	
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	
	if($result)
	{
		if(mysqli_affected_rows($GLOBALS['con']) == 1)
		{
			$_SESSION['leve'] = $leveStr;
			upDateUserInfo();
			exitPHP('Updated permissions!','./userAuthorization.php');	
		}
		else
			exitPHP('Failed to modify: please check whether the username is correct!'.$dbStr);
	}
	else 
		exitPHP('Failed to modify: failed to read the database.');
}
else if('show' == $mode)
{
	$dbStr = "SELECT * from user_info;";
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	$userArr = array();
	if($result)
	{
		while($row = mysqli_fetch_array($result))
		{
			$arr =array('username'=>$row['username'],
						'leveStr'=>$row['leveStr'],'registeredDate'=>$row['registeredDate']);
			array_push($userArr,$arr);
		}
		
		echo "callbackShow(".json_encode($userArr).");"; 
	}
	
	exit();
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