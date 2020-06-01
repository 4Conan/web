<?
extract($_POST);
$page=$_GET['page'];
if($_POST['ac'] == "t")
{
$page=$_POST['page'];
}
$thisprog="filejl.php";
$title="文件管理记录";
require("global.php");
if(($checkpower==low)){
echo"<br><center><font size=4 color=red>抱歉，您没有此权限</font><br><br>如有疑问请联系：$new_info[8] 电话：$new_info[2]</p>";    
exit;
}
echo"<title>$title / $xtm</title>";
if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=25;
?>
<style type="text/css">
<!--
.STYLE1 {color: #6699CC}
-->
</style>
<tr><td bgcolor=#CBDED8 colspan=3>
    <b><?=$xtm?> / <?=$title?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 记录所有用户的操作信息——＞<a href="jl.php">跳转至安全日志</a></td>
<table  class="zbk2" cellSpacing="0" cellPadding="0" width="90%" align="center" border="0" height="120">
                          <tr>
                            <td vAlign="top" height="120" width="90%" align="center"><table cellSpacing="0" cellPadding="0" border="0" >
                                <tbody>
                                  <tr>
                                    <td height="120" valign="top" width="794" ><table cellSpacing="3" cellPadding="0" width="100%" align="center" bgColor="#ffffff" border="0"    height="72">
                                        <tbody>
                                          <tr>
                                            <td class="2" width="90%" valign="top" height="64"> <table class="leasin" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#FFFFFF" height="20">
<table width="101%" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#FFFFFF" align="center">           
<hr size="1" noshade align="center" width="100%"> <td width="2%" bgcolor="#FFFFFF">&nbsp;</td>
<td width="19%" bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时&nbsp;间</div></td>
          	<td width="11%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;用户</div></td>
          	<td width="17%"  align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;IP</div></td>
          	<td width="41%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">附件名称(上传<font color="blue">＋</font>/替换<font color="blue">#</font>/删除<font color="red">－</font>)绿色表示不存在</div></td>
          </tr>
          </table></td>
        </tr>
		
        <tr>
          <td bgcolor="#FFFFFF" >
<?
if (file_exists("$jl/leasin1.php")) 
{
$message_list=@file("$jl/leasin1.php");
$countnum=count($message_list);
$count=$countnum;
if($count!=0){
 if ($count%$perpage==0) $maxpageno=$count/$perpage;
		else $maxpageno=floor($count/$perpage)+1;
	if ($page>$maxpageno) $page=$maxpageno;
	$pagemin=min( ($page-1)*$perpage , $count-1);
	$pagemax=min( $pagemin+$perpage-1, $count-1);
	for ($i=$pagemin; $i<=$pagemax; $i++) {
	 $detail=explode("|",$message_list[$i]);
$ck="<font color=blue>+</font>";
if(strlen($detail[5])>=36) {
if (strlen($detail[5])%2==0) $detail[5]=substr($detail[5],0,34)."...";
else $detail[5]=substr($detail[6],0,33)."...";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <div align="left">
    <td width="22%" height="20" bgcolor="#FFFFFF"><div align="left">&nbsp;&nbsp;
      <?=$detail[1]?>
    </div>
    <td width="13%" align=center><div align="left"><span>
      <?=$detail[2]?>
      </span>
    </div>
    <td width="19%" align=center><div align="left">
      <a href="http://<?=$ip?><?=$detail[3]?>" title="查看 <?=$detail[3]?> 的IP归属地" target=_blank><?=$detail[3]?></a>
    </div>
    <td width="43%" align=center><div align="left">
<?	if (file_exists("$file$detail[5]")) 
{ echo"$detail[4] <A HREF=javascript:void(1) onClick=\"window.open ('$file$detail[5]','','top=100,left=0,width=650,height=503,status=no,resizable=yes,scrollbars=yes');\" title=\"查看 $detail[6]\">$detail[6]</A>";
}else echo"$detail[4] <font color=#009933 title=该文件已经不存在>$detail[6]</font>";?>
</div></td> 
  </tr>
</table>
<?
}
}}else {echo "<br><center><font color=blue>暂无文件管理记录";}
include"$mydata/page.php";
?></td>
        </tr></form>
      </table></td>
