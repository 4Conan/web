<?php
	require("../php/session.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="../css/style.css" rel="stylesheet">	
<title>无标题文档</title>
</head>

	
<body>

	<div class="main">
		<?php include 'top.php' ?>
		<div class="info">
			<table class="table table-hover" id="tableInfo" >
				<tr>
					<th id="version">版本</th>
					<th id="platform">平台</th>
					<th id="status">状态</th>
					<th id="uploadTime">上传时间</th>
				</tr>
				
				<tr onClick="addVer()">
					<td colspan="5">新增发布版本</td>
				</tr>
			
				<!--下一页-->
				<tr>
					<td colspan="5">
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
	  
		</div>
	</div>

<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
			
	"use strict";
	var dataPage; //数据
	var totalPage; //一共
	var countPage; //一共多少个
	var onePage=10;   //一页多少个
	var currPage; //当前
	
	//排序
	const SORT_NULL = 0;
	const SORT_VERSION = 1;
	const SORT_PLATFORM = 2;
	const SORT_STATUS = 3;
	const SORT_UPLOADTIME= 4;
	
	var versionIsAcs = true;
	var platformIsAcs = true;
	var statusIsAcs = true;
	var uploadTimeIsAcs = true;
	$(function()
	  { 
		var obj = {"isPublished":"1","mode":"show"};
		sendToServer(obj);
	  });
	
	$('#version').click(function(){
		sort(SORT_VERSION,versionIsAcs);
		versionIsAcs = !versionIsAcs;
	});
	
	$('#platform').click(function(){
		sort(SORT_PLATFORM,platformIsAcs);
		platformIsAcs = !platformIsAcs;
		
	});

	$('#status').click(function(){
		sort(SORT_STATUS,statusIsAcs);
		statusIsAcs = !statusIsAcs;
		
	});
	
	$('#uploadTime').click(function(){
		sort(SORT_UPLOADTIME,uploadTimeIsAcs);
		uploadTimeIsAcs = !uploadTimeIsAcs;
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
				case SORT_VERSION:
					 a = dataPage[j].releaseVersion;
			 		 b = dataPage[j+1].releaseVersion;
					break;
				case SORT_PLATFORM:
					 a = dataPage[j].platform;
					 b = dataPage[j+1].platform;
					break;
				case SORT_STATUS:
					 a = dataPage[j].isPublished;
					 b = dataPage[j+1].isPublished;
					break;
				case SORT_UPLOADTIME:
					 a = dataPage[j].uploadDate;
					 b = dataPage[j+1].uploadDate;
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

	
	function callbackShow(data)
	{
		for (var i = data.length-1;i >= 0; i--) 
		{
			$('#releaseID').prepend("<option value='"+data[i].id+"'>"+data[i].release+"</option>");//添加option到第一
		}
	}
	function sendToServer(obj)
	{
		var s =  document.createElement("script");
		s.src = "./publishOrPendingPage_server.php?jsonStr=" + JSON.stringify(obj);
		document.body.appendChild(s);
	}

	function addVer()
	{
		window.location.href = "./newRelease.php";
	}

	function trClick(releaseVersion,platform)
	{
		location.href = "./publishInfoPage.php?platform="+platform+"&releaseVersion="+releaseVersion+"&isPublished="+1;
		return;
	}

	function resetPage()
	{
		var index = $("#tableInfo tr:last").index()-1;
		alert(index);
		$("#tableInfo  tr:not(:first):not(1)").empty("");
		for (var i =  (onePage*(currPage-1));i < 10*currPage && i<=countPage; i++) 
		{	
			var pu = (dataPage[i].isPublished == 1)? '已发布':'待发布';

			var trHTML = "<tr onClick=trClick('" + dataPage[i].releaseVersion + "','" + dataPage[i].platform + "');>";	
			trHTML += "<td>"+dataPage[i].releaseVersion +"</td>";
			trHTML += "<td>"+dataPage[i].platform +"</td>";
			trHTML += "<td>"+ pu +"</td>";
			trHTML += "<td>"+dataPage[i].uploadDate +"</td></tr>";
					//$('#tableInfo tr:eq(0)').after(trHTML); //在标题后面添加
			$("#tableInfo tr:eq("+ index +")").after(trHTML); //在页和新增前添加
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

	//callback
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
	function callbackDebug(info)
	{
		alert(info);	
	}
</script>	
</body>
</html>