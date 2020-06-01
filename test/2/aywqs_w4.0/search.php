<?
extract($_POST);
$title="文件搜索";
require("global.php");
if($_POST['act'] == "sea")
{     
    $key=$_POST['key'];
 }
else{
    $key=$_GET['key'];
	$page=$_GET['page'];
}
if($_POST['ac'] == "t")
{   	$page=$_POST['page'];
}

if(empty($key)) { echo "<script>alert(\"请填写关键字！\");javascript:history.go(-1);</script>";exit;}
$listtosearch=file("$mydata/wj.dat");
 $count=count($listtosearch);
 for ($j=0; $j<$count; $j++) {
  $detail=explode("|",$listtosearch[$j]);
 if (strpos($listtosearch[$j],$key) !== false ) {
     $result[] = $listtosearch[$j];
     $resultcount++;     
    }
    }
if (empty($page)) $page=1;
if ($page <1)  $page=1;
settype($page, integer);
$perpage=10;
?><title><?=$title?> / <?=$xtm?></title>
<META http-equiv=Content-Language content=zh-cn>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<tr><td bgcolor=#CBDED8 colspan=3><b><? echo"$xtm / $title"?></b> </td></tr>
<tr>
 <td class="2" width="99%" valign="top" height="150"> <table width="100%" height="132" border="0" cellpadding="0" cellspacing="0" class="leasin">
        <tr> 
          <td bgcolor="#FFFFFF" height="20">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr bgcolor="#FFFFFF">
            <td height="35" colspan="10" align="center"><form method="post" action="" name="search">&nbsp;&nbsp; &nbsp;&nbsp;<img src=images/seek.gif>
    <input type="hidden" name="act" value="sea">
<input size=26 name="key" value="<?=$key?>"> <input type="submit" name="Submit" class="button" value="搜索" ></form></td>
            </tr>
          <tr bgcolor="#FFFFFF">
            <td width="4%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>序号</strong></font></div></td>
             <td width="35%" height="35" bgcolor="#DAEFE1"><font size="2"><strong> &nbsp;&nbsp; &nbsp;&nbsp;标题 </strong></font></td>
             <td width="6%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>编辑</strong></font></div></td>
             <td width="11%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>发布时间</strong></font></div></td>
             <td width="7%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>访问权限</strong></font></div></td>
             <td width="8%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>所属分类</strong></font></div></td>
             <td width="7%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>下载(次数)</strong></font></div></td>
             <td width="11%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>最近下载</strong></font></div></td>
             <td width="6%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>已签收</strong></font></div></td>
             <td width="5%" bgcolor="#DAEFE1"><div align="center"><font size="2"><strong>管 理</strong></font></div></td>
          </tr>
          </table></td>
        </tr>
        <tr>
          <td height="38" bgcolor="#FFFFFF" ><?
