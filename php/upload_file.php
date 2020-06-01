<?php 

require_once("sqli.php");

header("content-type:text/html;charset=utf-8");

date_default_timezone_set('PRC');  //设置时区

session_start();
$user = null;
$user = $_SESSION['user'];
if (is_null($user))
{	
	echo "<script>alert('请先登录！！');</script>";
	echo "<script>window.location.href='../login.html';</script>";
	exitPHP();
}

//show
if(is_array($_GET)&&count($_GET)>0)	//判断是否有Get参数 
{
	
	$obj 			=  json_decode($_GET["jsonStr"], false);
	$mode 			=  check_input($obj->mode);

	if($mode == "show")
	{
		global $con;
		$releaseArr=array();
		$dbStr = "select * from info_release;";
		$result = mysqli_query($con, $dbStr);

		if(!$result)
		{
			exitPHP("错误描述:" . mysqli_error($con));
		}

		while($row = mysqli_fetch_array($result))
		{
			$releaseVersion = null;
			$releaseVersion	.=	$row['majorVersionNumber'].'.';
			$releaseVersion	.=	$row['minorVersionNumber'].'.';
			$releaseVersion	.=	$row['revisionNumber'].'.';
			$releaseVersion	.=	$row['releaseNumber'];

			$arr =array('id'=>$row['releaseID'],'release'=>$releaseVersion);
			array_push($releaseArr,$arr);
		}
		if(count($releaseArr)>1)
			echo "callbackShow(".json_encode($releaseArr).");"; 
	}
	exitPHP();
}
else if(is_array($_POST)&&count($_POST)>0)
{
	print_r($_POST);
 	$releaseID		= $_POST['releaseID']; //获取release ID
	$isPublic 		= $_POST['isPublic']; //获取isPublic
	$description 	= $_POST['description']; //获取description
	$isPublished 	= $_POST['isPublished']; //获取isPublished

	$intIsPublic 		= ($isPublic)? 1:0;
	$dir = ($isPublished)? '../1/公开':'../1/私密';

    // 循环取出上传文件
    foreach ($_FILES["uploads"]["error"] as $key => $error)
	{
        
        // 判断每一个文件是否成功上传
        if($error == UPLOAD_ERR_OK)
		{
			$former_name 	= $_FILES["uploads"]["name"][$key];			 		 // 获取原文件名
			$ext_suffix 	= substr($former_name,strrpos($former_name,'.'));	 // 截取原文件名后缀
            $temp_name 		= $_FILES["uploads"]["tmp_name"][$key]; 			 // 获取临时文件名      
    
			saveFile($temp_name,$former_name,$ext_suffix,$dir,$intIsPublic,$releaseID);
        }
		  
	}
	echo "<script>window.history.back(-1);</script>";
	
	

	
 
}

function saveFile($temp_name,$prename,$ext_suffix,$dir,$intIsPublic,$releaseID)
{
	global $releaseID;
	global $user;

	$allow_suffix = array('.img','.plg','.txt');//设置允许上传文件的后缀
		
	if(!in_array($ext_suffix, $allow_suffix))//判断上传的文件是否在允许的范围内（后缀）==>白名单判断
	{
		//window.history.go(-1)表示返回上一页并刷新页面
		echo "<script>alert('上传的文件类型只能是img,plg,txt');window.history.go(-1);</script>";
		exitPHP();
	}

	if (!file_exists($dir))
	{
		echo "<script>alert('文件目录不存在：$dir');window.history.go(-1);</script>";
		exitPHP();
		//mkdir($dir);
	}
	//为上传的文件新起一个名字
	$new_filename = date('YmdHis',time()) . rand(100,1000) . $ext_suffix;
	$temp_dir =  $dir.'/'.$new_filename;
	
	//保证磁盘没有重复文件
	while(file_exists($temp_dir))
	{
		$new_filename = date('YmdHis',time()) . rand(100,1000) . $ext_suffix;
		$temp_dir = $dir.'/'.$new_filename;
	}
	
	//将文件从临时路径移动到磁盘
	if (move_uploaded_file($temp_name, $temp_dir))
	{
		
		$dbStr = 'insert into upload_file_info(isPublic,releaseID,uploadUser,realFileName,category,dir,uploadFileName)';
		$dbStr .= "values($intIsPublic,$releaseID,'$user','$prename','$ext_suffix','$dir','$new_filename');";
		if(mysqli_query($GLOBALS['con'], $dbStr))
		{
			echo "<script>alert('$prename 上传成功！');</script>";
		}
		else
		{
			$err = mysqli_error($GLOBALS['con']);
			echo "<script>alert('数据库操作出错！$err');</script>";
			echo $err;
			exitPHP();
		}

	}
	else
	{
		echo "<script>alert('文件上传失败,错误码：$error');</script>";
	}

}


function exitPHP($info = '',$url = '')
{
	global $con;	
	ob_clean();//清除之前的缓存
	
//	if(!empty($url))
//		echo "<script>callbackGoUrl(\"$info\",\"$url\");</script>";
//	else if(!empty($info))
//		echo "callbackDebug(\"$info\");";
	
	mysqli_close($con);
	exit();
}

function check_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}



?>