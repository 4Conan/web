<? 
ob_start();
$title="替换文件";
$thisprog="upnew.php";
require("global.php");
echo"<title>$title / $xtm</title>";
if(($checkpower!=super)&($checkpower!=high)){
echo "<script>alert(\"抱歉，您所在的用户组没有该权限！\");javascript:history.go(-1);</script>";
exit;}
$ID=$_GET["ID"]; 
if(empty($ID)) { echo "<script>alert(\"错误的ID信息！\");javascript:window.close();</script>";exit;}
echo"<title>$xtm / $title</title>"; 
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm/ $title</b> </td></tr>";
$book="$mydata/wj.dat";
$garray = file($book);
$cog=count($garray);
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($ID==$larray[1]){
$fname=$larray[2];
$filen=$larray[3];
$l2=explode('.',$fname);
?>      
</td>     <form enctype="multipart/form-data" action="" method="post"> <input type="hidden" name="action" value="edit">
 <td><div align="center">
   <table border="0" cellpadding="3" cellspacing="1" width="100%">
    <tr>
      <td height="45" colspan="2"><div align="center"><font color="#FF6600" face=verdana size=3><b>
        <?=$title?>
      </b></font></div></td>
      </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">原文件(格式)</div></td>
      <td bgcolor="#DAEFE1">&nbsp;<?=$filen?>(<font color="blue"><b><?=$l2[1]?></b></font>)</td>
    </tr>
    <tr>
      <td width="370" height="45" bgcolor="#DAEFE1"><div align="right">替换文件</div></td>
      <td width="1006" bgcolor="#DAEFE1">&nbsp; <input name="upload_file" size=35 type="file"> <input type="submit" value="替换" class=button> </td>
    </tr>
    <tr>
	      <td colspan="6" align="center" bgcolor="#DAEFE1">
	<table border="0" width="100%" id="table1" cellspacing=0>
	  <tr><td  width="27%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%">  
    <td width="85%" colspan="2">
      </table>  
</td></table></td>
    </tr>
  </table>
<br>
</form>
</td>
  </tr>
<?
<<<EOD
EOD;
}
}
$upload_file=$_FILES['upload_file']['tmp_name'];
$upload_file_name=$_FILES['upload_file']['name'];
if($upload_file){
$l1=explode(".",$upload_file_name);
if($l1[1]!=$l2[1]){
echo "<script>alert(\"上传文件与原文件类型不符！\");javascript:history.go(-1);</script>";
exit();
}
$file_size_max = 10000*10000;
$store_dir = "$file";
$accept_overwrite = 1;
if ($upload_file_size > $file_size_max) {
echo "抱歉，您的文件太大";
exit;
}
if (!move_uploaded_file($upload_file,$store_dir.$fname)) {
echo "上传失败";
exit;
}
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
$settime=date("Y-m-d G:i:s");
$xinxi=array($err,$settime,$username,$_SERVER[REMOTE_ADDR],"<font color=blue>#</font>",$fname,$filen);
$newguest = implode("|", $xinxi)."|\r\n";
$f = fopen($book,"r+");
$msg = fread($f,filesize($book));
fclose($f);
$fp=@fopen($book,"w+");
@fwrite($fp,$newguest.$msg);
@fclose($fp);
echo "<script>alert(\"替换文件成功！\");javascript:window.close();</script>";exit;
}

?>