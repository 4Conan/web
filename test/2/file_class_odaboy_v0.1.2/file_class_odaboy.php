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
	<TD>�ļ���</TD>
	<TD>��С</TD>
	<TD>����</TD>
	<TD>Ȩ��</TD>
	<TD>�޸�ʱ��</TD>
	<TD>�ϴη���ʱ��</TD>
	<TD>MD5</TD>
	<TD>ɾ��</TD>
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
	<TD><?php echo $value["rw"]=='00'?'ûȨ��':($value["rw"]=='11'?'�ɶ���д':($value["rw"]=='10'?'�ɶ�':'��д'))?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["filemtime"])?></TD>
	<TD><?php echo date("Y-m-d",$value["time"]["fileatime"])?></TD>
	<TD><?php if($value["type"]!='dir') echo $value["md5"];?></TD>
	<TD><a href='?action=del&file=<?php echo $value["name"]?>'>���ɾ��</a></TD>
</TR>
<?php }?>

</TABLE>