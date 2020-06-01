<?
$title="分类管理";
$thisprog="ml.php";
require("global.php");
echo"<title>$title / $xtm</title>";
if($checkpower==low) {
echo"<br><center><font size=4 color=red>抱歉，您没有此权限</font><br><br>如有疑问请联系：$new_info[8] 电话：$new_info[2]</p>";    
exit;
}
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
extract($_POST);  
if($_POST['ac']=="t")
{     
    $page=$_POST['page'];
	}
	else $page=$_GET['page'];
	if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=15;
if($_POST['actions']=="edit"){    
	$name=$_POST['name'];
	$id=$_POST['id'];
	$url=$_POST['url'];
}
if ($actions=="edit")  {
$book="$mydata/ml.dat";
function safe_convert($s) {
        $s=str_replace("|","│",$s);
        $s=str_replace("<","&lt;",$s);
        $s=str_replace(">","&gt;",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        $s=str_replace("\n","<br>",$s);
        $s=str_replace(" ","&nbsp;",$s);
        return $s;          }

 $name=trim($name);
 $name=safe_convert($name);
 $url=trim($url);
 $url=safe_convert($url);
 $id=trim($id);
 $id=safe_convert($id);
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
$err="<meta http-equiv=refresh content=0;url=../><?exit;?>";
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
if(!($id==$larray[1])){@fwrite($fp,$garray[$i]);}
else{
$xinxi=array($err,$larray[1],$name,$settime,$_SERVER[REMOTE_ADDR],$username);
$garray[$i] = implode("|", $xinxi)."|\r\n";
@fwrite($fp,$garray[$i]);
}
}
@fclose($fp);
echo "<script>alert(\"修改成功！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
exit;
}

$id=$_GET['id'];
if ($_REQUEST[id])  {
$book="$mydata/ml.dat";
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if(!($id==$larray[1])){@fwrite($fp,$garray[$i]);}
}
@fclose($fp);
}
if ($_REQUEST[id])  {
$book="$mydata/wj.dat";
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($id==$larray[10]){
if(file_exists("$file/$larray[2]")) unlink("$file/$larray[2]");
}
if(!($id==$larray[10])){
@fwrite($fp,$garray[$i]);}
}
@fclose($fp);
echo "<script>alert(\"删除成功！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";


exit;}
?>	<center>
   <table border="0" cellspacing="0" width="98%" cellpadding="0">
    <tr>
      <td width="100%">
  <table border="0" cellpadding="3" cellspacing="1" width="100%">
    <form method="post" action="">
    <input type="hidden" name="action" value="addto">
    <tr>
<td colspan="5" bgcolor="#FFFFFF"><div align="center"><font color="#FF6600" face=verdana size=3><b><?=$title?></b></font> &nbsp;&nbsp;<a href="javascript:history.go(0)">刷新</a></div></td>
      </tr>
    <tr>
      <td width="128" bgcolor="#DAEFE1"><div align="right"><font color=red>添加</font></div></td>
      <td width="120" bgcolor="#DAEFE1"><div align="right">分类名称</div></td>
      <td width="171" bgcolor="#DAEFE1"><input type="text" size="20" maxlength="16" name="name"></td>
      <td width="897" bgcolor="#DAEFE1"><input type="submit" value="提交" class=button name="submit">&nbsp;
      <input type="reset" value="重写" class=button  name="reset"></td></tr>
    </form></table></td></tr></table><br><table width="98%">
       <tr>
<td width="100%" colspan="7" bgcolor="#FFFFFF"><div align="center"><font color="#FF6600" size="3" face="verdana">以下为已经存在的分类</font></div></td>
      </tr>
    <tr>
      <td bgcolor="#DAEFE1"><?
		  if (file_exists("$mydata/ml.dat"))	
{
$message_list=@file("$mydata/ml.dat");
$countnum=count($message_list);
$list_soft='';
$count=$countnum;
if($count!=0){
 if ($count%$perpage==0) $maxpageno=$count/$perpage;
		else $maxpageno=floor($count/$perpage)+1;
	if ($page>$maxpageno) $page=$maxpageno;
	$pagemin=min( ($page-1)*$perpage , $count-1);
	$pagemax=min( $pagemin+$perpage-1, $count-1);
	for ($i=$pagemin; $i<=$pagemax; $i++) {
$message_list=@file("$mydata/ml.dat");
$detail=explode("|",$message_list[$i]);	 
?><table width="100%" border="0" cellpadding="3" cellspacing="1" >
  <tr>
      <form method="post" action="" name="Action" id=Action>
    <input type="hidden" name="actions" value="edit">  <td width="49"><div align="left">
        <div align="right">分类名</div><input type="hidden" name="id" value="<?=$detail[1]?>">
      <td width="118" bgcolor="#DAEFE1"><input type="text" size="20" maxlength="16" name="name" value="<?=$detail[2]?>"></td>
      <td width="52" bgcolor="#DAEFE1"><div align="right">编号</div></td>
      <td width="140" bgcolor="#DAEFE1"><?=$detail[1]?></td>
      <td width="52" bgcolor="#DAEFE1"><div align="right">编辑</div></td>
      <td width="140" bgcolor="#DAEFE1"><?=$detail[5]?></td>
      <td width="47" bgcolor="#DAEFE1">时间</td>
      <td width="166" bgcolor="#DAEFE1"><?=$detail[3]?></td>
      <td width="326" bgcolor="#DAEFE1">&nbsp;<input type="submit" value="修改" class=button name="submit">&nbsp;
        <input type="reset" value="还原" class=button  name="reset">&nbsp;<input type="button" value="删除" title="删除分类将删除其下的文件"" class=button onclick="javascript:window.location.href='?id=<?=$detail[1]?>'"></td></form>
  </tr>
</table>
<?
}
}}else {echo "<br><center><font color=blue>暂时没有分类";}
include"$mydata/page.php";
?></td>
    </tr>
  </table>
  <?
ob_start();
extract($_POST);
if($_POST['action'] == "addto"){       ///
	$name=$_POST['name'];
}
if($action=="addto"){
if($name=="")
{
echo "<script>alert(\"新建分类名不能为空！\");javascript:history.go(-1);</script>";
exit();
}
$book="$mydata/ml.dat";
$garray = file($book);
$cog=count($garray);
function safe_convert($s) {
        $s=str_replace("|","│",$s);
        $s=str_replace("<","&lt;",$s);
        $s=str_replace(">","&gt;",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        $s=str_replace("\n","<br>",$s);
        $s=str_replace(" ","&nbsp;",$s);
        return $s;          }
 $name=trim($name);
 $name=safe_convert($name);
$larray = explode("|",$garray[0]);
$id=$larray[1]+1;
$err="<meta http-equiv=refresh content=0;url=../><?exit;?>";
date_default_timezone_set('Asia/Shanghai');
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
$zt="ok";
$xinxi=array($err,$id,$name,$settime,$_SERVER[REMOTE_ADDR],$username);
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"分类创建成功！\");</script><meta http-equiv=refresh content=0;url=$thisprog>";
exit;}
?>;