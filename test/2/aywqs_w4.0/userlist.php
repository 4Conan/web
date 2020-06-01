<?
$thisprog="userlist.php";
$title="用户信息";
require("global.php");
echo"<title>$title / $xtm</title>";
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=edituser.php?oldname=$username><font color=red>修改我的资料</font></a></td></tr>";
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
   $name=str_replace("|","│",$name);
        $name=str_replace("<","&lt;",$name);
        $name=str_replace(">","&gt;",$name);
        $name=str_replace("\r","",$name);
        $name=str_replace("\t","",$name);
        $name=str_replace("\n","<br>",$name);
        $name=str_replace(" ","",$name);
        $usrpwd=str_replace(" ","",$usrpwd);
if (file_exists("$userd$name.php")) 
{ 
echo "<script>alert(\"抱歉！该用户名已经有人使用，请更换！\");javascript:history.go(-1);</script>";
exit;
}
if($name=="")
{
echo "<script>alert(\"用户名不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($name=="high")
{
echo "<script>alert(\"用户名不合法！\");javascript:history.go(-1);</script>";
exit();
}
if($name=="leasin")
{
echo "<script>alert(\"leasin是系统设计员，您不能使用他的帐号！\");javascript:history.go(-1);</script>";
exit();
}
if($name!=""){
if((strlen($name)>12)|(strlen($name)<4)){
echo "<script>alert(\"用户名控制在4-12个字符！\");javascript:history.go(-1);</script>";
exit();
}}
if($ms=="")
{
echo "<script>alert(\"密钥不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($ms!=""){
if((strlen($ms)<4)){
echo "<script>alert(\"密钥不能短于4个字符！\");javascript:history.go(-1);</script>";
exit();
}}
if($usrpwd=="")
{
echo "<script>alert(\"密码不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($usrpwd!=""){
if((strlen($usrpwd)>16)|(strlen($usrpwd)<6)){
echo "<script>alert(\"请将密码控制在6-16字符！\");javascript:history.go(-1);</script>";
exit();
}}
if($realname=="")
{
echo "<script>alert(\"姓名不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($userabout=="")
{
echo "<script>alert(\" 单位不能为空！\");javascript:history.go(-1);</script>";
exit();
}
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
$date_reg=$timestamp;
$addpwd=md5($usrpwd);
$addms=md5($ms);
$use_info="操作非法！<?exit;?>|$name|$addpwd|$usrpower|$date_reg|$userabout|$usertel|$realname|$email|$addms|$use[10]|";
writeto("$userd".$name.".php",$use_info);
$book=$mail."/".$name.".php";
$garray = file($book);
$cog=count($garray);
$larray = explode("|",$garray[0]);
$id=$larray[1]+1;
$zt="new";
$xt="sys";
$titlexx="欢迎您的加入";
$note="亲爱的<font color=red>$name</font>,欢迎您成为我们中的一员，希望您能够认真负责的履行职责，如有违规行为我们将追究您的责任。";
$err="操作非法！<?exit;?>";
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
$xinxi=array($err,$id,$settime,$username,$titlexx,$note,$zt,$xt);
$newguest = implode("|", $xinxi)."|\r";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"操作成功！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
}
$oldname=$_GET['oldname'];
$action=$_GET['action'];
if ($action=="del") {
if($checkpower!=super) {
echo "<script>alert(\"抱歉，您所在的用户组没有该权限！\");javascript:history.go(-1);</script>";
exit;}
if($username!="leasin")
{
if($oldname=="leasin")
{
echo "<script>alert(\"帐户leasin不能删除！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
exit();
}
}
if(file_exists("$userd$oldname.php")) unlink("$userd$oldname.php");
if(file_exists("$mail/$oldname.php")) unlink("$mail/$oldname.php");
echo "<script>alert(\"成功删除用户！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
}
?>
<center>
<?
if($checkpower=="super") {
?>
    <form action=?action=addnew method=post><input type=hidden name="action" value="addnew">
  <table border="0" width="98%" cellspacing="1" cellpadding="0" bgcolor="#DAEFE1" height="52">
  <tr><BR><b>新增用户</b> <font color=red>用户名、密码中不得包含空格</font>
    <td width="11%" align="center" height="21">用户名</td>
    <td width="11%" align="center" height="21">密&nbsp; 码</td>
    <td width="11%" align="center" height="21">&nbsp;姓&nbsp; 名</td>
    <td width="11%" align="center" height="21">&nbsp; 单&nbsp; 位</td> 
    <td width="12%" align="center" height="15">联系电话</td>
    <td width="14%" align="center" height="21">E-mail</td>
    <td width="9%" align="center" height="21">密钥</td>
    <td width="8%" align="center" height="21">权&nbsp; 限</td> 
    <td width="13%" align="center" height="21"></td>
  </tr>
  <tr>
    <td width="11%" align="center"><input type=text name="name" size=11 maxlength=12 title=5-12个字符> </td>
    <td width="11%" align="center"><input type=text name="usrpwd" size=13 maxlength=16 title=6-16个字符> </td>
    <td width="11%" align="center"><input type=text  name="realname" size=13> </td>
    <td width="11%" align="center"><input type=text name="userabout" size=14> </td>
    <td width="12%" align="center"><input type=text name="usertel" size=15>  </td>
    <td width="14%" align="center"><input type=text name="email" size=20>  </td>
    <td width="9%" align="center"><input type=text name="ms" size=10 title=用于忘记密码后重设密码，请牢记>  </td>
    <td width="8%" align="center"><select name="usrpower"><option value=low>普通用户</option><option value=high>高级用户</option><option value=super>系统管理</option></select>
    </td>
    <td width="13%" align="center">
    <input type=submit class=button name=Submit value="提交"></td>
  </tr>
</table></form>
<?
}?>
<table border="1" cellspacing="0" width="98%" bordercolorlight="#405028" bgcolor="#DAEFE1"  bordercolordark="#FFFFFF">
<tr>  <br><b><?=$title?></b> <font color=red>以下为已经存在的用户</font>
<td height="26" width="8%"align="center">
<b>用户名</b></td>
<td height="26" width="8%"align="center">
<b>姓   名</b></td>
<td height="26" width="14%" align="center">
<b>单   位</b></td>
<td height="26" width="8%" align="center">
<b>联系电话</b></td>
<td height="26" width="14%" align="center">
<b>E-mail</b></td>
<td height="26" width="8%"  align="center">
<b>管理权限</b></td>
<td height="26" width="8%"  align="center">
<b>发送站内消息</b></td>
<td width="19%"  align="center"><b>最后登录</b></td>
<?
if($checkpower=="super") {
?>
<td width="13%"  align="center"><b>编辑</b></td>
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
		  	     if($use[3]!=low) {$qx="<font color=red>冻结帐户</font>";}
				 else $qx="普通用户";}
				  else $qx="高级用户";} else $qx="系统管理员";				  
				  if($use[3]!="ice") $mx="<a href=javascript:void(1) onClick=\"window.open ('writemail.php?recname=$use[1]','','top=100,left=0,width=700,height=465,status=no,resizable=yes,scrollbars=yes');\" title=\"向 $use[7] 发送消息\"><img src=images/mail.gif border=0></a>";else $mx="<img src=images/fol-over.jpg title=被冻结的帐户无法接收消息 border=0>";
                echo "<tr><td height=20 align=center>$use[1]</td>
