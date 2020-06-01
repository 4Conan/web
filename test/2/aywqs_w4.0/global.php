<?php
include("alljs.php");
if($_POST['act'] == "pass"){
$password=$_POST['password'];
$username=$_POST['username'];
}
echo"<title>$xtm</title>";
$leasin=$_GET['leasin'];
$timestamp=time();
if (isset($password)) $password=md5($password);
if (empty($username)) $username=$_COOKIE['a10145sadnjghgmxcxtqqe2asdfmgdfsdaf23bc'];
if (empty($password)) $password=$_COOKIE['d1423asf1sd1df1hjk1bvbl1uyuiuym1ef'];
if(!checkpass($username,$password)) {
adminlogin();
exit;
admintitle();
} 
$checkpower=checkpower($username,$password);
setcookie("a10145sadnjghgmxcxtqqe2asdfmgdfsdaf23bc",$username); 
setcookie("d1423asf1sd1df1hjk1bvbl1uyuiuym1ef",$password);
if ($leasin=="logout") {
setcookie ("a10145sadnjghgmxcxtqqe2asdfmgdfsdaf23bc","");
setcookie ("d1423asf1sd1df1hjk1bvbl1uyuiuym1ef","");
echo"<script>alert(\"退出成功！\");</script>";   
echo"<meta http-equiv=refresh content=0;url=index.php>"; 
}
admintitle();
//-----------------functions-------------------------
function checkpass($username,$password){
	global $checkpower;
	   if (!$username) return 0;
	   if (!$password) return 0;
include("alljs.php");
	if (!file_exists("$userd$username.php") || strpos($username,"..")!==false) return 0;
	$useri=explode("|",readfrom("$userd$username.php"));
$userpwd=$useri[2];$usdw=$useri[5];$user=$useri[1];
	if ($password==$userpwd) return 1; else return 0;
	   $checkpower=$useri[3];
}
function checkpower($username,$password){
	   if (!$username) return 0;
	   if (!$password) return 0;
include("alljs.php");
	if (!file_exists("$userd$username.php") || strpos($username,"..")!==false) return 0;
	$useri=explode("|",readfrom("$userd$username.php"));	
	$usdw=$useri[5];

	 if ($password==$useri[2])  return $useri[3]; else return 0; 
	 }
