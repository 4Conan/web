<?
$farray=file($book);
for($i=0;$i<count($farray);$i++)
{   
    if(strcmp($i+1,$delline)==0)  
     {   
        continue;
     }   
    if(trim($farray[$i])<>"") 
     {   
        $newfp.=$farray[$i];   
     }   
}   
$fp=@fopen($book,"w");
@fputs($fp,$newfp);
@fclose($fp);
?>