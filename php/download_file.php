
<?php 

require_once("sqli.php");

header("Content-Type:text/html;charset=utf-8");

$realFileName =$_GET["fileName"];     //下载文件名    
$releaseID =$_GET["releaseID"];     //下载releaseID    
$file_name = null;
$file_dir = null;        //下载文件存放目录  
$fileID = null;


session_start();
$user = null;
$leve = null;
$user = $_SESSION['user'];
if (is_null($user))
{	
	echo "<script>alert('请先登录！！');</script>";
	echo "<script>window.location.href='../login.html';</script>";
	exitPHP();
}


function insertSql()
{
	global $fileID;
	global $releaseID;
	global $user;
	
	if (!is_null($user))
	{
		$dbStr = "insert into download_history(downloadUser, releaseID,downFileID) values('$user',$releaseID,$fileID);";
		if(mysqli_query($GLOBALS['con'], $dbStr))
		{
			return true;
		}
	}
	return false;
}

function getServerName($name)
{
	global $file_name;
	global $file_dir;
	global $fileID;
	global $releaseID;
	$dbStr = "SELECT * from upload_file_info WHERE realFileName='$name' and  releaseID = $releaseID;";
	
	
	
	$result = mysqli_query($GLOBALS['con'], $dbStr);
	
	
	if($result)
	{
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$file_dir 	= $row['dir'] . '/';
		$file_name	= $row['uploadFileName'];
 		$fileID		= $row['fileID'];
	 	$releaseID	= $row['releaseID'];
		
		
		// 释放结果集
		mysqli_free_result($result);
		
		echo "<script >alert('显示： ".'dir:'.$file_dir.'name:'.$file_name." 啊');</script>";
		
		if(!is_null($file_name))
			return true;
	}
	return false;
}

function down()
{
	global $file_name;
	global $file_dir;
	global $realFileName;
	
	if(!getServerName($realFileName))
	{
		echo "<script >alert('没有找到文件，请确保文件名正确！！！');</script>";
		exitPHP();
	}
	
	//检查服务器文件是否存在    
	if (! file_exists ( $file_dir . $file_name ) || is_null($file_name))
	{    
		echo "<script >alert('服务器没有找到".'dir:'.$file_dir.'name:'.$file_name."，请确保文件名正确！！！');</script>";
		
		header('HTTP/1.1 404 NOT FOUND');  
	}
	else if(insertSql())
	{    
		//清除之前的缓存
		ob_clean();
		//以只读和二进制模式打开文件   
		$file = fopen ( $file_dir . $file_name, "rb" ); 

		//告诉浏览器这是一个文件流格式的文件    
		Header ( "Content-type: application/octet-stream" ); 
		//请求范围的度量单位  
		Header ( "Accept-Ranges: bytes" );  
		//Content-Length是指定包含于请求或响应中数据的字节长度    
		Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
		//用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
		Header ( "Content-Disposition: attachment; filename=" . $realFileName );    

		//读取文件内容并直接输出到浏览器    
		echo fread ( $file, filesize ( $file_dir . $file_name ) );    
		fclose ( $file ); 
	}
	else
	{
		echo("insert sql  error!!!!");
	}
	exitPHP();    
}


function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


//start
if( strlen($realFileName) > 0)
{
	down();
}
else 
{
	echo "<script>alert('File Name cannot be empty！');</script>";
	exitPHP();
}


function exitPHP()
{
	mysqli_close($GLOBALS['con']);
	
	exit(); 
}



?>