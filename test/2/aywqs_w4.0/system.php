<?
error_reporting(7);
$thisprog="system.php";
$title="��������";
require("global.php");
echo"<title>$xtm / $title</title>"; 
if($checkpower!=super) {
echo"<br><center><font size=4 color=red>��Ǹ����û�д�Ȩ��</font><br><br>������������ϵ��$new_info[8] �绰��$new_info[2]</p>";    
exit;
}
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
extract($_POST);
if($_POST['action'] == "system")
{     
$site_name=$_POST['site_name'];
$tel=$_POST['tel'];
$address=$_POST['address'];
$mail=$_POST['mail'];
$address=$_POST['address'];
$ip=$_POST['ip'];
$zt=$_POST['zt'];
}
if (empty($action)) 
{   
if (file_exists("$mydata/config.php"))	
{
$new_info=explode("|",readfrom("$mydata/config.php"));
}
unset($zt);unset($zt1);
if($new_info[9]==on) $zt1='selected';else  $zt2='selected';

print <<<EOT
   <tr><td bgcolor=#ffffff colspan=3>
    <form action="$thisprog" method=POST>      
      <div align="left">
          <br>
          <input type=hidden name="action" value="system">  <input type=hidden name="username" value="$username">
 $tab_top
<center><font color="#FF6600" size="3" face="verdana"><b>$title</b></font> <p> 
<table border="1" width="95%" cellspacing="0" cellpadding="1">
  <tr>
    <td width="30%" height=30><font color=red> &nbsp; &nbsp;��վ���ƣ�</font>
    </td>
    <td width="25%"><input type=text name="site_name" size=40 value=$new_info[1]>  
    </td>
    <td width="45%">��</td>
  </tr> 
<tr>
    <td width="30%" height=30><font color=red> &nbsp; &nbsp;��վ״̬��</font>
    </td>
    <td width="25%"><select name="zt"><option value=on $zt1>����</option><option value=off $zt2>�ر�</option></select>
    </td>
    <td width="45%">��</td>
  </tr> 
  <tr>
    <td width="30%" height=30><font color=red> &nbsp; &nbsp;����λ��</font>
    </td>
    <td width="25%"><input type=text name="d_name" size=40 value=$new_info[8]>  
    </td>
    <td width="45%">��</td>
  </tr> <tr>
    <td width="30%" height=30>
<font color=red> &nbsp; &nbsp;��ϵ�绰��</font></td>
    <td width="25%"><input type=text name="tel" size=40 value=$new_info[2]>
    </td>
    <td width="45%">��</td>
  </tr> 
  <tr>
    <td width="30%" height=30>
<font color=red> &nbsp; &nbsp;��λ��ַ��</font></td>
    <td width="25%">
<font color=red><input type=text name="address" size=40 value=$new_info[3]>
      </font></td>
    <td width="45%">��</td>
  </tr>
  <tr>
    <td width="30%" height=30>
<font color=red> &nbsp; &nbsp;�������룺</font></td>
    <td width="25%">
<font color=red><input type=text name="yb" size=40 value=$new_info[7]>
      </font></td>
    <td width="45%">��</td>
  </tr>
   <tr>
    <td width="30%" height=30>
<font color=red> &nbsp; &nbsp;����������</font></td>
    <td width="25%">
<font color=red><input type=text name="mail" size=40 maxlength=3 value=$new_info[4]>
      </font></td>
    <td width="45%">��</td>
  </tr>
     <tr>
    <td width="30%" height=30>
<font color=red> &nbsp; &nbsp;IP��ѯ��</font></td>
    <td width="25%">
<font color=red><input type=text name="ip" size=40 value=$new_info[5]>
      </font></td>
    <td width="45%">��Ҫ�ӡ�<font color=red>http://</font></td>
  </tr>
  <tr>
    <td width="30%" height=30>��</td>
    <td width="25%" height=40>
        <center>  <input type=submit class=button value="�� ��">
      </center></td>
    <td width="45%">��</td>
  </tr>
</table>
</font>
&nbsp;&nbsp; &nbsp; ��һ�ν��д���������� <font color=red>$new_info[6]</font>
	        <br>
        <center>  &nbsp;$tab_bottom 
    </form>
</tr></table></body></html>
EOT;
exit;
}elseif ($action=="system") {
if($checkpower !=super) {
print "<script>alert(\"ֻ�г����û������޸Ĵ˲�����\");javascript:history.go(-1);</script>";
exit;}
        $site_name=stripslashes($site_name);
        $ip=stripslashes($ip);
        $tel=stripslashes($tel);
        $mail=stripslashes($mail);
        $address=stripslashes($address);
        $yb=stripslashes($yb);
        $d_name=stripslashes($d_name);
        $zt=stripslashes($zt);
$ip=str_replace('http://','',$ip);	
print "<tr><td valign=middle align=center colspan=2><b><font color=black size=3>�޸�ϵͳ����</font></b></td></tr>
	<tr><td bgcolor=ffffff colspan=2>";
	echo"<img src=images/ok.jpg><br><br><br><br><font color=blue>ϵͳ�����޸ĳɹ���&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<a href=$thisprog><font color=red>����ִ����������</a>";
$new_info="<? echo\"<meta http-equiv=refresh content=0;url=../index.php>\"; exit;?>;|$site_name|$tel|$address|$mail|$ip|$username|$yb|$d_name|$zt";
writeto("$mydata/config.php",$new_info);
exit;
echo "<img src=images/ok.jpg><br><br><br><br><font color=blue>ϵͳ�����޸ĳɹ���<b></b><br><a href=$thisprog>����</a>";
}
?>   