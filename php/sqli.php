<?php
$con = mysqli_connect("localhost:3306", "clefine", "cnf8858");
if (!$con)
{
	die ('Could not connect: ' . mysql_error());
}
mysqli_select_db($con, "clefinedatabase");
mysqli_query($con, "set names 'utf8'");

//define("DB_SERVER","localhost:3306");
//define("DB_USERNAME","clefine");
//define("DB_PASSWORD","cnf8858");
//define("DB_NAME","clefineData");
//
//
//
//function sqli($dbStr)
//{
//	$mysqli = new Mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
//
//	if($mysqli->connect_error)
//		die('connect error:'.$mysqli->connect_errno);
//
//	$mysqli->set_charset('UTF8'); 
//
//	if($result = $mysqli->query($dbStr))
//	{
//		$retInfo = $result;
//	}
//	else
//	{
//		$retInfo = "register error: " . $mysqli->error;
//	}
//	
//
//	$mysqli->close()or die("close mysqli error!!");
//	
//	return $retInfo;
//}

?>