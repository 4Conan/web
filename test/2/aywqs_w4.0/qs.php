<? 
ob_start();
$title="�ļ��鿴";
$ID=$_GET["ID"]; 
$thisprog="qs.php?ID=$ID";
require("global.php");
if(empty($ID)) { echo "<script>alert(\"�����ID��Ϣ��\");javascript:window.close();</script>";exit;}
echo"<title>$xtm / $title</title>"; 
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
$book="$mydata/wj.dat";
$garray = file($book);
$cog=count($garray);
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if($ID==$larray[1]){
?>      
</td>    
 <td><div align="center">
   <table border="0" cellpadding="3" cellspacing="1" width="100%">
    <tr>
      <td height="45" colspan="2"><div align="center"><font color="#FF6600" face=verdana size=3><b>
        <?=$title?>
      </b></font></div></td>
      </tr>
    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">��  �⣺</div></td>
      <td bgcolor="#DAEFE1"><?=$larray[3]?><?=$dw?></td>
    </tr>    <tr>
      <td height="45" bgcolor="#DAEFE1"><div align="right">˵  ����</div></td>
      <td bgcolor="#DAEFE1"><?=$larray[4]?></td>
    </tr>
    <tr>
      <td width="370" height="45" bgcolor="#DAEFE1"><div align="right">����ʱ�䣺</div></td>
      <td width="1006" bgcolor="#DAEFE1"><?=$larray[5]?></td>
    </tr>
    <tr>
<?	
if (file_exists("$userd/$username.php"))	
{
$new_info=explode("|",readfrom("$userd/$username.php"));
$dw=$new_info[5];
} 
$a=$larray[14]; 
$b=$dw; 
$c=explode($b,$a); 
if(count($c)>1){ 
$ts="���Ѿ�ǩ�չ����ļ���ȷ��Ҫ������";
} else $ts="ȷ��Ҫǩ�մ��ļ���";
?>        <td width="370" height="45" bgcolor="#DAEFE1"><div align="right">��ǩ�գ�</div></td>
      <td width="1006" bgcolor="#DAEFE1"><?=$larray[14]?></td>
    </tr>
    <tr>
    <td width="370" height="45" bgcolor="#DAEFE1"><div align="right">ǩ�մ��ļ���</div></td>
      <td width="1006" bgcolor="#DAEFE1"><a href="down.php?ID=<?=$larray[1]?>"><img src="images/qs.gif" border="0"></a>
</td>
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
</td>
  </tr>
<?
<<<EOD
EOD;
}
}
?>