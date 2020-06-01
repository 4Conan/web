<?
error_reporting(7);
ob_start();
$title="重设密码";
include("alljs.php");
$thisprog="getmypwd.php";
echo"<title>$title</title>";
extract($_POST);
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
?><LINK href="images/cs.css" rel=stylesheet>
    <form action=<?=$thisprog?>  method=post>
      <p>
        <input type=hidden name="action" value="editps">
        <BR>    
        <center>
        <font color="#FF6600" size="3" face="verdana"><b>
        <?=$title?>
          </b></font>      </p>
   <p>为安全起见，请详细填写以下每一项</p>
   <p>如通过以下方法仍无法找回密码请联系：<b><? echo"$new_info[8] 电话：$new_info[2]";?></b></p>
   <p>技术支持：<a href="http://www.21573.com" target="_blank">爱一网情深</a></p>
   <table border="0" width="600" cellspacing="1" cellpadding="0" bgcolor="#DAEFE1" height="270">
  <tr>
    <td width="24%" align="center" height="26"><div align="right">用户名</div></td>
    <td width="26%" align="center" height="26"><div align="left">
      <input type=text name="name" size=15 maxlength=12 title=5-12个字符>
    </div></td>
    <td width="14%" align="center"><div align="right">姓&nbsp; 名</div></td>
    <td width="36%" align="center"><div align="left">
      <input type=text  name="realname" size=15 maxlength=12 />
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">单&nbsp; 位</div></td>
    <td height="39" align="center"><div align="left">
      <input type=text name="userabout" size=15 maxlength=30 />
    </div></td>
    <td align="center"><div align="right">联系电话</div></td>
    <td align="center"><div align="left">
      <input type=text name="usertel" size=15 />
    </div></td>
  </tr>
  
  <tr>
    <td align="center"><div align="right">E-mail</div></td>
    <td height="29" align="center"><div align="left">
      <input type=text name="email" size=15 maxlength=25>
    </div></td>
    <td align="center"><div align="right">您的权限</div></td>
    <td align="center"><div align="left">
      <select name="usrpower">
        <option value=low>普通用户</option>
        <option value=high>高级用户</option>
        <option value=super>系统管理</option>
      </select>
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">新 密 码</div></td>
    <td height="33" align="center"><div align="left">
      <input name="usrpwd" size=15 type="password" style="height:20" maxlength=16 title=6-16个字符 />
    </div></td>
    <td align="center"><div align="right">重复密码</div></td>
    <td align="center"><div align="left">
      <input name="usrpwd1" size=15 style="height:20" type="password" maxlength=16 title=6-16个字符 />
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">您的密钥</div></td>
    <td height="29" colspan="3" align="center"><div align="left"> <input type=password name="ms" size=15 style="height:20">
    &nbsp; 注册帐号时所填写的密钥，如不知道请询问管理员</div></td>
    </tr>
  <tr>
    <td height="45" colspan="4" align="right"><div align="center">
      <input type=submit class=button name=Submit value="提交">
      &nbsp;&nbsp;      
      <input class="button" type=button  onclick="javascript:history.go(-1)" title="放弃并返回上一页面" value="放 弃">
    </div></td>
    </tr>
</table>
</form>
<?
if ($action=="editps") {
 if($_POST["action"] == "editps")
 {    
    $name=$_POST['name'];
	$usrpower=$_POST['usrpower'];
	$userabout=$_POST['userabout'];
	$usrpwd=$_POST['usrpwd'];
	$usrpwd1=$_POST['usrpwd1'];
	$usertel=$_POST['usertel'];
	$realname=$_POST['realname'];
	$email=$_POST['email'];		
	$ms=$_POST['ms'];		
}	
  $name=str_replace("|","│",$name);
        $name=str_replace("<","&lt;",$name);
        $name=str_replace(">","&gt;",$name);
        $name=str_replace("\r","",$name);
        $name=str_replace("\t","",$name);
        $name=str_replace("\n","<br>",$name);
        $name=str_replace(" ","",$name);
        $usrpwd=str_replace(" ","",$usrpwd);
        $usrpwd1=str_replace(" ","",$usrpwd1);

$userd="$userd/";
if($name=="")
{
echo "<script>alert(\"请认真填写用户名！谢谢！\");javascript:history.go(-1);</script>";
exit();
} else{
if(file_exists("$userd".$name.".php")){
$use=explode("|",readfrom("$userd$name.php"));
if($use[3]==test)
{
echo "<script>alert(\"抱歉，测试用户不能使用此功能！\");javascript:history.go(-1);</script>";
exit();
}
if($realname!=$use[7])
{
echo "<script>alert(\"请认真填写真实姓名！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
if($userabout!=$use[5])
{
echo "<script>alert(\"请认真填写单位信息！\");javascript:history.go(-1);</script>";
exit();
}
if($usertel!=$use[6])
{
echo "<script>alert(\"联系电话不能为空！\");javascript:history.go(-1);</script>";
exit();
}
$djl=explode("│",$use[3]);	
if($usrpower!=$djl[0])
{
echo "<script>alert(\"权限不能乱写的哦！\");javascript:history.go(-1);</script>";
exit();
}
if($email!=$use[8])
{
echo "<script>alert(\"邮箱有误， 请更正！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
if($ms=="")
{
echo "<script>alert(\"请认真填写密码！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
if($usrpwd!=""){
if((strlen($usrpwd)>16)|(strlen($usrpwd)<6)){
echo "<script>alert(\"请将密码控制在6-16字符！\");javascript:history.go(-1);</script>";
exit();
}}
if($usrpwd!=$usrpwd1)
{
echo "<script>alert(\"两次输入密码不一致， 请更正！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
if($ms){ $addms=md5($ms);}
if($addms!=$use[9])
{
echo "<script>alert(\"请认真填写密钥！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
if($usrpwd){ $addpwd=md5($usrpwd);}
$usei="$use[0]|$use[1]|$addpwd|$usrpower|$use[4]|$userabout|$usertel|$realname|$email|$addms|$use[10]|";
writeto("$userd".$name.".php",$usei);
echo "<script>alert(\"您的密码已经修改，请牢记新密码！\");</script><meta http-equiv=refresh content=0;url=index.php>";
}
else 
{
echo "<script>alert(\"没有此用户，不要瞎捣乱哦！\");javascript:history.go(-1);</script>";
exit();
}}
}
exit;