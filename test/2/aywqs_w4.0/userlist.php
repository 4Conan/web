<?
$thisprog="userlist.php";
$title="�û���Ϣ";
require("global.php");
echo"<title>$title / $xtm</title>";
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=edituser.php?oldname=$username><font color=red>�޸��ҵ�����</font></a></td></tr>";
extract($_POST);
if($_POST['ac']=="t")
{     
    $page=$_POST['page'];
	}
	else $page=$_GET['page'];
$number="10";
$datadir=$userd;
function myreaddir($dir) {
        $handle=opendir($dir);
        $i=0;
        while($file=readdir($handle)) {
                if (($file!=".")and($file!="..")) {
                        $list[$i]=$file;
                        $i=$i+1;
                        }
                }
        closedir($handle);
        return $list;
        }
$oldlist=myreaddir($datadir);
sort($oldlist);
        $list=$oldlist;
        $posts=count($list);
if ($action=="addnew") {
   $name=str_replace("|","��",$name);
        $name=str_replace("<","&lt;",$name);
        $name=str_replace(">","&gt;",$name);
        $name=str_replace("\r","",$name);
        $name=str_replace("\t","",$name);
        $name=str_replace("\n","<br>",$name);
        $name=str_replace(" ","",$name);
        $usrpwd=str_replace(" ","",$usrpwd);
if (file_exists("$userd$name.php")) 
{ 
echo "<script>alert(\"��Ǹ�����û����Ѿ�����ʹ�ã��������\");javascript:history.go(-1);</script>";
exit;
}
if($name=="")
{
echo "<script>alert(\"�û�������Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($name=="high")
{
echo "<script>alert(\"�û������Ϸ���\");javascript:history.go(-1);</script>";
exit();
}
if($name=="leasin")
{
echo "<script>alert(\"leasin��ϵͳ���Ա��������ʹ�������ʺţ�\");javascript:history.go(-1);</script>";
exit();
}
if($name!=""){
if((strlen($name)>12)|(strlen($name)<4)){
echo "<script>alert(\"�û���������4-12���ַ���\");javascript:history.go(-1);</script>";
exit();
}}
if($ms=="")
{
echo "<script>alert(\"��Կ����Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($ms!=""){
if((strlen($ms)<4)){
echo "<script>alert(\"��Կ���ܶ���4���ַ���\");javascript:history.go(-1);</script>";
exit();
}}
if($usrpwd=="")
{
echo "<script>alert(\"���벻��Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($usrpwd!=""){
if((strlen($usrpwd)>16)|(strlen($usrpwd)<6)){
echo "<script>alert(\"�뽫���������6-16�ַ���\");javascript:history.go(-1);</script>";
exit();
}}
if($realname=="")
{
echo "<script>alert(\"��������Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
if($userabout=="")
{
echo "<script>alert(\" ��λ����Ϊ�գ�\");javascript:history.go(-1);</script>";
exit();
}
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
$date_reg=$timestamp;
$addpwd=md5($usrpwd);
$addms=md5($ms);
$use_info="�����Ƿ���<?exit;?>|$name|$addpwd|$usrpower|$date_reg|$userabout|$usertel|$realname|$email|$addms|$use[10]|";
writeto("$userd".$name.".php",$use_info);
$book=$mail."/".$name.".php";
$garray = file($book);
$cog=count($garray);
$larray = explode("|",$garray[0]);
$id=$larray[1]+1;
$zt="new";
$xt="sys";
$titlexx="��ӭ���ļ���";
$note="�װ���<font color=red>$name</font>,��ӭ����Ϊ�����е�һԱ��ϣ�����ܹ����渺�������ְ������Υ����Ϊ���ǽ�׷���������Ρ�";
$err="�����Ƿ���<?exit;?>";
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
$xinxi=array($err,$id,$settime,$username,$titlexx,$note,$zt,$xt);
$newguest = implode("|", $xinxi)."|\r";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"�����ɹ���\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
}
$oldname=$_GET['oldname'];
$action=$_GET['action'];
if ($action=="del") {
if($checkpower!=super) {
echo "<script>alert(\"��Ǹ�������ڵ��û���û�и�Ȩ�ޣ�\");javascript:history.go(-1);</script>";
exit;}
if($username!="leasin")
{
if($oldname=="leasin")
{
echo "<script>alert(\"�ʻ�leasin����ɾ����\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
exit();
}
}
if(file_exists("$userd$oldname.php")) unlink("$userd$oldname.php");
if(file_exists("$mail/$oldname.php")) unlink("$mail/$oldname.php");
echo "<script>alert(\"�ɹ�ɾ���û���\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
}
?>
<center>
<?
if($checkpower=="super") {
?>
    <form action=?action=addnew method=post><input type=hidden name="action" value="addnew">
  <table border="0" width="98%" cellspacing="1" cellpadding="0" bgcolor="#DAEFE1" height="52">
  <tr><BR><b>�����û�</b> <font color=red>�û����������в��ð����ո�</font>
    <td width="11%" align="center" height="21">�û���</td>
    <td width="11%" align="center" height="21">��&nbsp; ��</td>
    <td width="11%" align="center" height="21">&nbsp;��&nbsp; ��</td>
    <td width="11%" align="center" height="21">&nbsp; ��&nbsp; λ</td> 
    <td width="12%" align="center" height="15">��ϵ�绰</td>
    <td width="14%" align="center" height="21">E-mail</td>
    <td width="9%" align="center" height="21">��Կ</td>
    <td width="8%" align="center" height="21">Ȩ&nbsp; ��</td> 
    <td width="13%" align="center" height="21"></td>
  </tr>
  <tr>
    <td width="11%" align="center"><input type=text name="name" size=11 maxlength=12 title=5-12���ַ�> </td>
    <td width="11%" align="center"><input type=text name="usrpwd" size=13 maxlength=16 title=6-16���ַ�> </td>
    <td width="11%" align="center"><input type=text  name="realname" size=13> </td>
    <td width="11%" align="center"><input type=text name="userabout" size=14> </td>
    <td width="12%" align="center"><input type=text name="usertel" size=15>  </td>
    <td width="14%" align="center"><input type=text name="email" size=20>  </td>
    <td width="9%" align="center"><input type=text name="ms" size=10 title=��������������������룬���μ�>  </td>
    <td width="8%" align="center"><select name="usrpower"><option value=low>��ͨ�û�</option><option value=high>�߼��û�</option><option value=super>ϵͳ����</option></select>
    </td>
    <td width="13%" align="center">
    <input type=submit class=button name=Submit value="�ύ"></td>
  </tr>
</table></form>
<?
}?>
<table border="1" cellspacing="0" width="98%" bordercolorlight="#405028" bgcolor="#DAEFE1"  bordercolordark="#FFFFFF">
<tr>  <br><b><?=$title?></b> <font color=red>����Ϊ�Ѿ����ڵ��û�</font>
<td height="26" width="8%"align="center">
<b>�û���</b></td>
<td height="26" width="8%"align="center">
<b>��   ��</b></td>
<td height="26" width="14%" align="center">
<b>��   λ</b></td>
<td height="26" width="8%" align="center">
<b>��ϵ�绰</b></td>
<td height="26" width="14%" align="center">
<b>E-mail</b></td>
<td height="26" width="8%"  align="center">
<b>����Ȩ��</b></td>
<td height="26" width="8%"  align="center">
<b>����վ����Ϣ</b></td>
<td width="19%"  align="center"><b>����¼</b></td>
<?
if($checkpower=="super") {
?>
<td width="13%"  align="center"><b>�༭</b></td>
<?
}
?>
</tr>
<?php
if (!isset($page)) { $page=1; }
for ($i=$posts-($number+1)*($page-1);$i>$posts-($number+1)*$page;$i=$i-1) {
        if ($list[$i]!="") {
             $f = file_get_contents("$datadir$list[$i]");
$use=explode("|",$f);
 if($use[3]!=super){
		  	  if($use[3]!=high){
		  	     if($use[3]!=low) {$qx="<font color=red>�����ʻ�</font>";}
				 else $qx="��ͨ�û�";}
				  else $qx="�߼��û�";} else $qx="ϵͳ����Ա";				  
				  if($use[3]!="ice") $mx="<a href=javascript:void(1) onClick=\"window.open ('writemail.php?recname=$use[1]','','top=100,left=0,width=700,height=465,status=no,resizable=yes,scrollbars=yes');\" title=\"�� $use[7] ������Ϣ\"><img src=images/mail.gif border=0></a>";else $mx="<img src=images/fol-over.jpg title=��������ʻ��޷�������Ϣ border=0>";
                echo "<tr><td height=20 align=center>$use[1]</td>
<td align=center>$use[7]</td><td align=center>$use[5]</td><td align=center>$use[6]</td><td align=center><a href=mailto:$use[8]?subject=hi,$use[7]>$use[8]</a></td><td align=center>$qx</td><td align=center> $mx<td align=center>$use[10]</td>";
if($checkpower=="super") {
echo"<form action=edituser.php method=post><input type=hidden name=oldname value=$use[1]><td align=center><input name=Submit title=�޸� $use[7] ������  type=image src=images/write.gif border=0> <a href=?action=del&oldname=$use[1] OnClick=\"JavaScript: if(confirm('ȷʵҪɾ���û� $use[7] ��')) return true; else return false\";><img src=images/fol-over.jpg title=ɾ�� $use[7] border=0></a></td></form>";}


                }
        }
?>
</table>
<p><table  cellspacing="0" width="84%" bordercolorlight="#405028" bordercolordark="#FFFFFF">
  <tr>
    <td align="center"><font color=red>
	<?php
if ($posts%$number==0) $total=$posts/$number;
		else $total=floor($posts/$number)+1;
?> 
<form method=post action=""><input type="hidden" name="ac" value="t"><td height="22" bgcolor="#FFFFFF" >&nbsp;
<?
if ($total<=1) echo "&nbsp;����  <font color=red><b>$posts</b></font> ���ļ� | ֻ��һҳ  </a>";
else { 
      $nextpage=$page+1;
      $previouspage=$page-1;
	  echo " ���� <font color=red><b>$posts</b></font> ���ļ� | ";
	  if ($page<=1) echo " ��ҳ����һҳ��<a href=?page=$nextpage>��һҳ</a>��<a href=?page=$total>βҳ</a> ";
	  elseif($page>=$total) echo " <a href=?>��ҳ</a>��<a href=?page=$previouspage>��һҳ</a>����һҳ</a>��βҳ ";
	 else echo " <a href=?>��ҳ</a>��<a href=?page=$previouspage>��һҳ</a>��<a href=?page=$nextpage>��һҳ</a>��<a href=?page=$total>βҳ</a> ";
	  echo " | <font color=red>$page</font>/$total  <font color=red> $number</font> ��/ҳ | ת�� <select name='page' size='1' style=\"border: 1px solid #429234; background-color: #FAFDF9\" onChange='javascript:submit()'>";
	for ($j=1; $j<=$total; $j++) {echo "<option value='".$j."'>��".$j."ҳ</option>";
	}
	echo "</select>";
}
?>