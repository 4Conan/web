<? 
ob_start();
$title="文件编辑";
$ID=$_GET["ID"];
$thisprog="edit.php?ID=$ID";
require("global.php");
echo"<title>$xtm / $title</title>"; 
if($checkpower==low) {
echo"<br><center><font size=4 color=red>抱歉，您没有此权限</font><br><br>如有疑问请联系：$new_info[8] 电话：$new_info[2]</p>";    
exit;
}
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
$book="$mydata/wj.dat";
if($_POST['ac']=="t")
{
    $page=$_POST['page'];
	$action=$_POST['action'];
	$name=$_POST['name'];
	$ID=$_POST['ID'];
	$url=$_POST['url'];
	$ms=$_POST['ms'];
	$bt=$_POST['bt'];
	$qx=$_POST['qx'];
	$ml=$_POST['ml'];
	}
$book="$mydata/wj.dat";
if ($action==edit)  {  
function safe_convert($s) {
        $s=str_replace("|","│",$s);
        $s=str_replace("<","&lt;",$s);
        $s=str_replace(">","&gt;",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        $s=str_replace("\n","<br>",$s);
        $s=str_replace(" ","&nbsp;",$s);
        return $s;          }
 $ms=trim($ms);
 $ms=safe_convert($ms);
 $bt=trim($bt);
 $bt=safe_convert($bt);
 $qx=trim($qx);
 $qx=safe_convert($qx);
 $qx=trim($qx);
 $qx=safe_convert($qx);
 $ml=trim($ml);
 $ml=safe_convert($ml);
if($bt=="")
{
echo "<script>alert(\"标题不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if($ms=="")
{
echo "<script>alert(\"文件描述不能为空！\");javascript:history.go(-1);</script>";
exit();
}

if(strlen($ms)>100){
echo "<script>alert(\"文件标题太长！\");javascript:history.go(-1);</script>";
exit();
}
if(strlen($ms)>500){
echo "<script>alert(\"文件描述太长！\");javascript:history.go(-1);</script>";
exit();
}
if($qx=="")
{
echo "<script>alert(\"请认真选择访问权限！谢谢！\");javascript:history.go(-1);</script>";
exit();
}
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if(!($ID==$larray[1]))
{@fwrite($fp,$garray[$i]);}
else{
if($ml=="leasin") $fw=$larray[10];else $fw=$ml;
$xinxi=array($larray[0],$ID,$larray[2],$bt,$ms,$settime,$_SERVER[REMOTE_ADDR],$username,$larray[8],$qx,$fw,$larray[11],$larray[12],$larray[13],$larray[14]);
$garray[$i] = implode("|", $xinxi)."|\r\n";
@fwrite($fp,$garray[$i]);
}
}
@fclose($fp);
echo "<script>alert(\"修改成功！\");</script><meta http-equiv=refresh content=0;url=wj.php>";
exit;
}
$idel=$_GET['idel'];
$na=$_GET['na'];
if ($_REQUEST[idel])  {
$book="$mydata/wj.dat";
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($idel==$larray[1]){
if(file_exists("$file$larray[2]")) unlink("$file$larray[2]");
}
if(!($idel==$larray[1])){@fwrite($fp,$garray[$i]);}
}
@fclose($fp);
$bookb=$jl."leasin1.php";
$garray = file($bookb);
$err="<meta http-equiv=refresh content=0;url=../><?exit;?>";
$cog=count($garray);
$delline=100; //操作记录容量
if ($cog>=100) {
include("$mydata/mydel.php");
}
$lat = explode("|",$garray[0]);
$xinxi=array($err,$settime,$username,$_SERVER[REMOTE_ADDR],"<font color=red>-</font>",0,"$na");
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($bookb,"r+");
$msg = fread($f,filesize($bookb));
fclose($f);
$fp=@fopen($bookb,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"删除成功！\");</script><meta http-equiv=refresh content=0;url=wj.php>";
exit;}
$garray = file($book);
$cog=count($garray);
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($ID==$larray[1]){
 $larray[4]=str_replace('%a%','',$larray[4]);
 $larray[4]=str_replace("<br>","\r\n",$larray[4]);
 $larray[4]=str_replace('%a%','',$larray[4]);
 $larray[4]=str_replace("<br>","\r\n",$larray[4]);
?>      
</td>    
 <td><form method="post" action="">
              <input type="hidden" name="action" value="edit"><input type="hidden" name="ac" value="t">
              <input type="hidden" name="ID" value="<?=$larray[1]?>"><div align="center">
   <table border="0" cellpadding="3" cellspacing="1" width="100%">
    <tr>
      <td height="45" colspan="2"><div align="center"><font color="#FF6600" face=verdana size=3><b><?=$title?></b></font></div></td>
      </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">标  题：</div></td>
      <td bgcolor="#DAEFE1"><input type="text" size="62" name="bt" value="<?=$larray[3]?>""> <font color="#FF0000">(100字符)</font> </td>
    </tr><tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">说  明：</div></td>
      <td bgcolor="#DAEFE1"><textarea name="ms" rows="5" cols="60"><?=$larray[4]?></textarea> <font color="#FF0000">(500字符)</font></td>
    </tr>
    <tr>
  <td height="34" bgcolor="#DAEFE1"><div align="right">访问权限</div></td>
      <td bgcolor="#DAEFE1"><font color="#3300FF"><? $dl=explode("│",$larray[9]);	
unset($qx1);unset($qx2);if($dl[0]==all) $qx1='selected';else  $qx2='selected';?></font>
        <select name="qx"><option value="all│所有用户" <?=$qx1?>>所有用户</option><option value="high│高级用户" <?=$qx2?>>高级用户</option></select>  </td>
    </tr>
    <tr>
    <td height="45" bgcolor="#DAEFE1"><div align="right">所属分类</div></td>
      <td bgcolor="#DAEFE1"><font color="#3300FF"><? $djl=explode("│",$larray[10]);	 echo"$djl[1]";?>
      </font>改为
        <select name="ml">   <option value="leasin">不改不选</option>
          <?
if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=1000;
if (file_exists("$mydata/ml.dat")) 
{
$message_list=@file("$mydata/ml.dat");
$countnum=count($message_list);
$count=$countnum;
if($count!=""){
 if ($count%$perpage==0) $maxpageno=$count/$perpage;
		else $maxpageno=floor($count/$perpage)+1;
	if ($page>$maxpageno) $page=$maxpageno;
	$pagemin=min( ($page-1)*$perpage , $count-1);
	$pagemax=min( $pagemin+$perpage-1, $count-1);
	for ($i=$pagemin; $i<=$pagemax; $i++) {
	 $der=explode("|",$message_list[$i]);
?>
          <option value="<?=$der[1]?>│<?=$der[2]?>"><?=$der[2]?></option>
          <? }}}?>
      </select></td>
    </tr>
 <tr>
        <td height="40" bgcolor="#DAEFE1"><div align="right"><strong>替换文件</strong></div></td>
        <td bgcolor="#DAEFE1"><a href="javascript:void(0)" onClick="window.open ('upnew.php?ID=<?=$ID?>','','top=0,left=0,width=700,height=363,status=no,resizable=yes,scrollbars=yes');" title="替换文件 <?=$ID?>">替换此文件附件</a></td>
      </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1">&nbsp;</td>
      <td bgcolor="#DAEFE1">
              <input type="submit" value="修改" class=button name="submit" />
<? echo"<input type=button value=删除 class=button onclick=\"javascript:window.location.href='?idel=$ID&na=$larray[3]'\">";?>      </td>
    </tr>
  </table>
</form>
</td>
  </tr>
<?
<<<EOD
EOD;
}
}
?>