<?
$oldname=$_GET['oldname'];
extract($_POST);
$title="�༭�û�����";
$thisprog="edituser.php";
require("global.php");
if($oldname!=$username){
if($checkpower!=super) {
echo "<script>alert(\"��Ǹ�������ڵ��û���û�и�Ȩ�ޣ�\");javascript:history.go(-1);</script>";
exit;}
}
echo"<title>$title / $xtm</title>";  	
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
if (file_exists("$userd$oldname.php"))	$usei=explode("|",readfrom("$userd$oldname.php"));		  	  
unset($powe);unset($powe1);unset($powe2);unset($powe3);
if($usei[3]==super) { $powe2='selected';}else if($usei[3]==high){ $powe='selected'; }else if($usei[3]==low) {$powe1='selected';  }if($usei[3]==ice) {$powe3='selected';  }
if($checkpower!=super) {$gl1="<input type=hidden name=qx  value=$usei[3]>"; $xg="<input type=hidden name=name value=$usei[1]><b>$usei[1]</b>";}else {$xg="<input type=text name=name  maxlength=12 size=20 value=$usei[1]>"; $gl1="<td height=37 align=center><div align=right>����Ȩ��</div></td><td align=center>&nbsp;</td>    <td height=37 colspan=3 align=center><div align=left>      <select name=qx>        <option value=low $powe1>��ͨ�û�</option>        <option value=high $powe>�߼��û�</option>        <option value=super $powe2>ϵͳ����</option>        <option value=ice $powe3>�����ʻ�</option>      </select>    </div></td>"; }
if (empty($action)) {
	print <<<EOT
    <tr><td bgcolor=#ffffff colspan=3>
    <br> <center><font color="#FF6600" size="3" face="verdana"><b>$title</b></font>
    <form action="$thisprog" method=POST><input type=hidden name="action" value="edit"><input type=hidden name="oldname" value="$usei[1]">
    <table border="0" width="95%" cellspacing="1" cellpadding="0" bgcolor="#DAEFE1" height="271">
  <tr>
    <td width="15%" align="center" height="37"><div align="right">�û���</div></td>
    <td width="1%" align="center">&nbsp;</td>
    <td width="40%" align="center" height="37"><div align="left">$xg
    </div></td>
  
    <td width="7%" height="37" align="center"><div align="right">����</div></td>
    <td width="1%" align="center">&nbsp;</td>
    <td width="36%" height="37" colspan="3" align="center"><div align="left">
      <div align="left"><input type=text name="xm" size=20 maxlength=8 value=$usei[7]></div>
    </div></td>
  </tr>
  <tr>
    <td align="center" height="27"><div align="right">�� λ</div></td>
    <td align="center">&nbsp;</td>
    <td align="center" height="27"><div align="left">  <input type=text name="dw" size=20 value=$usei[5]></div></td>
    <td height="27" align="center"><div align="right">��ϵ�绰</div></td>
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
        <td height="37" align="center"><div align="right">ԭ����</div></td>
        <td align="center">&nbsp;</td>
        <td height="37" colspan="3" align="center"><div align="left">
          <input name="npwd" size=21 type="password" style="height:20" maxlength=16 title=6-16���ַ� />
        </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">�� �� ��</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" align="center"><div align="left">
      <input name="usrpwd" size=21 type="password" style="height:20" maxlength=16 title=6-16���ַ�>
    </div></td>
    <td height="37" align="center"><div align="right">�ظ�����</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" colspan="3" align="center"><div align="left">
      <input name="usrpwd1" size=21 type="password" style="height:20" maxlength=16 title=6-16���ַ�>
    </div></td>
  </tr>
  <tr>
    <td align="center"><div align="right">������Կ</div></td>
    <td align="center">&nbsp;</td>
    <td height="37" align="center"><div align="left"> <input type=password name="ms" size=21 style="height:20" >
    &nbsp; ��������ʱ�ã�����������</div></td>
   $gl1
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td height="35" align="center">&nbsp;</td>
        <td height="35" align="center"></td>
        <td align="center">&nbsp;</td>
        <td height="10" colspan="4" align="left"><div align="left">
      <input type=submit class=button name=Submit value="�ύ">&nbsp;&nbsp; <input type="reset" value="��д" class=button  name="reset"  title="�������д������">&nbsp;&nbsp;&nbsp;<input type="button" value="����" class=button  title="�����༭��������һҳ"  onclick="javascript:history.go(-1)">     </div></td>
  </tr>
</table>
</form>
EOT;
exit;
}
if ($action=="edit") {
   $name=str_replace("|","��",$name);
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
echo "<script>alert(\"��Ǹ�����û����Ѿ�����ʹ�ã��������\");javascript:history.go(-1);</script>";
exit;
}
}
if($name=="")
{
echo "<script>alert(\"�û�������Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($name!=""){
if((strlen($name)>12)|(strlen($name)<4)){
echo "<script>alert(\"�û���������4-12���ַ���\");javascript:history.go(-1);</script>";
exit();
}}
if($usertel=="")
{
echo "<script>alert(\"��ϵ�绰����Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($usertel!=""){
if((strlen($usertel)>11)|(strlen($usertel)<7)){
echo "<script>alert(\"��������д��ϵ�绰��\");javascript:history.go(-1);</script>";
exit();
}}
if($email!="")
{
 if(!ereg("@",$email))
{echo "<script>alert(\"�������� �������лл��\");javascript:history.go(-1);</script>";
exit();}
}
if($checkpower!=super) {
$bpwd=md5($npwd);
if($bpwd!=$usei[2]){
echo "<script>alert(\"ԭ������֤ʧ�ܣ������޸����ϣ�\");javascript:history.go(-1);</script>";
exit();
}
}
if($usrpwd) {
if($usrpwd!=$usrpwd1)
{
echo "<script>alert(\"�����������벻һ�£� �������лл��\");javascript:history.go(-1);</script>";
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
echo "<script>alert(\"�����ɹ���\");</script><meta http-equiv=refresh content=0;url=userlist.php>";
}
print "</td></tr></table></body></html>";
exit;