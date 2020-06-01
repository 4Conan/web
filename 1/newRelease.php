<?php
	require_once("../php/session.php");
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
			<label>请选择软件平台: </label></br>
			  <select  id="softwarePlatform">
				 <option value="0">新增软件平台</option> 
			  </select><em><strong id="checkPlatform"></strong></em>
		
			</br>
			</br>
			<label>当前软件发布ID(列子：主版本号.次版本号.修订号.发布编号 1.1.1.101): </label></br>
			<input type="text" id="release"><em><strong id="checkRelease"></strong></em>
			</br>
			</br>

			<label>新增软件版本描叙: </label></br>
			<textarea id="description" rows="10" cols="30" placeholder="添加点文字描叙下这版本吧！"></textarea></br>
			</br>
			</br>
			</br>
			<button id='bntNewRelease'>新增</button>

			<!-- 模态框（Modal） -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			   <div class="modal-dialog">
				  <div class="modal-content">
					 <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel"> 模态框（Modal）标题  </h4>
					 </div>
					 <div class="modal-body">
						<label>ID: </label>
						<input type="text" id="softwareID">
					 	<label>软件平台: </label>
						<input type="text" id="platform">
					</div>
					 <div class="modal-footer">
						<button type="button" class="btn btn-primary" id="newPlatform">提交更改</button>
					 </div>
				  </div><!-- /.modal-content -->
				   </div><!-- /.modal -->
			</div>
      
		</div>
	</div>


<script language="javascript" type="text/javascript">  
			

		$(function()
		  { 
			var obj = {"mode":"show"};
			sendToServer(obj);
			
//			 if(!softwareID)
//			 {
//				$('#checkPlatform').text("请选择或添加软件平台");
//			 }
		  });
		
		
	 	//检查发布版本id是否合格及重复
		 $('#release').blur(function(){
			 var val = $('#release').val();
			 var softwareID = $('#softwarePlatform').children('option:selected').val();
			
			 var verArr = val.split('.');
			 if(verArr.length != 4)
			 {
				 $('#checkRelease').text("请确保软件发布ID位数为四位");
				 return;
			 }
			 $('#checkRelease').text("");
			 var obj = {"softwareID":softwareID,"release":val,"mode":"checkRelease"};
			 sendToServer(obj);
		 });
				 
		 //弹出新建软件平台模态框
		 $('#softwarePlatform').change(function(){  
			 var p = $(this).children('option:selected').val();
			 if(p == 0)
				   $('#myModal').modal('toggle');
		   });
	
		//模态框编辑完添加新的软件平台
		$('#newPlatform').click(function(){
			var id = $('#softwareID').val();
			var platform = $('#platform').val();
			var obj = {"id":id, "platform":platform,"mode":"addPlatform"};
			sendToServer(obj);
		});
		//添加新的版本
		$('#bntNewRelease').click(function(){
			var softwareID = $('#softwarePlatform').children('option:selected').val();
			var release = $('#release').val();
			var description = $('#description').val();
		
			var obj = {"softwareID":softwareID, "release":release,"description":description,"mode":"addRelease"};
			sendToServer(obj);
		});
	
		function sendToServer(obj)
		{
			var s =  document.createElement("script");
			s.src = "./newRelease_server.php?jsonStr=" + JSON.stringify(obj);
			document.body.appendChild(s);

		}
		
		function callbackCheck(data)
		{
			alert('callbackCheck');
			if(data.status == 1)
			{
				$('#checkRelease').text("可用");
			}
			else if(data.status == 0)
			{
				$('#checkRelease').text("已经有该版本号，重复");
			}
			else
			{
				$('#checkRelease').text("读取数据库失败");
			}
		}
		function callbackShow(data)
		{
			for (var i = data.length-1;i >= 0; i--) 
			{
				$('#softwarePlatform').prepend("<option value='"+data[i].id+"'>"+data[i].platform+"</option>");//添加option到第一
			}
		}
		function callbackPlatform(isok)
		{
			if(isok)
			{
				var id = $('#softwareID').val();
				var platform = $('#platform').val();
				$('#softwarePlatform').prepend("<option value='"+id+"'>"+platform+"</option>");//添加option到第一
				var str= '成功添加 id:'+id+' platform:'+platform+' 的软件平台';
				alert(str);  
				$('#myModal').modal('toggle');
			}
			else
			{
				alert('添加失败'); 
			}

		}
		function callbackDebug(info)
		{
			alert(info);	
		}

</script>

</body>
</html>