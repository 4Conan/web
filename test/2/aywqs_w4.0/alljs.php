<?
error_reporting(7);
ob_start();
$mydata="mydata";//����Ŀ¼
if (file_exists("$mydata/config.php"))	
{
$new_info=explode("|",readfrom("$mydata/config.php"));
}
$userd="usedd/";//�û��ļ���
$xtm=$new_info[1];//ϵͳ����
$file="file/";//�ϴ��ļ����Ŀ¼
$jl="record/";//ϵͳ��־�ļ���
$mail="mailbox/";//�û������ļ���
$mailn=$new_info[4];//�û���Ϣ����
$ip=$new_info[5];
$zt=$new_info[9];
$uptypes=array('image/jpg', 'image/jpeg', 'image/png', 'image/pjpeg', 'image/gif', 'image/bmp', 'image/x-png', 'application/octet-stream', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint');//�����ϴ����ļ����ͣ�������Ҫ�����޸�
$max_file_size=20000000000;   //�ϴ��ļ���С����, ��λBYTE

?>