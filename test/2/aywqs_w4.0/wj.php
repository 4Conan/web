<?
$thisprog="wj.php";
$title="文件列表";
require("global.php");
echo"<title>$title / $xtm</title>";
$page=$_GET['page'];
function get_pid() {
global $pid,$mlm,$nckeckid;
$nckeckid=0;
	$count=count($list);
	for ($i=0; $i<$count; $i++) {
		$detail=explode("|", trim($list[$i]));
		if ($detail[1]==$pid) {
			$mlm=$detail[2];
			$nckeckid=1;
			break;
		}
	}
}
$pid=$_GET['pid'];
if($_POST['ac'] == "t")
{   	$page=$_POST['page'];
}
if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=10;
get_pid();
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
?><center>
<table  cellSpacing="0" cellPadding="0" width="95%" align="center" border="0" height="193">
    <tr>
    <td vAlign="top" height="53"><br>
      <div align="center"><a href="<?=$thisprog?>"><font color="#FF6600" size="4" face="verdana"><strong>全部</strong></font></a>&nbsp;&nbsp;&nbsp;
        <? 
$classs="";
$list=file("$mydata/ml.dat");
$count=count($list)-1;
for ($i=0; $i<=$count; $i++) {
	$list_info=explode("|",$list[$i]);
	$classs.="<a href=\"?pid=$list_info[1]\"><font color=#FF6600 size=4 face=verdana><strong>$list_info[2]</strong></font></a>&nbsp;&nbsp;&nbsp;";
}
echo "$classs";
?>
         &nbsp;&nbsp;<a href="javascript:history.go(0)">刷新</a></strong></font></div>
  <tr>
<td class="2" width="100%" valign="top" height="64"><table width="100%" border="0">
  <tr>
    <td width="49%" valign="middle"><form method="post" target=_blank action="qs.php">
  <div align="right">
    <script language="JavaScript1.2">
function validate(theform) {
	if (theform.ID.value=="输入序号打开指定文件") {
		alert("请输入序号！");
		return false; }}
  </script>     
    <font color="#ff6600">&nbsp;快速打开
    <input maxlength=40 size=20 name="ID" value="输入序号打开指定文件" onMouseOver="this.select();" onFocus="this.value=='输入序号打开指定文件'?this.value='':'';" onBlur="this.value==''?this.value='输入序号打开指定文件':''" onKeyDown="KeyDown()" onkeyup='input()'>
<INPUT type="submit" value="打开" onClick="return validate(this.form)"  class=button name="submits" name=Submit>&nbsp;&nbsp; &nbsp;&nbsp;</div>
  </form></td>
   <td width="51%" valign="middle">
<form method="post" action="search.php" name="search">&nbsp;&nbsp; &nbsp;&nbsp;<img src=images/seek.gif>
    <input type="hidden" name="act" value="sea">
<input size=20 name="key" value="输入关键词" onMouseOver="this.select();" onFocus="this.value=='输入关键词'?this.value='':'';" onBlur="this.value==''?this.value='输入关键词':''" onKeyDown="KeyDown()" onkeyup='input()'> <input type="submit" name="Submit" class="button" value="搜索" ></form></td>
  </tr>
