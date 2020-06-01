<?
$u=$_SERVER["SERVER_NAME"] ;       
$ly="$_SERVER[HTTP_REFERER]";
$str=str_replace("http://","",$ly); 
$strdomain=explode("/",$str); 
$lyw=$strdomain[0];
if($u="$lyw"){
}else{
echo "<script>alert(\"非法进入！\");javascript:window.close();</script>";exit;}
?>
<?
$ID=$_GET['ID'];
$q=$_GET['q'];

$title="文件签收";
$thisprog="down.php?ID=$ID";
require("global.php");
echo"<title>$title / $xtm</title>";
$book="$mydata/wj.dat";
if(empty($ID)) { echo "<script>alert(\"错误的ID信息！\");javascript:window.close();</script>";exit;}
$garray = file($book);
$cog=count($garray);
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($ID==$larray[1]){
$qs=explode("│",$larray[9]);
if($checkpower==low) {
if($qs[0]!=all)  { 
echo"<script>alert(\"抱歉，您无权下载此文件！\");javascript:window.close();</script>";exit;
}
else {
		if (file_exists("$userd/$username.php"))	
{
$new_info=explode("|",readfrom("$userd/$username.php"));
$dw=$new_info[5];
$qsz=$new_info[7];
}
$book="$mydata/wj.dat";
$garray = file($book);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
$cs=$larray[8]+1;
if($larray[14]!=""){
$a=$larray[14]; 
$b=$dw; 
$c=explode($b,$a); 
if(count($c)>1){ 
  $qs=$larray[14];
} else $qs="$larray[14]&nbsp;&nbsp;&nbsp;$dw.$qsz";
} else $qs="$dw.$qsz";
date_default_timezone_set('Asia/Shanghai');
$settime=date("Y-m-d G:i:s");
if(!($ID==$larray[1])){@fwrite($fp,$garray[$i]);}
else{
$xinxi=array($larray[0],$larray[1],$larray[2],$larray[3],$larray[4],$larray[5],$larray[6],$larray[7],$cs,$larray[9],$larray[10],$username,$settime,$_SERVER[REMOTE_ADDR],$qs);
$garray[$i] = implode("|", $xinxi)."|\r\n";
@fwrite($fp,$garray[$i]);
}
echo"<meta http-equiv='Refresh' content='0; URL=$file/$larray[2]'>";
}
@fclose($fp);
}
}
else {
	
	if (file_exists("$userd/$username.php"))	
{
$new_info=explode("|",readfrom("$userd/$username.php"));
$dw=$new_info[5];
$qsz=$new_info[7];
}
$book="$mydata/wj.dat";
$garray = file($book);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
$cs=$larray[8]+1;
if($larray[14]!=""){
$a=$larray[14]; 
$b=$dw; 
$c=explode($b,$a); 
if(count($c)>1){ 
  $qs=$larray[14];
} else $qs="$larray[14]&nbsp;&nbsp;&nbsp;$dw.$qsz";
} else $qs="$dw.$qsz";
date_default_timezone_set('Asia/Shanghai');
$settime=date("Y-m-d G:i:s");
if(!($ID==$larray[1])){@fwrite($fp,$garray[$i]);}
else{
$xinxi=array($larray[0],$larray[1],$larray[2],$larray[3],$larray[4],$larray[5],$larray[6],$larray[7],$cs,$larray[9],$larray[10],$username,$settime,$_SERVER[REMOTE_ADDR],$qs);
$garray[$i] = implode("|", $xinxi)."|\r\n";
@fwrite($fp,$garray[$i]);
}
echo"<meta http-equiv='Refresh' content='0; URL=$file/$larray[2]'>";
}
@fclose($fp);
}
}}
?>