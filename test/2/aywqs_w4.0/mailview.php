<? 
$thisprog="mailview.php";
$title="查看消息";
require("global.php");
$id=$_GET["id"]; 
if(empty($id)) { echo "<script>alert(\"错误的ID信息！\");javascript:history.go(-1);</script>";exit;}
echo"<title>$title / $xtm</title>";
if (file_exists("$mail/".$username.".php"))	
{
$book="$mail/".$username.".php";
$garray=@file($book);
$cog=count($garray);
$fp=@fopen($book,"w+");
for($i=0;$i<$cog;$i++){
$larray = explode("|",$garray[$i]);
if(!($id==$larray[1])){@fwrite($fp,$garray[$i]);}
else{
$xinxi=array($larray[0],$larray[1],$larray[2],$larray[3],$larray[4],$larray[5],old,$larray[7]);
$garray[$i] = implode("|", $xinxi)."|\r\n";
@fwrite($fp,$garray[$i]);
}
}
@fclose($fp);
}
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
?>
    <center>
   <?
$book="$mail/".$username.".php";
$garray = file($book);
$cog=count($garray);
for($i=0;$i<$cog;$i++){
$mail= explode("|",$garray[$i]);
if($id==$mail[1]){
?><table width="95%">
       <tr>
<td width="100%" height="31" colspan="7" bgcolor="#FFFFFF"><div align="center"><font color="#FF6600" size="4" face="verdana"><strong><?=$title?></strong></font></div></td>
      </tr>

<table width="80%" border="1" cellspacing="0" cellpadding="0">           <tr>
            <td height="30" colspan="2" bgcolor="#DAEFE1"><div align="center"><a href="javascript:void(3)" onClick="window.open ('writemail.php?recname=<?=$mail[3]?>','','top=100,left=0,width=700,height=465,status=no,resizable=yes,scrollbars=yes');" title="给 <?=$mail[3]?> 回信"><img src="images/mail.gif" border=0 height="18"></a>&nbsp;&nbsp; <a href="delmail.php?id=<?=$mail[1]?>" onClick="JavaScript: if(confirm('确实要删除该条消息吗？')) return true; else return false;"><img src="images/fol-over.jpg" border=0 height="18" title="删除"></a>&nbsp;&nbsp; <a href="sitemail.php">返回列表</a> </div></td>
          </tr>
          <tr>
            <td width="20%" height="31" bgcolor="#DAEFE1"><div align="right">发 送 方&nbsp;</div></td>
            <td width="80%" bgcolor="#DAEFE1">&nbsp;
              <?=$mail[3]?>
&nbsp;
<? if($mail[7]=="sys")echo"[<font color=#FF0000>系统消息</font>]";?></td>
          </tr>
          <tr>
            <td height="30" bgcolor="#DAEFE1"><div align="right">短信标题&nbsp;</div></td>
            <td bgcolor="#DAEFE1"><table width="100%" border="0">
                <tr>
                  <td width="2%">&nbsp;</td>
                  <td width="98%"><font color="#FF9933">
             <font color="#3399FF">
            <?=$mail[4]?>
            </font>
                  </font></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td height="65" bgcolor="#DAEFE1"><div align="right">消息内容&nbsp;</div></td>
            <td bgcolor="#DAEFE1">
              <table width="100%" border="0">
                <tr>
                  <td width="2%">&nbsp;</td>
                  <td width="98%"><font color="#FF9933">
                    <?=$mail[5]?>
                  </font></td>
                </tr>
            </table></td>
     </tr>
          <tr>
        <td></td>
        <?
	  <<<EOD
EOD;
}
}
?>
      </tr>
    </table>
