<?
extract($_POST);
error_reporting(7);
$page=$_GET['page'];
if($_POST['ac'] == "t")
{
$page=$_POST['page'];
}
$thisprog="jl.php";
$title="操作记录";
require("global.php");
if(($checkpower==low)){
echo"<br><center><font size=4 color=red>抱歉，您没有此权限</font><br><br>如有疑问请联系：$new_info[8] 电话：$new_info[2]</p>";    
exit;
}
echo"<title>$title / $xtm</title>";
if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=35;
?>
<style type="text/css">
<!--
.STYLE1 {color: #0099CC}
-->
</style>
<tr><td bgcolor=#CBDED8 colspan=3>
    <b><?=$xtm?> / <?=$title?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 记录附件上传、删除信息——＞<a href="filejl.php">跳转至文件管理记录</a></td>
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
          <tr bgcolor="#FFFFFF">
            <td width="2%" bgcolor="#FFFFFF">&nbsp;</td>        
<hr size="1" noshade align="center" width="100%"> 
          	<td width="22%" bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时&nbsp;间</div></td>
          	<td width="17%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;用户</div></td>
          	<td width="19%"  align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;IP</div></td>
          	<td width="30%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">操作页面</div></td>
          </tr>
          </table></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF">
<?
if (file_exists("$jl/leasin.php")) 
{
$message_list=@file("$jl/leasin.php");
$countnum=count($message_list);
$list_soft='';
$count=$countnum;
if($count!=""){
 if ($count%$perpage==0) $maxpageno=$count/$perpage;
		else $maxpageno=floor($count/$perpage)+1;
	if ($page>$maxpageno) $page=$maxpageno;
	$pagemin=min( ($page-1)*$perpage , $count-1);
	$pagemax=min( $pagemin+$perpage-1, $count-1);
	for ($i=$pagemin; $i<=$pagemax; $i++) {
$detail=explode("|",$message_list[$i]);
$title="$detail[4]";
if (strlen($detail[4])>=36) $detail[4]=substr($detail[4],0,34)." ...";

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%" bgcolor="#FFFFFF">     
      <div align="left">
    <td width="22%" align=center><div align="left"><span>
      <?=$detail[1]?>
      </span>
    </div>
    <td width="17%" align=center><div align="left">
      <?=$detail[2];?>
    </div>
    <td width="19%" align=center><div align="left">
<a href="http://<?=$ip?><?=$detail[3]?>" title="查看 <?=$detail[3]?> 的IP归属地" target=_blank><?=$detail[3]?></a>
    </div>
    <td width="30%" align=center><div align="left"><A HREF=javascript:void(1) onClick="window.open ('<?=$detail[4]?>','','top=100,left=0,width=700,height=426,status=no,resizable=yes,scrollbars=yes');"  title="查看<?=$detail[4];?>"><?=$detail[5];?></A></div></td> 
  </tr>
</table>
<?
}}}else echo "<br><center><font color=blue>暂无用户操作记录";
include"$mydata/page.php";?></td>
        </tr></form>
      </table></td>
            