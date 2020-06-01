<?php





$action=$_GET['action'];
$de = new file_class();
$de -> debug('root', 0);
$de -> file_root($_GET['path']);
$de -> file_list();
// $de -> debug('handle', 0);

if($action=='del'){
	if(isset($_GET['file'])){
		$de -> file_del($_GET['file']);
	}
}
if($action=='show'){
	if(isset($_GET['path'])){
		$de -> file_root($_GET['path']);
	}
}


?>

<TABLE>
<TR>
	<TD>文件名</TD>
	<TD>大小</TD>
	<TD>类型</TD>
	<TD>权限</TD>
	<TD>修改时间</TD>
	<TD>上次访问时间</TD>
	<TD>MD5</TD>
	<TD>删除</TD>
</TR>
<TR>
		<TD><a href="?action=show&path=<?php echo (isset($_GET['path']) && (substr($_GET['path'],0,3)=='../'))?substr($_GET['path'],3,strlen($_GET['path'])):'.\/'?>">.</a></TD>
</TR>
<TR>
		<TD><a href="?action=show&path=<?php echo isset($_GET['path'])?$_GET['path'].'../':'../'?>">..</a></TD>
</TR>
<?php 
if(!is_array($de -> handle)) exit;
foreach($de -> handle as $value){ ?>
<TR>
	<TD><?php if($value["type"]=='dir'){?><a href="?action=show&path=<?php echo $_GET['path'].$value['name']?>"><b style="color:red"><?php echo $value["name"]?></b></a><?php }else{?><?php echo $value["name"];}?></TD>
	<TD><?php echo $value["type"]?></TD>
	<TD><?php echo $value["size"]?></TD>
	<TD><?php echo $value["rw"]=='00'?'没权限':($value["rw"]=='11'?'可读可写':($value["rw"]=='10'?'可读':'可写'))?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["filemtime"])?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["fileatime"])?></TD>
	<TD><?php if($value["type"]!='dir') echo $value["md5"];?></TD>
	<TD><a href='?action=del&file=<?php echo $value["name"]?>'>点击删除</a></TD>
</TR>
<?php }?>

</TABLE>