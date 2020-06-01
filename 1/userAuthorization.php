<?php
	require("../php/session.php");
	require("./fun.Authorization.php");


if ($_SESSION['user'] != 'admin') 
{
	exit();
}

?>
<!DOCTYPE html >
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
	 <style>
        fieldset {
            padding: .35em .625em .75em;
            margin: 0 2px;
            border: 1px solid silver;
        }

        legend {
            padding: .5em;
            border: 0;
            width: auto;
        }
		 label{
			  margin: 0 .5em;
		 }
    </style>

</head>

<body>
	<div class="main">
	<?php include 'top.php' ?>
	<div class="info">
		<table class="table table-hover" id="tableInfo">
			<tr>
				<th id="username">昵称</th>
				<th id="leve">权限</th>
				<th	id="registeredDate">注册时间</th>
			</tr>

<!--		下一页-->
			<tr>
				<td colspan="3">
					<div>
						<div class="GD_PAGECOUNT">
							<span id="span_previousPage"><a href="javascript:void(0);" onclick="previousPage()">上一页</a></span>
							<span id="span_nextPage"><a href="javascript:void(0);" onclick="nextPage()">下一页</a></span>
							<span id="span_total"></span>
							<span id="span_currPage"></span>
						</div>
					</div>
				</td>
			</tr>
		</table>
<!--		<input type="button" value="确定修改" id="bntChange">-->
		
		
		
		
		<!-- 模态框（Modal） -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		   <div class="modal-dialog">
			  <div class="modal-content">
				 <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="modalTitle"> 修改用户权限 </h4>
				 </div>
				 <div class="modal-body">
					<fieldset>
						 <label><input type='checkbox' class='checkbox'id='downPrivate' />下载私有</label>
						 <label><input type='checkbox' class='checkbox'id='uploadPrivate'/>上传私有</label>
						 <label><input type='checkbox' class='checkbox'id='downPublic' />下载公有</label>
						 <label><input type='checkbox' class='checkbox' id='uploadPublic'/>上传公有</label>
					</fieldset>
				</div>
				 <div class="modal-footer">
					<button type="button" class="btn btn-primary" id="changeLeve">提交更改</button>
				 </div>
			  </div><!-- /.modal-content -->
			   </div><!-- /.modal -->
		</div>	
	</div>
		

		
