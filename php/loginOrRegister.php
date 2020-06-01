<?php

require_once("sqli.php");



define("HERF_NOT",0);
define("HERF_HOME",1);
define("HERF_LOGIN",2);



class ReturnData 
{
	public $isSuccess= "";
	public $username = "";
	public $info  = "";
	public $href = "";
	
}

header("Content-Type: application/json; charset=UTF-8");
$obj =  json_decode($_GET["jsonStr"], false);
$mode = check_input($obj->mode);
$username = check_input($obj->username);
$password = check_input($obj->password);
$oldPassword = check_input($obj->oldPassword);

$href = HERF_NOT;
$retInfo = "";
$isSuccess = false;


function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function login()
{
	//
	global $con;
	global $href;
	global $retInfo;
	global $username;
	global $password;
	global $isSuccess;
	
		
	$retInfo = "Login failed, please check your username and password!!!!";
	$dbStr = "SELECT * from user_info WHERE username='$username';";
	$isSuccess = false;
	$result = mysqli_query($con, $dbStr);
	
	if($result)
	{
		$row = mysqli_fetch_array($result);
		if($row['password'] == $password)
		{
			session_start();
			$retInfo = "login success! jumping to the  homepage.";
			$isSuccess = true;
			$href = HERF_HOME;
			
			$_SESSION['user'] = $username;
			$_SESSION['leve'] = $row['leveStr'];
			
		}
	}
	
}

function register()
{
	global $href;
	global $retInfo;
	global $dbTable;
	global $username;
	global $password;
	global $isSuccess;

	$retInfo = "register error!";
	$dbStr = "INSERT INTO user_info(username, password) VALUES ('$username','$password');";
	
	
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	if($result)
	{
		$retInfo = "register success! jumping to the login page.";
		$isSuccess = true;
		$href = HERF_LOGIN;
	}
}
function changePassword()
{
	global $username;
	global $password;
	global $oldPassword;
	global $isSuccess;
	global $href;
	global $retInfo;
	
	session_start();
	$username = $_SESSION['user'];
	$newPsswoed = $password;
	
	$dbStr = "UPDATE user_info SET password = '$newPsswoed' WHERE username = '$username' and password = '$oldPassword';";
	
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	
	if($result)
	{
		if(mysqli_affected_rows($GLOBALS['con']) == 1)
		{
			$retInfo = "Password changed successfully, please log in again.";
			$isSuccess = true;
			$href = HERF_LOGIN;
			session_destroy();
		}
		else
			exitPHP('Failed to modify: please check whether the old password is correct!');
	}
	else 
		exitPHP('Failed to modify: failed to read the database.');
}

//start
if( strlen($username) > 0 && strlen($password) > 0)
{
	$mode = $mode;
	if($mode == "login")
	{
		login();
	}
	else if($mode == "register") 
	{
		register();
	}
}
else if($mode == "changePassword") 
{
	changePassword();
}
else 
{
	$retInfo = "Login failed, username or password cannot be empty!";
}


$e = new ReturnData();
$e->isSuccess = $isSuccess;
$e->username = $username;
$e->info = $retInfo;
$e->href = $href;


function exitPHP($info)
{
	global $con;	
	ob_clean();//清除之前的缓存
	echo "callbackDebug(\"$info\");";
	mysqli_close($con);
	exit();
}


mysqli_close($GLOBALS['con']);
echo "callbackHref(".json_encode($e).");";





?>