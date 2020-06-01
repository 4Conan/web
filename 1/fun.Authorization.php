
<?php
	session_start();
	if (isset($_SESSION['user']) && !empty($_SESSION['user'])) 
	{
		$user = $_SESSION['user'];
		$leveStr = $_SESSION['leve'];
		$uploadPublic =  $leveStr / 1 % 10;
		$downPublic =  $leveStr / 10 % 10;
		$uploadPrivate =  $leveStr / 100 % 10;
		$downPrivate =  $leveStr / 1000 % 10;
	}

	function upDateUserInfo()
	{
		global $leveStr;
		global $uploadPublic;
		global $downPublic;
		global $uploadPrivate;
		global $downPrivate;
		$leveStr = $_SESSION['leve'];
		$uploadPublic =  $leveStr / 1 % 10;
		$downPublic =  $leveStr / 10 % 10;
		$uploadPrivate =  $leveStr / 100 % 10;
		$downPrivate =  $leveStr / 1000 % 10;
	}

	function canUploadPublic()
	{
		global $uploadPublic;
		return $uploadPublic;
	}
	function canDownPublic()
	{
		global $downPublic;
		return $downPublic;
	}
	function canUploadPrivate()
	{
		global $uploadPrivate;
		return $uploadPrivate;
	}
	function canDownPrivate()
	{
		global $downPrivate;
		return $downPrivate;
	}
?>
