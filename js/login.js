
//function loginClick()
//{ 
//	alert("loginClick");
//  var s = document.createElement("script");
//  s.src = "php/login.php";
//  document.body.appendChild(s);
//}
"use strict";

function getIdValue(id)
{
	var obj=document.getElementById(id);
	return obj.value;
}
function sendToSever(username,password,mode)
{
	var obj = { "username":username, "password":password, "mode":mode };
    var s =  document.createElement("script");
    s.src = "php/login.php?jsonStr="  + JSON.stringify(obj);
    document.body.appendChild(s);
	
}
function loginClick()
{
	var username = getIdValue("login-username");
	var password = getIdValue("login-password");
   	sendToSever(username,password,"login");
	alert("loginClick");
 }
function myFunc(data)
{
	alert(data.info);
	var hrefArr = [" ", "home.php", "login.html"];
	if(data.isSuccess)
	{
		var index = data.href;
		if( index > 0 && index < hrefArr.length)
		{
			window.location.href =hrefArr[index];
		}
		
	}
}

function registerClick()
{
	var username = getIdValue("register-username");
	var password = getIdValue("register-password");
    sendToSever(username,password,"register");
	
	return false;
}