<td align=center>$use[7]</td><td align=center>$use[5]</td><td align=center>$use[6]</td><td align=center><a href=mailto:$use[8]?subject=hi,$use[7]>$use[8]</a></td><td align=center>$qx</td><td align=center> $mx<td align=center>$use[10]</td>";
if($checkpower=="super") {
echo"<form action=edituser.php method=post><input type=hidden name=oldname value=$use[1]><td align=center><input name=Submit title=修改 $use[7] 的资料  type=image src=images/write.gif border=0> <a href=?action=del&oldname=$use[1] OnClick=\"JavaScript: if(confirm('确实要删除用户 $use[7] 吗？')) return true; else return false\";><img src=images/fol-over.jpg title=删除 $use[7] border=0></a></td></form>";}


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
if ($total<=1) echo "&nbsp;共有  <font color=red><b>$posts</b></font> 个文件 | 只有一页  </a>";
else { 
      $nextpage=$page+1;
      $previouspage=$page-1;
	  echo " 共有 <font color=red><b>$posts</b></font> 个文件 | ";
	  if ($page<=1) echo " 首页　上一页　<a href=?page=$nextpage>下一页</a>　<a href=?page=$total>尾页</a> ";
	  elseif($page>=$total) echo " <a href=?>首页</a>　<a href=?page=$previouspage>上一页</a>　下一页</a>　尾页 ";
	 else echo " <a href=?>首页</a>　<a href=?page=$previouspage>上一页</a>　<a href=?page=$nextpage>下一页</a>　<a href=?page=$total>尾页</a> ";
	  echo " | <font color=red>$page</font>/$total  <font color=red> $number</font> 条/页 | 转到 <select name='page' size='1' style=\"border: 1px solid #429234; background-color: #FAFDF9\" onChange='javascript:submit()'>";
	for ($j=1; $j<=$total; $j++) {echo "<option value='".$j."'>第".$j."页</option>";
	}
	echo "</select>";
}
?>