$countnum=count($result);
$list_soft='';
$count=$countnum;
if($count!=0){
 if ($count%$perpage==0) $maxpageno=$count/$perpage;
		else $maxpageno=floor($count/$perpage)+1;
	if ($page>$maxpageno) $page=$maxpageno;
	$pagemin=min( ($page-1)*$perpage , $count-1);
	$pagemax=min( $pagemin+$perpage-1, $count-1);
	for ($i=$pagemin; $i<=$pagemax; $i++) {
	 $detail=explode("|",$result[$i]);
  $a_info=@file("$dabox/".$a.".php");  list($err,$id,$url,$bt,$nr,$time,$ip,$admin,$qx,$ml,$sj,$qs,$qsz)=explode("|",$a_info[0]);
$nr=str_replace("<br>","　",$nr);
$tdata=explode('-',$time);
$mytitle="$bt";
if(strlen($nr)>=60) {
if (strlen($nr)%2==0) $nr=substr($nr,0,58)."...";
else $nr=substr($nr,0,57)."...";
}
$nr = str_replace($key,"<font color=red>$key</font>",$nr);
?>
<table width="100%" border="0">
  <tr>
    <td width="5%" bgcolor="#DAEFE1"><div align="center">
      <?=$detail[1]?>
    </div></td>
   <td width="34%" height="30" bgcolor="#DAEFE1"> &nbsp;
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
      <td width="6%" bgcolor="#DAEFE1" title=最后编辑><div align="center">
        <?=$detail[7]?>
      </div></td>
      <td width="11%" bgcolor="#DAEFE1"><div align="center">
        <?=$detail[5]?>
      </div></td>
      <td width="7%" bgcolor="#DAEFE1">     <div align="center">
        <? $dl=explode("│",$detail[9]);	 echo"$dl[1]";?>
      </div></td>
      <td width="8%" bgcolor="#DAEFE1">     <div align="center">
        <? $djl=explode("│",$detail[10]);	 echo"$djl[1]";?>
      </div></td>
<td width="7%" bgcolor="#DAEFE1">
  <div align="center">
    <?	if (file_exists("$file$detail[2]")) 
{ echo"<a href=\"javascript:void(0)\" onClick=\"window.open ('qs.php?ID=$detail[1]','','top=0,left=0,width=700,height=400,status=no,resizable=yes,scrollbars=yes');\" title=\"打开 $detail[3] 的详情\"><img src=\"images/down.gif\" border=0>（$detail[8]）</a>";
}else echo"<font color=#009933>无效</font>";?>
  </div></td>
      <td width="11%" bgcolor="#DAEFE1" title="用户：<?=$detail[11]?>  IP:<?=$detail[13]?>"><div align="center">
        <?=$detail[12]?>
      </div></td>
      <td width="6%" bgcolor="#DAEFE1" title="已签收用户：<?=$detail[14]?>"><div align="center">查看</div></td>
      <td width="5%" bgcolor="#DAEFE1"><div align="center"><a href="edit.php?id=<?=$detail[1]?>">进入</a></div></td>
  </tr>
</table>
        <tr>
          <td bgcolor="#FFFFFF" height="18"><?
}
}else {echo "<br>&nbsp;&nbsp;<font color=blue>对不起，没有搜索到相关的信息";}
?></td>
        </tr>
        <tr> <form method="post" action="?sleasin=<?=$sleasin?>&action=<?=$action?>&key=<?=$key?>">  <input type="hidden" name="ac" value="t">
          <td bgcolor="#FFFFFF" height="52"><center>
            <hr size="1" noshade align="center" width="100%">  
            共找到与 <font color=red><b><?=$key?></b></font> 相关的信息 
<?
if ($maxpageno<=1) echo " <font color=red><b>{$countnum}</b> </font>条 | 只有一页";
else { 
      $nextpage=$page+1;
      $previouspage=$page-1;
	  echo "  <font color=red><b>{$countnum}</b> </font>条 | ";
	  if ($page<=1) echo " <a href=?key=$key&page=$nextpage>下一页</a> <a href=?key=$key&page=$maxpageno>尾页</a> ";
	  elseif($page>=$maxpageno) echo " <a href=?key=$key&page=1>首页</a> <a href=?key=$key&page=$previouspage>上一页</a> ";
	 
	  else echo " <a href=?key=$key&page=1>首页</a> <a href=?key=$key&page=$previouspage>上一页</a> <a href=?key=$key&page=$nextpage>下一页</a> <a href=?key=$key&page=$maxpageno>尾页</a> ";
	  echo " | 页码：<font color=red>$page</font>/$maxpageno    &nbsp; <font color=red>$perpage</font>条/页 | 转到第<select name='page' size='1' style=\"border: 1px solid #429234; background-color: #FAFDF9\" onChange='javascript:submit()'>";
	for ($j=1; $j<=$maxpageno; $j++) {echo "<option value='".$j."'>".$j."</option>";
	}
	echo "</select>页";
}
?></td>
       </form>
      </table></td>
                                          </tr>