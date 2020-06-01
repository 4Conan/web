<?
$thisprog="upfile.php";
$title="发布文件";
require("global.php");
if(($checkpower!=super)&($checkpower!=high)){
echo "<script>alert(\"抱歉，您所在的用户组没有该权限！\");javascript:window.close();</script>";
exit;}
echo"<title>$title / $xtm</title>";
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
$path_parts=pathinfo($_SERVER['PHP_SELF']); //取得当前路径
$destination_folder="$file"; //上传文件路径
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body>
<center><form enctype="multipart/form-data" method="post" name="upform" action="<?=$thisprog?>"><input type="hidden" name="ac" value="t">
  <table border="0" cellpadding="3" cellspacing="1" width="100%">
    <tr>
      <td colspan="5" bgcolor="#DAEFE1"><div align="center"><font color="#FF6600" face=verdana size=3>
   <b> 上传文件</b></font></div></td>
    </tr>
    <tr>
      <td bgcolor="#DAEFE1"><div align="right">标题</div></td>
      <td width="1099" bgcolor="#DAEFE1">&nbsp;<input type="text" name="picbt" size="50" maxlength="100"> 
        <font color="#FF0000">(100字符)</font> </td>
    </tr>
    <tr>
      <td width="260" height="45" bgcolor="#DAEFE1"><div align="right">文字描述</div></td>
      <td bgcolor="#DAEFE1">&nbsp;<textarea name="picsm" rows="6" cols="48"></textarea>
      <font color="#FF0000">(500字符)</font></td>
    </tr>    <td height="34" bgcolor="#DAEFE1"><div align="right">访问权限</div></td>
      <td bgcolor="#DAEFE1">&nbsp;<select name="qx"><option value="all│所有用户">所有用户</option><option value="high│高级用户">高级用户</option>
</select>  </td>
    </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">所属分类</div></td>
      <td bgcolor="#DAEFE1">&nbsp;
        <select name="ml">
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
	 $detail=explode("|",$message_list[$i]);

?>
          <option value="<?=$detail[1]?>│<?=$detail[2]?>"><?=$detail[2]?></option>
          <? }}}?>
        </select></td>
    </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">文件</div></td>
      <td bgcolor="#DAEFE1">&nbsp;<input style="width:350;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" size="45" name=upfile type=file onChange="javascript:FileChange(this.value);">        <input name="submit" type="submit" class=button style="width:40;border:1 solid #9a9999; font-size:9pt; background-color:#ffffff; height:18" value="上传" size="17"></td>
    </tr>
    <tr>
	      <td colspan="6" align="center" bgcolor="#DAEFE1">
	<table border="0" width="100%" id="table1" cellspacing=0>
	  <tr><td  width="27%">
<br>
</form>
<?php

if($_POST['ac']=="t"){
   $picbt=$_POST['picbt'];
      $picsm=$_POST['picsm'];
	    $qx=$_POST['qx'];
	    $ml=$_POST['ml'];
if($picbt=="")
{
echo "<script>alert(\"标题不能为空！\");javascript:history.go(-1);</script>";
exit();
}

if(strlen($picbt)>100){
echo "<script>alert(\"标题太长！\");javascript:history.go(-1);</script>";
exit();
}
if($picsm=="")
{
echo "<script>alert(\"文字描述不能为空！\");javascript:history.go(-1);</script>";
exit();
}
if(strlen($picsm)>500){
echo "<script>alert(\"文字描述太长！\");javascript:history.go(-1);</script>";
exit();
}
}
function safe_convert($s) {
        $s=str_replace("|","│",$s);
        $s=str_replace("<","&lt;",$s);
        $s=str_replace(">","&gt;",$s);
        $s=str_replace("\r","",$s);
        $s=str_replace("\t","",$s);
        $s=str_replace("\n","<br>",$s);
        $s=str_replace(" ","&nbsp;",$s);
        return $s;          }
$picbt=trim($picbt);
$picbt=safe_convert($picbt);
$picsm=trim($picsm);
$picsm=safe_convert($picsm);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
{
echo "<script>alert(\"文件不存在！\");javascript:history.go(-1);</script>";
exit;
} $file = $_FILES["upfile"];
 if($max_file_size < $file["size"])
 {
 echo "<script>alert(\"文件太大！\");javascript:history.go(-1);</script>";
 exit;
  }
if(!in_array($file["type"], $uptypes))
{
 echo "<script>alert(\"文件类型不允许！\");javascript:history.go(-1);</script>";
 exit;
}
if(!file_exists($destination_folder))
mkdir($destination_folder);
$filename=$file["tmp_name"];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo[extension];
$destination = $destination_folder.time().".".$ftype;
if (file_exists($destination) && $overwrite != true)
{
echo "<script>alert(\"文件不存在！\");javascript:history.go(-1);</script>";
exit;
}
if(!move_uploaded_file ($filename, $destination))
{
echo "<script>alert(\"上传出错！\");javascript:history.go(-1);</script>";
exit;
}
$pinfo=pathinfo($destination);
$fname=$pinfo[basename];
$phu="$fname";
$ph="$mydata/wj.dat";
$garray = file($ph);
$cog=count($garray);
$larray = explode("|",$garray[0]);
$id=$larray[1]+1;
if (file_exists("$userd/$username.php"))	
{
$new_info=explode("|",readfrom("$userd/$username.php"));
$dw=$new_info[5];
$qsz=$new_info[7];
$qs="$dw.$qsz";
}
$err="<meta http-equiv=refresh content=0;url=http://www.21573.com><?exit;?>";
date_default_timezone_set('Asia/Shanghai');$settime=date("Y-m-d G:i:s");
$xinxi=array($err,$id,$phu,$picbt,$picsm,$settime,$_SERVER[REMOTE_ADDR],$username,1,$qx,$ml,$settime,$settime,1,$qs);
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($ph,"r+");
$msg = fread($f,filesize($ph));
fclose($f);
$fp=@fopen($ph,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
$book=$jl."/leasin1.php";
$garray = file($book);
$err="<meta http-equiv=refresh content=0;url=../><?exit;?>";
$cog=count($garray);
$delline=100; 
if ($cog>=100) {
include("$mydata/mydel.php");
}
$larray = explode("|",$garray[0]);
date_default_timezone_set('Asia/Shanghai');
$xinxi=array($err,$settime,$username,$_SERVER[REMOTE_ADDR],"<font color=blue>＋</font>",$fname,$picbt);
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"发布文件成功！\");javascript:window.close();</script>";exit;
}
?>