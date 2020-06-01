<?
error_reporting(7);
ob_start();
$mydata="mydata";//数据目录
if (file_exists("$mydata/config.php"))	
{
$new_info=explode("|",readfrom("$mydata/config.php"));
}
$userd="usedd/";//用户文件夹
$xtm=$new_info[1];//系统名称
$file="file/";//上传文件存放目录
$jl="record/";//系统日志文件夹
$mail="mailbox/";//用户信箱文件夹
$mailn=$new_info[4];//用户信息容量
$ip=$new_info[5];
$zt=$new_info[9];
$uptypes=array('image/jpg', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/gif', 'image/bmp', 'image/x-png', 'application/octet-stream', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint');//允许上传的文件类型，根据需要自行修改
$max_file_size=20000000000;   //上传文件大小限制, 单位BYTE

?>