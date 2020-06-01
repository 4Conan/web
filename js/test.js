"use strict";


function changDisplayInfo(id)
{
	var testdiv = document.getElementById("info");
	var html=document.querySelector(id).innerHTML;
	testdiv.innerHTML=html;
}