</table>
<table class="leasin" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#DAEFE1" height="20">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#DAEFE1">
            <td width="5%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>序号</strong></font></div></td>
             <td width="29%" height="35" bgcolor="#DAEFE1"><font size="2"><strong> &nbsp;&nbsp; &nbsp;&nbsp;标题 </strong></font></td>
             <td width="8%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>编辑</strong></font></div></td>
             <td width="13%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>上传时间</strong></font></div></td>
             <td width="6%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>访问权限</strong></font></div></td>
             <td width="7%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>所属分类</strong></font></div></td>
             <td width="7%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>下载(次数)</strong></font></div></td>
             <td width="14%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>最近下载</strong></font></div></td>
             <td width="6%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>已签收</strong></font></div></td>
	<?		 if($checkpower==low) {}else { ?>
             <td width="5%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>管 理</strong></font></div></td> <? }?>
          </tr>
          </table></td>
        </tr>
        <tr>
          <td bgcolor="#DAEFE1" ><?
		  if (file_exists("$mydata/wj.dat")) 
{
$message=@file("$mydata/wj.dat");
$count=count($message);
 for ($i=0; $i<$count; $i++){
 $de=explode("|",$message[$i]);
$dl=explode("│",$de[10]);	
 if (file_exists("$mydata/wj.dat")){
 if(!$pid) {
	 if ($pid=="") $message_list[]=$message[$i];
 }else {
	 if ($pid==$dl[0] ) $message_list[]=$message[$i];
	 }
 }
 }
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
        $detail[3]=str_replace("│","|",$detail[3]);
        $detail[3]=str_replace("&lt;","<",$detail[3]);
        $detail[3]=str_replace("&gt;",">",$detail[3]);
        $detail[3]=str_replace("","\r",$detail[3]);
        $detail[3]=str_replace("","\t",$detail[3]);
        $detail[3]=str_replace("<br>","\n",$detail[3]);
        $detail[3]=str_replace("&nbsp;"," ",$detail[3]);
if(strlen($detail[3])>=64) {
if (strlen($detail[3])%2==0) $detail[3]=substr($detail[3],0,62)."...";
else $detail[3]=substr($detail[3],0,61)."...";
} 
?>
<table width="100%" border="0" >
  <tr>
    <td width="5%" bgcolor="#DAEFE1"><div align="center">
      <?=$detail[1]?>
    </div></td>
   <td width="29%" height="30" bgcolor="#DAEFE1"> &nbsp;
     <?	if (file_exists("$file$detail[2]")) 
{ echo"<a href=\"javascript:void(0)\" onClick=\"window.open ('qs.php?ID=$detail[1]','','top=0,left=0,width=700,height=400,status=no,resizable=yes,scrollbars=yes');\" title=\"打开 $detail[3] 的详情\">$detail[3]</a>";
}else echo"$detail[3] <font color=#009933>无效</font>";
$tdata=explode('-',$detail[5]);
?>
<script language="JavaScript">
var urodz= new Date("<?=$tdata[1]?>/<?=$tdata[2]?>/<?=$tdata[0]?>");
var now = new Date();
var ile = now.getTime() - urodz.getTime();
var dni = Math.floor(ile / (1000 * 60 * 60 * 24));
if (dni < 7)   document.write(" <img src=images/new.gif title=一周内新添加的信息>")
else document.write("");
</script></td>
      <td width="8%" bgcolor="#DAEFE1" title=最后编辑><div align="center">
        <?=$detail[7]?>
      </div></td>
      <td width="13%" bgcolor="#DAEFE1"><div align="center">
        <?=$detail[5]?>
      </div></td>
      <td width="6%" bgcolor="#DAEFE1">     <div align="center">
        <? $dl=explode("│",$detail[9]);	 echo"$dl[1]";?>
      </div></td>
      <td width="7%" bgcolor="#DAEFE1">     <div align="center">
        <? $djl=explode("│",$detail[10]);	 echo"$djl[1]";?>
      </div></td>
<td width="7%" bgcolor="#DAEFE1">
  <div align="center">
    <?	if (file_exists("$file$detail[2]")) 
{ echo"<a href=\"javascript:void(0)\" onClick=\"window.open ('qs.php?ID=$detail[1]','','top=0,left=0,width=700,height=400,status=no,resizable=yes,scrollbars=yes');\" title=\"打开 $detail[3] 的详情\"><img src=\"images/down.gif\" border=0>（$detail[8]）</a>";
}else echo"<font color=#009933>无效</font>";?>
  </div></td>
      <td width="14%" bgcolor="#DAEFE1" title="用户：<?=$detail[11]?>  IP:<?=$detail[13]?>"><div align="center">
        <?=$detail[12]?>
      </div></td>
      <td width="6%" bgcolor="#DAEFE1" title="已签收用户：<?=$detail[14]?>"><div align="center">查看</div></td>	<?		 if($checkpower==low) {}else { ?>
      <td width="5%" bgcolor="#DAEFE1"><div align="center"><a href="edit.php?ID=<?=$detail[1]?>">进入</a></div></td><? }?>
  </tr>
</table>
<? }}}else {echo "<br><center><font color=blue>暂时没有文件";}include("$mydata/page.php");?></td>
        </tr>
      </table></td>
  </tr> 
      </td>
</table>