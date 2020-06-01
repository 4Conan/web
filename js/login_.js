
var xhttp;


function getIdValue(id)
{
	var obj=document.getElementById(id);
	return obj.value;
}

function GetXmlHttpObject()
{
	var xmlHttp=null;

	try
	 {
		 // Firefox, Opera 8.0+, Safari
		 xmlHttp=new XMLHttpRequest();
	 }
	catch (e)
	 {
		 // Internet Explorer
		 try
		  {
		  	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		  }
		 catch (e)
		  {
		  	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
	 }
	return xmlHttp;
}

function stateChanged() 
{ 
	alert("readyState:"+this.readyState +"status:"+ this.status);
	if (xhttp.readyState==4 || xhttp.readyState=="complete")
	{ 
		alert(xhttp.responseText);
	} 
	
}

function sendToSever(username,password,mode)
{
	xhttp = GetXmlHttpObject();
	if(xhttp==null)
	{
		alert("Browser does not support HTTP Request");
		return;
	} 
	
	var url = "php/server.php";
	url += "?username="+username;
	url += "&password="+password;
	url += "&mode="+mode;

	alert(url);
	xhttp.onreadystatechange=stateChanged;
	xhttp.onloadend=function(){xhttp.abort();}
	xhttp.open("GET", url, true);
	xhttp.send();
	
	
}

function ServerCheck()
{
	var username=getIdValue("login-username");
	var password=getIdValue("login-password");
	sendToSever( username, password, "login");
}

function  LocalCheck(){
//	var input_pwd= document.getElementById('input_pwd');
//	var md5_pwd= document.getElementById('md5_pwd');
//	 md5_pwd.value= toMD5(input_pwd.value);            
	//进行下一步
	ServerCheck();
	return true;
}


function register()
{
	var username=getIdValue("register-username");
	var password=getIdValue("register-password");
	sendToSever( username, password, "register");
}
