<?
extract($_POST);
error_reporting(7);
$page=$_GET['page'];
if($_POST['ac'] == "t")
{
$page=$_POST['page'];
}
$thisprog="jl.php";
$title="������¼";
require("global.php");
if(($checkpower==low)){
echo"<br><center><font size=4 color=red>��Ǹ����û�д�Ȩ��</font><br><br>������������ϵ��$new_info[8] �绰��$new_info[2]</p>";    
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
    <b><?=$xtm?> / <?=$title?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ��¼�����ϴ���ɾ����Ϣ������<a href="filejl.php">��ת���ļ������¼</a></td>
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
          	<td width="22%" bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ʱ&nbsp;��</div></td>
          	<td width="17%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;�û�</div></td>
          	<td width="19%"  align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">&nbsp;&nbsp;IP</div></td>
          	<td width="30%" align=center bgcolor="#FFFFFF"><div align="left" class="STYLE1">����ҳ��</div></td>
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
<a href="http://<?=$ip?><?=$detail[3]?>" title="�鿴 <?=$detail[3]?> ��IP������" target=_blank><?=$detail[3]?></a>
    </div>
    <td width="30%" align=center><div align="left"><A HREF=javascript:void(1) onClick="window.open ('<?=$detail[4]?>','','top=100,left=0,width=700,height=426,status=no,resizable=yes,scrollbars=yes');"  title="�鿴<?=$detail[4];?>"><?=$detail[5];?></A></div></td> 
  </tr>
</table>
<?
}}}else echo "<br><center><font color=blue>�����û�������¼";
include"$mydata/page.php";?></td>
        </tr></form>
      </table></td>
            