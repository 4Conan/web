<?
$title="�����������";
$thisprog="mailqk.php";
require("global.php"); 
$dir="$mail";       
   rmdirs2($dir);
    function rmdirs2($dir){
        $dir_arr = scandir($dir);
         foreach($dir_arr as $key=>$val){
             if($val == '.' || $val == '..'){}
             else {
                if(is_dir($dir.'/'.$val))   
                {                           
                     if(@rmdir($dir.'/'.$val) == 'true'){}               
                     else
                    rmdirs2($dir.'/'.$val);                   
                }
                 else               
                unlink($dir.'/'.$val);
           }
        }
    }   
  $dir=$file;       
   rmdirs($dir);
    function rmdirs($dir){
        $dir_arr = scandir($dir);
         foreach($dir_arr as $key=>$val){
             if($val == '.' || $val == '..'){}
             else {
                if(is_dir($dir.'/'.$val))   
                {                           
                     if(@rmdir($dir.'/'.$val) == 'true'){}               
                     else
                    rmdirs($dir.'/'.$val);                   
                }
                 else               
                unlink($dir.'/'.$val);
           }
        }
    }   	
echo "<script>alert(\"�ɹ���������û������䣡\");</script><meta http-equiv=refresh content=0;url=sitemail.php>";exit;
?>