<?
$title="���ݱ���";
require("global.php");
$thisprog="bfleasin.php";
$date=date("Y-m-d");
extract($_POST);
echo"<title>$title / $xtm</title>";
if($checkpower !=super) {
echo"<br><center><font size=4 color=red>��Ǹ����û�д�Ȩ��</font><br><br>������������ϵ��$new_info[8] �绰��$new_info[2]</p>";    
exit;
}
print "<tr><td bgcolor=#CBDED8 colspan=3><b>$xtm / $title</b> </td></tr>";
extract($_POST);
?>
<td  colspan=3><p>
<table width="88%" border="0">
    <tr>
      <td height="93" colspan="2"><p><font color=red face=������>�������������Է���Ķ���վ���ݽ���һ��ʽ���ݡ���ԭ�����鶨�ڶ����ݽ��б��ݣ������ر����ļ�����</font> </p>
      <p>ÿ�α��ݺ��뽫�������ر��棬ϵͳҲ���Զ�����һ�ݣ������ԭ���ɽ���վ���ݻ�ԭ������ǰ״̬�������û�ԭ���ܡ�����������Ҫ�ǳ���վ�����ļ����û�����ϴ��ĸ����ļ���</p></td>
    <tr>
       <td width="31%">  
  <?
if(!$_REQUEST["myaction"]):
?>
    <?
elseif($_REQUEST["myaction"]=="dolist"):
  	$fdir = opendir('./');
	while($file=readdir($fdir)){
		if($file=='.'|| $file=='..') continue;
		echo "";
		if(is_file($file)){
		}else{
		}
	}
?>
    <script language='javascript'>
function selrev() {
	with(document.myform) {
		for(i=0;i<elements.length;i++) {
			thiselm = elements[i];
			if(thiselm.name.match(/dfile\[]/))	thiselm.checked = !thiselm.checked;
		}
	}
}
    </script>
    <?