function adminlogin() {
global $thisprog;
?>
 <body><LINK href="images/cs.css" rel=stylesheet>
<table cellspacing=1 cellpadding=1 width=500 align=center bgcolor="#cccccc" border=0>
  <tbody>
    <tr bgcolor="#ffffff">
      <td height="280"><table width=500 height="129" border=0 align=center cellpadding=0 cellspacing=0>
        <tbody>
          <tr>
            <td background="images/login.gif"><table width="100%" height="113" border="0">
                <tr>
                  <td width="60%" height="32"><a href="http://www.21573.com" target="_blank"><div align="center"><font color="#CC0000" size="+2">
                    <? include("alljs.php");echo"$xtm";?></font> </div></a>
                 </td>
                  <td width="40%">&nbsp;</td>
                </tr>
                <tr>
                  <td height="42">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
          </tr>
        </tbody>
      </table>
<table height=157 cellspacing=0 cellpadding=0 width=500 align=center background=images/3.jpg border=0>
            <tbody>
              <tr>
                <td width=1 height="157"></td>
                <td width=149 background="images/2.jpg"></td>
                <td width="350" align=middle><table cellspacing=3 cellpadding=0 width=330 border=0>
                  <form action="<?=$thisprog?>" method="post">
                    <input type=hidden name="act" value="pass">
                    <tbody>
                      <tr>
                        <td width=64 height="27" align=right>用　户</td>
                        <td width=17 align=right>&nbsp;</td>
                        <td colspan="2"><input class=input style="WIDTH: 150px" size=20 name=username></td>
                      </tr>
                      <tr>
                        <td width=64 height="31" align=right>密　码</td>
                        <td align=right width=17>&nbsp;</td>
                        <td colspan="2"><input class=input  style="WIDTH: 150px" style="height:20" type=password size=20 name=password></td>
                      </tr>
                      <tr>
                        <td width=64></td>
                        <td width=17></td>
                        <td width="66" height=20><div align="right"><a href="getmypwd.php"><font size=2>忘记密码</font></a>&nbsp;</div></td>
                        <td width="168"><input class=button style="font-size:10pt" type=submit value=" 登 录 " name=Submit></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td height=20 colspan="2">  <p>技术支持：<a href="http://www.21573.com" target="_blank">爱一网情深</a></p></td>
                      </tr>
                  </form>
                </table></td>
              </tr>
      </table></td>
    </tr>
  </tbody>
</table>
</td></tr>
 </table></td>
  </tr>
</table>
 </body></html>
<?
EOT;
}
function admintitle() {
global $checkpower;
print <<<EOT
     <html>
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<LINK href="images/cs.css" rel=stylesheet>　 <STYLE type="text/css"> 
　　 TD{ 
　　　　 word-break: break-all; 
　　　　} 
　　 </style>  
 </head>
 <SCRIPT    LANGUAGE="JavaScript">   
   document.onkeydown    =    function()    {   
   if(event.keyCode==116)    {   
   event.keyCode=0;   
   event.returnValue    =    false;   
   }   
   }   
   document.oncontextmenu    =    function()    {event.returnValue    =    false;}   
   </SCRIPT> <body onkeydown='if(event.keyCode==78 && event.ctrlKey)return false;'>
<body bgcolor=#99CCFF topmargin=5 leftmargin=5><table width=98% cellpadding=0 cellspacing=1 border=0 bgcolor=#99CCFF align=center>
    <tr><td>
    <table width=100% cellpadding=0 cellspacing=1 border=0>
    <tr><td width=10% valign=top bgcolor=#FFFFFF>
    <table width=100% cellpadding=6 cellspacing=0 border=0>
    <tr><td bgcolor=#CBDED8><center><font color=red>
    <b>功 能 选 项</b>
    </td></tr>
    <tr>
    <td bgcolor=#FFFFFF valign=center><br>
◇ <a href=>系统首页</a><br> <br>
◇ <a href=wj.php>文件列表</a><br> <br>
◇ <a href=system.php>系统设置</a><br> <br>
◇  <a href="javascript:void(0)" onclick="window.open ('upfile.php','','top=0,left=0,width=700,height=363,status=no,resizable=yes,scrollbars=yes');">发布文件</a><br> <br>
◇ <a href=ml.php>分类管理</a><br><br>
◇ <a href=jl.php>安全日志</a><br><br>
◇ <a href=userlist.php>用户信息</a> <br><br>
◇ <a href=sitemail.php>站内短信</a> <br><br>
◇ <a href=bfleasin.php>数据管理</a> <br><br>
◇ <a href=?leasin=logout OnClick="JavaScript: if(confirm('确实要退出系统吗？')) return true; else return false;">退出系统</a><br><br>
◇ <a href=http://www.21573.com target=_blank><font color=red>技术支持</font></a>
    </td></tr>
  </table>
    </td><td width=65% valign=top bgcolor=#FFFFFF>
    <table width=100% cellpadding=6 cellspacing=0 border=0  valign=top>
EOT;
}
function readfrom($file_name) {
	$filenum=@fopen($file_name,"r");
	@flock($filenum,LOCK_SH);
	$file_data=@fread($filenum,filesize($file_name));
	@fclose($filenum);
	return $file_data;
}
function writeto($file_name,$infoata,$method="w") {
	$filenum=@fopen($file_name,$method);
	flock($filenum,LOCK_EX);
	$file_data=fwrite($filenum,$infoata);
	fclose($filenum);
	return $file_data;
}
if(($thisprog !="jl.php")&($thisprog !="filejl.php")){
$book=$jl."leasin.php";
$garray = file($book);
$err="<meta http-equiv=refresh content=0;url=../><?exit;?>";
$cog=count($garray);
$delline=500; //操作记录容量
if ($cog>=500) {
include("$mydata/mydel.php");
}
$larray = explode("|",$garray[0]);
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
$xinxi=array($err,$settime,$username,$_SERVER[REMOTE_ADDR],$thisprog,$title);
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
}
if(($checkpower==ice)){
echo "<script>alert(\"抱歉，您的帐户已经被冻结，请联系：$new_info[8]  电话$new_info[2]\");javascript:window.close();</script>";
exit;}
if($checkpower!=super) {
if($zt==off){
echo"<br><center><font size=4 color=red>系统维护中……</font><br><br>如有疑问请联系：$new_info[8] 电话：$new_info[2]</p>";    
exit;}
}