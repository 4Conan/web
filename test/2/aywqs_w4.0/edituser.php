<?
$oldname=$_GET['oldname'];
extract($_POST);
$title="编辑用户资料";
$thisprog="edituser.php";
require("global.php");
if($oldname!=$username){
if($checkpower!=super) {
echo "<script>alert(\"抱歉，您所在的用户组没有该权限！\");javascript:history.go(-1);</script>";
exit;}
}
echo"<title>$title / $xtm</title>";  	
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
if (file_exists("$userd$oldname.php"))	$usei=explode("|",readfrom("$userd$oldname.php"));		  	  
unset($powe);unset($powe1);unset($powe2);unset($powe3);
if($usei[3]==super) { $powe2='selected';}else if($usei[3]==high){ $powe='selected'; }else if($usei[3]==low) {$powe1='selected';  }if($usei[3]==ice) {$powe3='selected';  }
if($checkpower!=super) {$gl1="<input type=hidden name=qx  value=$usei[3]>"; $xg="<input type=hidden name=name value=$usei[1]><b>$usei[1]</b>";}else {$xg="<input type=text name=name  maxlength=12 size=20 value=$usei[1]>"; $gl1="<td height=37 align=center><div align=right>管理权限</div></td><td align=center>&nbsp;</td>    <td height=37 colspan=3 align=center><div align=left>      <select name=qx>        <option value=low $powe1>普通用户</option>        <option value=high $powe>高级用户</option>        <option value=super $powe2>系统管理</option>        <option value=ice $powe3>冻结帐户</option>      </select>    </div></td>"; }
if (empty($action)) {
	print <<<EOT
    <tr><td bgcolor=#ffffff colspan=3>
    <br> <center><font color="#FF6600" size="3" face="verdana"><b>$title</b></font>
    <form action="$thisprog" method=POST><input type=hidden name="action" value="edit"><input type=hidden name="oldname" value="$usei[1]">
    <table border="0" width="95%" cellspacing="1" cellpadding="0" bgcolor="#DAEFE1" height="271">
  <tr>
    <td width="15%" align="center" height="37"><div align="right">用户名</div></td>
    <td width="1%" align="center">&nbsp;</td>
    <td width="40%" align="center" height="37"><div align="left">$xg
    </div></td>
  
    <td width="7%" height="37" align="center"><div align="right">姓名</div></td>
    <td width="1%" align="center">&nbsp;</td>
    <td width="36%" height="37" colspan="3" align="center"><div align="left">
      <div align="left"><input type=text name="xm" size=20 maxlength=8 value=$usei[7]></div>
    </div></td>
  </tr>
  <tr>
    <td align="center" height="27"><div align="right">单 位</div></td>
    <td align="center">&nbsp;</td>
    <td align="center" height="27"><div align="left">  <input type=text name="dw" size=20 value=$usei[5]></div></td>
    <td height="27" align="center"><div align="right">联系电话</div></td>
    <td align="center">&nbsp;</td>
    <td height="27" colspan="3" align="center"><div align="left">
      <input type=text name="usertel" size=20 value=$usei[6]>
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">E-mail</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" align="center"><div align="left">
      <input type=text name="email" size=20 maxlength=25 value=$usei[8] >
    </div></td>
        <td height="37" align="center"><div align="right">原密码</div></td>
        <td align="center">&nbsp;</td>
        <td height="37" colspan="3" align="center"><div align="left">
          <input name="npwd" size=21 type="password" style="height:20" maxlength=16 title=6-16个字符 />
        </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">新 密 码</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" align="center"><div align="left">
      <input name="usrpwd" size=21 type="password" style="height:20" maxlength=16 title=6-16个字符>
    </div></td>
    <td height="37" align="center"><div align="right">重复密码</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" colspan="3" align="center"><div align="left">
      <input name="usrpwd1" size=21 type="password" style="height:20" maxlength=16 title=6-16个字符>
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">您的密钥</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" align="center"><div align="left"> <input type=password name="ms" size=21 style="height:20" >
    &nbsp; 忘记密码时用，不改请留空</div></td>
   $gl1
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td height="35" align="center">&nbsp;</td>
        <td height="35" align="center"></td>
        <td align="center">&nbsp;</td>
        <td height="10" colspan="4" align="left"><div align="left">
      <input type=submit class=button name=Submit value="提交">&nbsp;&nbsp; <input type="reset" value="重写" class=button  name="reset"  title="清除刚填写的内容">&nbsp;&nbsp;&nbsp;<input type="button" value="返回" class=button  title="放弃编辑并返回上一页"  onclick="javascript:history.go(-1)">     </div></td>
  </tr>
</table>
</form>
EOT;
exit;
}
if ($action=="edit") {
   $name=str_replace("|","│",$name);
        $name=str_replace("<","&lt;",$name);
        $name=str_replace(">","&gt;",$name);
        $name=str_replace("\r","",$name);
        $name=str_replace("\t","",$name);
        $name=str_replace("\n","<br>",$name);
        $name=str_replace(" ","",$name);
if($name!=$oldname)
{
if (file_exists("$userd$name.php")) 
{ 
echo "<script>alert(\"抱歉！该用户名已经有人使用，请更换！\");javascript:history.go(-1);</script>";
exit;
}
}
if($name=="")
{
echo "<script>alert(\"用户名不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($name!=""){
if((strlen($name)>12)|(strlen($name)<4)){
echo "<script>alert(\"用户名控制在4-12个字符！\");javascript:history.go(-1);</script>";
exit();
}}
if($usertel=="")
{
echo "<script>alert(\"联系电话不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($usertel!=""){
if((strlen($usertel)>11)|(strlen($usertel)<7)){
echo "<script>alert(\"请认真填写联系电话！\");javascript:history.go(-1);</script>";
exit();
}}
if($email!="")
{
 if(!ereg("@",$email))
{echo "<script>alert(\"邮箱有误， 请更正！谢谢！\");javascript:history.go(-1);</script>";
exit();}
}
if($checkpower!=super) {
$bpwd=md5($npwd);
if($bpwd!=$usei[2]){
echo "<script>alert(\"原密码验证失败！不能修改资料！\");javascript:history.go(-1);</script>";
exit();
}
}
if($usrpwd) {
if($usrpwd!=$usrpwd1)
{
echo "<script>alert(\"两次输入密码不一致， 请更正！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
}
$date_reg=$timestamp;
if (file_exists("$userd$oldname.php"))	$usr=explode("|",readfrom("$userd$oldname.php"));
if($usrpwd) $addpwd=md5($usrpwd); else $addpwd=$usr[2];
if($ms){ $addms=md5($ms);}else $addms=$usr[9];
if ($oldname==$name) {
$use_info="<?exit;?>|$oldname|$addpwd|$qx|$date_reg|$dw|$usertel|$xm|$email|$addms|$usr[10]|";
writeto("$userd".$oldname.".php",$use_info);}
else{
$usedd="<?exit;?>|$name|$addpwd|$qx|$date_reg|$dw|$usertel|$xm|$email|$usr[9]|$usr[10]|";
writeto("$userd".$name.".php",$usedd);
if(file_exists("$userd$oldname.php")) unlink("$userd$oldname.php");
if(file_exists("$mail$oldname.php")) unlink("$mail$oldname.php");
}
echo "<script>alert(\"操作成功！\");</script><meta http-equiv=refresh content=0;url=userlist.php>";
}
print "</td></tr></table></body></html>";
exit;