elseif($_REQUEST["myaction"]=="dozip"):
  class PHPzip{
	var $file_count = 0 ;
	var $datastr_len   = 0;
	var $dirstr_len = 0;
	var $filedata = ''; 
	var $gzfilename;
	var $fp;
	var $dirstr='';
    function unix2DosTime($unixtime = 0) {
        $timearray = ($unixtime == 0) ? getdate() : getdate($unixtime);
        if ($timearray['year'] < 1980) {
        	$timearray['year']    = 1980;
        	$timearray['mon']     = 1;
        	$timearray['mday']    = 1;
        	$timearray['hours']   = 0;
        	$timearray['minutes'] = 0;
        	$timearray['seconds'] = 0;
        }
        return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) |
               ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
    }
	function startfile($path = 'shenbin.zip'){
		$this->gzfilename=$path;
		$mypathdir=array();
		do{
			$mypathdir[] = $path = dirname($path);
		}while($path != '.');
		@end($mypathdir);
		do{
			$path = @current($mypathdir);
			@mkdir($path);
		}while(@prev($mypathdir));

		if($this->fp=@fopen($this->gzfilename,"w")){
			return true;
		}
		return false;
	}
    function addfile($data, $name){
        $name     = str_replace('\\', '/', $name);
		if(strrchr($name,'/')=='/') return $this->adddir($name);
        $dtime    = dechex($this->unix2DosTime());
        $hexdtime = '\x' . $dtime[6] . $dtime[7]
                  . '\x' . $dtime[4] . $dtime[5]
                  . '\x' . $dtime[2] . $dtime[3]
                  . '\x' . $dtime[0] . $dtime[1];
        eval('$hexdtime = "' . $hexdtime . '";');
        $unc_len = strlen($data);
        $crc     = crc32($data);
        $zdata   = gzcompress($data);
        $c_len   = strlen($zdata);
        $zdata   = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
        $datastr  = "\x50\x4b\x03\x04";
        $datastr .= "\x14\x00";            // ver needed to extract
        $datastr .= "\x00\x00";            // gen purpose bit flag
        $datastr .= "\x08\x00";            // compression method
        $datastr .= $hexdtime;             // last mod time and date
        $datastr .= pack('V', $crc);             // crc32
        $datastr .= pack('V', $c_len);           // compressed filesize
        $datastr .= pack('V', $unc_len);         // uncompressed filesize
        $datastr .= pack('v', strlen($name));    // length of filename
        $datastr .= pack('v', 0);                // extra field length
        $datastr .= $name;
        $datastr .= $zdata;
        $datastr .= pack('V', $crc);                 // crc32
        $datastr .= pack('V', $c_len);               // compressed filesize
        $datastr .= pack('V', $unc_len);             // uncompressed filesize
		fwrite($this->fp,$datastr);	//д���µ��ļ�����
		$my_datastr_len = strlen($datastr);
		unset($datastr);
        $dirstr  = "\x50\x4b\x01\x02";
        $dirstr .= "\x00\x00";                	// version made by
        $dirstr .= "\x14\x00";                	// version needed to extract
        $dirstr .= "\x00\x00";                	// gen purpose bit flag
        $dirstr .= "\x08\x00";                	// compression method
        $dirstr .= $hexdtime;                 	// last mod time & date
        $dirstr .= pack('V', $crc);           	// crc32
        $dirstr .= pack('V', $c_len);         	// compressed filesize
        $dirstr .= pack('V', $unc_len);       	// uncompressed filesize
        $dirstr .= pack('v', strlen($name) ); 	// length of filename
        $dirstr .= pack('v', 0 );             	// extra field length
        $dirstr .= pack('v', 0 );             	// file comment length
        $dirstr .= pack('v', 0 );             	// disk number start
        $dirstr .= pack('v', 0 );             	// internal file attributes
        $dirstr .= pack('V', 32 );            	// external file attributes - 'archive' bit set
        $dirstr .= pack('V',$this->datastr_len ); // relative offset of local header
        $dirstr .= $name;
		$this->dirstr .= $dirstr;	//Ŀ¼��Ϣ
		$this -> file_count ++;
		$this -> dirstr_len += strlen($dirstr);
		$this -> datastr_len += $my_datastr_len;	
    }
	function adddir($name){ 
		$name = str_replace("\\", "/", $name); 
		$datastr = "\x50\x4b\x03\x04\x0a\x00\x00\x00\x00\x00\x00\x00\x00\x00"; 
		$datastr .= pack("V",0).pack("V",0).pack("V",0).pack("v", strlen($name) ); 
		$datastr .= pack("v", 0 ).$name.pack("V", 0).pack("V", 0).pack("V", 0); 
		fwrite($this->fp,$datastr);	//д���µ��ļ�����
		$my_datastr_len = strlen($datastr);
		unset($datastr);
		$dirstr = "\x50\x4b\x01\x02\x00\x00\x0a\x00\x00\x00\x00\x00\x00\x00\x00\x00"; 
		$dirstr .= pack("V",0).pack("V",0).pack("V",0).pack("v", strlen($name) ); 
		$dirstr .= pack("v", 0 ).pack("v", 0 ).pack("v", 0 ).pack("v", 0 ); 
		$dirstr .= pack("V", 16 ).pack("V",$this->datastr_len).$name; 
		$this->dirstr .= $dirstr;	//Ŀ¼��Ϣ
		$this -> file_count ++;
		$this -> dirstr_len += strlen($dirstr);
		$this -> datastr_len += $my_datastr_len;	
	}
	function createfile(){
		$endstr = "\x50\x4b\x05\x06\x00\x00\x00\x00" .
					pack('v', $this -> file_count) .
					pack('v', $this -> file_count) .
					pack('V', $this -> dirstr_len) .
					pack('V', $this -> datastr_len) .
					"\x00\x00";
		fwrite($this->fp,$this->dirstr.$endstr);
		fclose($this->fp);
	}
  }
	if(!trim($_REQUEST[zipname])) $_REQUEST[zipname] = "leasin.zip"; else $_REQUEST[zipname] = trim($_REQUEST[zipname]);
	if(!strrchr(strtolower($_REQUEST[zipname]),'.')=='.zip') $_REQUEST[zipname] .= ".zip";
	$_REQUEST[todir] = str_replace('\\','/',trim($_REQUEST[todir]));
	if(!strrchr(strtolower($_REQUEST[todir]),'/')=='/') $_REQUEST[todir] .= "/";	
	if($_REQUEST[todir]=="/") $_REQUEST[todir] = "./";
	function listfiles($dir="."){
		global $faisunZIP;
		$sub_file_num = 0;
		if(is_file("$dir")){
		  if(realpath($faisunZIP ->gzfilename)!=realpath("$dir")){
			$faisunZIP -> addfile(implode('',file("$dir")),"$dir");
			return 1;
		  }
			return 0;
		}
		$handle=opendir("$dir");
		while ($file = readdir($handle)) {
		   if($file=="."||$file=="..")continue;
		   if(is_dir("$dir/$file")){
			 $sub_file_num += listfiles("$dir/$file");
		   }
		   else {
		   	   if(realpath($faisunZIP ->gzfilename)!=realpath("$dir/$file")){
			     $faisunZIP -> addfile(implode('',file("$dir/$file")),"$dir/$file");
				 $sub_file_num ++;
				}
		   }
		}
		closedir($handle);
		if(!$sub_file_num) $faisunZIP -> addfile("","$dir/");
		return $sub_file_num;
	}
	function num_bitunit($num){
   $bitunit=array(' B',' KB',' MB',' GB');
   for($key=0;$key<count($bitunit);$key++){
  if($num>=pow(2,10*$key)-1){ //1023B ����ʾΪ 1KB
    $num_bitunit_str=(ceil($num/pow(2,10*$key)*100)/100)." $bitunit[$key]";
  }
   }
   return $num_bitunit_str;
 }
 
 if(is_array($_REQUEST[dfile])){
  $faisunZIP = new PHPzip;
  if($faisunZIP -> startfile("$_REQUEST[todir]$_REQUEST[zipname]")){
   $filenum = 0;
   foreach($_REQUEST[dfile] as $file){
    if(is_file($file)){
    }else{
    }
    $filenum += listfiles($file);
   }
   $faisunZIP -> createfile();
   echo "<br><font color=red>�������,����� $filenum ���ļ���</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ء�����<a href='$_REQUEST[todir]$_REQUEST[zipname]'>�����ļ�</a>&nbsp;&nbsp;&nbsp;<input class=button type=button onclick=javascript:history.go(-1) value=����>";exit;
  }else{
   echo "$_REQUEST[todir]$_REQUEST[zipname] ����д��,����·����Ȩ���Ƿ���ȷ.<br>";
  }
 }else{
  echo "������ļ���Ϣ";
 }