<script language="javascript" type="text/javascript"> 
	"use strict";
	

	
	var authority = 0;
	var userName;
	var dataPage; //数据
	var totalPage; //一共
	var countPage; //一共多少个
	var onePage=10;   //一页多少个
	var currPage; //当前
	
	//排序
	const SORT_NULL = 0;
	const SORT_USERNAME = 1;
	const SORT_LEVE = 2;
	const SORT_REGISTERED = 3;
	var registeredDateIsAcs = true;
	var usernameIsAcs = true;
	var leveIsAcs = true;
	
	$(function()
	 { 
		var obj = {"mode":"show"};
		sendToServer(obj);

	 });

	$('#changeLeve').click(function(){
		var uploadPublic 	= $('#uploadPublic').is(':checked')?"1":"0"; 
		var downPublic 		= $('#downPublic').is(':checked')?"1":"0";
		var uploadPrivate 	= $('#uploadPrivate').is(':checked')?"1":"0";
		var downPrivate 	= $('#downPrivate').is(':checked')?"1":"0";
		var leveStr = downPrivate+uploadPrivate+downPublic+uploadPublic;
		if(leveStr != authority)
		{
			var obj = {"username":userName,"leveStr":leveStr,"mode":"ModifyPermissions"};
			var s =  document.createElement("script");
			s.src = "./userAuthorization_server.php?jsonStr=" + JSON.stringify(obj);
			document.body.appendChild(s);
		}
		
		$('#myModal').modal('toggle');
	});
	
		
	$('#username').click(function(){
		sort(SORT_USERNAME,usernameIsAcs);
		usernameIsAcs = !usernameIsAcs;
	});
	

	$('#leve').click(function(){
		sort(SORT_LEVE,leveIsAcs);
		leveIsAcs = !leveIsAcs;
		
	});
	
	$('#registeredDate').click(function(){
		sort(SORT_REGISTERED,registeredDateIsAcs);
		registeredDateIsAcs = !registeredDateIsAcs;
	});
	
	function sort(according,isAsc)
	{
        for (var i = dataPage.length - 1; i > 0; i--) 
		{
          for (var j = 0; j < i; j++) 
		  {
			var swap = false;
			var a=0,b=0;
			switch(according)
			{
				case SORT_USERNAME:
					 a = dataPage[j].username;
			 		 b = dataPage[j+1].username;
					break;
				case SORT_LEVE:
					 a = dataPage[j].leveStr;
					 b = dataPage[j+1].leveStr;
					break;
				case SORT_REGISTERED:
					 a = dataPage[j].registeredDate;
					 b = dataPage[j+1].registeredDate;
					break;
			}
		    
			if(isAsc)
			{
				if (a<b) 
				{
					swap = true;
				}
			}
		 	else
			{
				if (a>b) 
				{
					swap = true;
				}
			}
			if(swap)
		    {
				var data = dataPage[j];
				dataPage[j] = dataPage[j+1];
				dataPage[j+1] = data;
			}
          }
        }
		resetPage();
	}
	function toggleModal(username,leveStr){
	//	$('#legend').value("aaaa");
		authority = leveStr;
		userName = username;
		
		var uploadPublic 	=  parseInt(leveStr / 1 % 10);
		var downPublic 		=  parseInt(leveStr / 10 % 10);
		var uploadPrivate 	=  parseInt(leveStr / 100 % 10);
		var downPrivate 	=  parseInt(leveStr / 1000 % 10);
		
		$('#modalTitle').text("修改 "+username+" 的权限");
	
		if(uploadPublic) $("#uploadPublic").prop("checked",true);
		else $("#uploadPublic").prop("checked",false);
		
		if(downPublic) $("#downPublic").prop("checked",true);
		else $("#downPublic").prop("checked",false);
		
		if(uploadPrivate) $("#uploadPrivate").prop("checked",true);
		else $("#uploadPrivate").prop("checked",false);
		
		if(downPrivate) $("#downPrivate").prop("checked",true);
		else $("#downPrivate").prop("checked",false);
		
		$('#myModal').modal('toggle');
	}
	
		
	function sendToServer(obj)
	{
		var s =  document.createElement("script");
		s.src = "./userAuthorization_server.php?jsonStr=" + JSON.stringify(obj);
		document.body.appendChild(s);
	}
	
	function resetPage()
	{
		$("#tableInfo  tr:not(:first):not(:last)").empty("");
		for (var i =  (onePage*(currPage-1));i < 10*currPage && i<=countPage; i++) 
		{		
			var trHTML = "<tr onClick=\"toggleModal('" + dataPage[i].username + "','" + dataPage[i].leveStr + "');\">";	
			trHTML += "<td>"+dataPage[i].username +"</td>";
			trHTML += "<td>"+dataPage[i].leveStr +"</td>";
			trHTML += "<td>"+dataPage[i].registeredDate +"</td></tr>";
			var index = $("#tableInfo tr:last").index()-1;
			$("#tableInfo tr:eq("+ index +")").after(trHTML); //在页前添加
		}
		var strTotal = '共'+totalPage+'页';
		var strCurrPage = '当前'+currPage+'页';
		$('#span_total').text(strTotal);
		$('#span_currPage').text(strCurrPage);
	}
	
	function previousPage()
	{
		currPage--;
		if(currPage<1)
			currPage++;
		
		resetPage();
	}
	function nextPage()
	{

		currPage++;
		if(currPage>totalPage)
			currPage--;
		resetPage();
	}
	
	function callbackDebug(info)
	{
		alert(info);	
	}
	function callbackGoUrl(info,url)
	{
		alert(info);
		window.location.href = url;
	}

	function callbackShow(data)
	{
		dataPage = data;
		countPage = data.length-1;
		totalPage = parseInt(countPage/onePage);
		
		if(totalPage<1) totalPage = 1;
		else if(countPage%onePage) totalPage++;
		currPage = 1;
		
		resetPage();
	}
</script>
 </body>
</html>
	
	