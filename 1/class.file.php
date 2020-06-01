<?php
require_once("../php/sqli.php");
require_once("./fun.Authorization.php");

class file_class{
	var $root ; 	//路径
	var $handle ; 	//记录当前文件夹信息
	var $visibleArr; //记录可显示的文件
	var $maxPage;	//一共多少页
	var $onePage;   //设置一页多少个
	
	function __construct(){
		$this->root = dirname(__FILE__);
	}
	
	//设置一页多少个
	function setPage($onePage)
	{
		$this->onePage = $onePage;
	}

	//设置新路径
	function file_root($path,$root=false){
		if($path{0}!='//' && $path{0}!='\\')
			$path = '\\'.$path;
		if($root==false && isset($path)){
			$this->root .=  $path;
		}else{
			$this->root =  $root .$path;
		}
	}

	
	//设置新路径
	function file_read($path,$root=false){
		if(is_file($this->root =  $root .$path)){
			file_get_contents();
		}
	}

	//
	function updateDataFromDatabase($name)
	{
		global $con;
		$array = array();
		$dbStr = "SELECT u.uploadUser, u.realFileName   ,i.majorVersionNumber  ,i.minorVersionNumber ,i.revisionNumber ,
						 i.releaseNumber  ,s.platform			 ,u.isPublic		   ,u.uploadDate
					FROM upload_file_info 	AS u
					INNER JOIN software 	AS s
					INNER JOIN info_release AS i
					ON  u.uploadFileName='$name' 
					AND u.releaseID = i.releaseID 
					AND i.softwareID = s.softwareID;";
	
		$result = mysqli_query($con, $dbStr);
		if($result)
		{
			$row = mysqli_fetch_array($result);
			
			if( ($row['isPublic'] &&  canDownPublic())  || canDownPrivate() ) 
			{
				$uploadUser = $row['uploadUser'];
				$realFileName 	= 	$row['realFileName'];
				$releaseVersion	.=	$row['majorVersionNumber'].'.';
				$releaseVersion	.=	$row['minorVersionNumber'].'.';
				$releaseVersion	.=	$row['revisionNumber'].'.';
				$releaseVersion	.=	$row['releaseNumber'];

				$platform 		= 	$row['platform'];
				$isPublic       =   $row['isPublic'];
				$uploadDate 	= 	$row['uploadDate'];
			}
		}

		
		if(!empty($realFileName) && !empty($platform) && !empty($releaseVersion) && !empty($uploadDate))
		$array = array('uploadUser'=> $uploadUser,'name'=>$realFileName ,'platform'=>$platform,'releaseVersion'=>$releaseVersion,
					   'isPublic'=>$isPublic,'uploadDate'=>$uploadDate);

		return $array;
	}
	
	//遍历当前目录
	function file_list()
	{
		if(is_dir($this->root))
		{
			if($dh = opendir($this->root)) 
			{
				$this->handle = array();
				$i = 0;
				while (($file = readdir($dh)) !== false) 
				{
					if($file!='.' && $file!='..')
					{

						if($this->file_type($file) == 'dir')
						{
							if('私密' == $file && !canDownPrivate() )
							{
								
							}
							else
							{
								$array = array('name'=>$file);
								array_unshift($this->handle,$array);//头部插入
							}
						}
						else
						{
							$array = $this->updateDataFromDatabase($file);
							if(count($array)>0)
								array_push($this->handle,$array);//尾部插入
						}
						
							
					}
				}

				//计算最大页数
				$count = count($this->handle);
				if(empty($onePage)) $onePage = 10;
				
				$ee = intval($count/$onePage);
				if($ee < 1)
					$ee = 1;
				$this->maxPage =  $ee;
				
				//关闭
				closedir($dh);
				print_r($this->handle);
			}
		}
		
	}


	//返回当前文件的类型
	function file_type($file){
		return filetype($this->root.'/'.$file);
	}
	
	//可显示的总数
	function visibleCount()
	{	
		return count($this -> handle);
	}
}

