endif;

?>      <form name=myform method=post action=> 
         <div align="center">
           <input name=todir type=hidden value='/' size=15> 
           <input name=zipname type=hidden id=zipname value="leasinData" size=15>
           <input name=myaction type=hidden id=myaction value=dozip>
           <input name=dfile[] type=hidden value="<?=$file?>">
           <input name=dfile[] type=hidden value="<?=$mydata?>/wj.dat">
           <input name=dfile[] type=hidden value="<?=$mydata?>/ml.dat">
           <input type=submit value="����" title=�����ʼ������վ���� class=button OnClick="JavaScript: if(confirm('ȷʵҪִ�в����滻ԭ�б�����')) return true; else return false;">
          </div>
       </form></td>
      <td width="69%">
<form name="myform" method="post" action="yjhy.php"><input name="zipfile" type=hidden id=zipname value="leasinData.zip">
      <input name="todir" type="hidden" id="todir" value="./"><input name="myaction" type="hidden" id="myaction" value="dounzip">
      <input type="submit" name="Submit" value="��ԭ" title=�����ʼ������վ���� class=button OnClick="JavaScript: if(confirm('ȷʵҪ�����ݻ�ԭ������ǰ��״̬��')) return true; else return false;"></form></td>
  </table>
</body>
</html>
