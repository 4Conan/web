<!DOCTYPE html>
<html>
	<head>
	   <title>啊啊啊啊</title>
	   <link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	   <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	   <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<script>
			function changDisplayInfo(td)
			{
				var id='#t'+td.id;
				alert(id);
				var testdiv = document.getElementById("info");
				var html=document.querySelector(id).innerHTML;
				testdiv.innerHTML=html;
			}
			
			function clickTable(td)
			{
				alert(td.id);
			}

		</script>
		
		<style type="text/css">
			/* 媒体查询 根据 用户设备的屏幕尺寸来显示, */
			.all 				{width: 100%; 	height: 800px; background-color: pink;margin: auto;}
			.navigation			{height: 100px; background-color: lightblue; }
			.main				{height: 650px; background-color: gray;}
			.main .navLeft		{width: 15%; 	height:650px ; background-color: red; float: left;}
			.main .info			{width: 85%; 	height:650px ; background-color: lime;float: left;}
			.main .midright		{width: 0%; 	height:650px ; background-color: khaki;float: left;}
			.bottom				{height: 150px; background-color: yellow;}
			/* --------------------------------- 
			 导航栏: UL LI a 导航栏
			 1:UL 去除默认属性
			 2:li 漂浮
			 3:a变为块级元素
			 */
			.navigation ul{
				margin: 0px; 
				padding: 0px; 
				list-style-type: none;
				height: 60px;
				background-color:azure;
			}
			.navigation li {
				width: 15%;
				height: 60px;
			}
			.navigation ul li a {
				height: 45px; 
				text-align: center; 
				font-size: 22px;
				font-family: "courier new";
				font-weight: 370;
				color: white;
				text-decoration: none;
				background-color:violet;
				/* 塞泡沫 */
				padding-top:15px;
				border-right: 2px solid #838383; 
			}
		</style>
	</head>
	<body>
		<div class="all">
			
			<div class="navigation"> 							<!--头部导航-->
				<ul class="nav nav-pills">							<!--使用bootstrap现成的导航-->
					<li class="active" ><a href="#">Main</a></li>
					<li><a href="#" id="a2">用户配置</a></li>
					<li><a href="#">用户配置</a></li>
					<li><a href="#">其他</a></li>
					<li><a href="#">其他</a></li>
				</ul>
			</div>
			
			<div class="main">
				<div class="navLeft">
					<ul class="nav nav-pills nav-stacked">
					   <li><a href="javascript:void(0)" id="Set" 	 onClick="changDisplayInfo(this);" >设置</a></li>
					   <li><a href="javascript:void(0)" id="Release" onClick="changDisplayInfo(this);" >发布</a></li>
					   <li><a href="javascript:void(0)" id="Other"   onClick="changDisplayInfo(this);" >其他</a></li>
					</ul>
				</div>
				<div class="info" id="info">
					<table class=" table table-hover ">
					   <thead>
						  <tr>
							 <th>名称</th>
							 <th>权限</th>
						  </tr>
					   </thead>
					   <tbody>
						  <tr id="a" onClick="clickTable(this)">
							 <td >啊啊啊</td>
							 <td>公开</td>
						  </tr>
						  <tr id="b" onClick="clickTable(this)">
							 <td>xxxx</td>
							 <td>私有</td>
						  </tr>
					   </tbody>
					</table>
				</div>
			</div>
		</div>

		



<script type='text/template' id="tSet">
	<div class="">
		<p style="text-align:left">tSet</p>
	</div>
</script>
		
<script type='text/template' id="tRelease">
	<table class=" table table-hover ">
	   <thead>
		  <tr>
			 <th>名称</th>
			 <th>权限</th>
		  </tr>
	   </thead>
	   <tbody>
		  <tr onClick="clickTable(this)">
			 <td>啊啊啊</td>
			 <td>公开</td>
		  </tr>
		  <tr>
			 <td>xxxx</td>
			 <td>私有</td>
		  </tr>
	   </tbody>
	</table>
	
</script>
		
<script type='text/template' id="tOther">
	<div class="videojs-hero black-background-color">
	<span class="err_message">
	<p style="text-align:left">抱歉×_×播放出错了</p>
	<p></p>
	<p style="text-align:left">1.请检查您的网络并刷新页面重试 </p>
	<p style="text-align:left">2.请检查您的PC机是否没有安装Flash，下次记得要安装哦^_^</p>
	</span>
	</div>
</script>
		

		
	</body>
</html>




<!--

		<div class="navLeft">						
				   <ul class="nav nav-pills nav-stacked">		
					   <li ><a href="#">其他</a></li>
					   <li><a href="#">其他</a></li>
					   <li><a href="#">其他</a></li>
					   <li><a href="#">其他</a></li>
					   <li><a href="#">其他</a></li>
					   <li><a href="#">其他</a></li>
				   </ul>
				</div>
				
				<div class="info list-group">
					<div class="list-group">
					   <a href="#" class="list-group-item active">
						  <h4 class="list-group-item-heading">
							 公有
						  </h4>
					   </a>
					   <a href="#" class="list-group-item">
						  <h4 class="list-group-item-heading">
							 升级包
						  </h4>
						  <p class="list-group-item-text">
							 包括全部版本的升级包，定制插件及语言包。
						  </p>
					   </a>
					   <a href="#" class="list-group-item">
						  <h4 class="list-group-item-heading">
							 其他资料
						  </h4>
						  <p class="list-group-item-text">
							 包括软件说明等其他资料
						  </p>
					   </a>
					</div>
					<div class="list-group">
					   <a href="#" class="list-group-item active">
						  <h4 class="list-group-item-heading">
							 私有
						  </h4>
					   </a>
					   <a href="#" class="list-group-item">
						  <h4 class="list-group-item-heading">
							 测试
						  </h4>
						  <p class="list-group-item-text">
							 包括各个版本测试包。
						  </p>
					   </a>
					   <a href="#" class="list-group-item">
						  <h4 class="list-group-item-heading">
							 代码
						  </h4>
						  <p class="list-group-item-text">
							 包括代码，代码说明等其他资料
						  </p>
					   </a>
					</div>
				</div>
				<div class="midright"></div>
			</div>


		<ul id="myTab" class="nav nav-tabs nav-stacked">
				   	<li class="active">
						<a href="#home" data-toggle="tab">W3Cschool Home</a>
				   	</li>
					<li>
						<a href="#ios" data-toggle="tab">iOS</a>
					</li>
					<li class="dropdown">
					  <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Java<b class="caret"></b></a>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
						 <li><a href="#jmeter" tabindex="-1" data-toggle="tab">jmeter</a></li>
						 <li><a href="#ejb" tabindex="-1" data-toggle="tab">ejb</a></li>
					  </ul>
					</li>
				</ul>
				
				<div id="myTabContent" class="tab-content">
				   <div class="tab-pane fade in active" id="home">
					  <p>W3CschooolW3Cschool教程是一个提供最新的web技术站点，本站免费提供了建站相关的技术文档，帮助广大web技术爱好者快速入门并建立自己的网站。菜鸟先飞早入行——从W3Cschool开始。</p>
				   </div>
				   <div class="tab-pane fade" id="ios">
					  <p>iOS 是一个由苹果公司开发和发布的手机操作系统。最初是于 2007 年首次发布 iPhone、iPod Touch 和 Apple 
					  TV。iOS 派生自 OS X，它们共享 Darwin 基础。OS X 操作系统是用在苹果电脑上，iOS 是苹果的移动版本。</p>
				   </div>
				   <div class="tab-pane fade" id="jmeter">
					  <p>jMeter 是一款开源的测试软件。它是 100% 纯 Java 应用程序，用于负载和性能测试。</p>
				   </div>
				   <div class="tab-pane fade" id="ejb">
					  <p>Enterprise Java Beans（EJB）是一个创建高度可扩展性和强大企业级应用程序的开发架构，部署在兼容应用程序服务器（比如 JBOSS、Web Logic 等）的 J2EE 上。      </p>
				   </div>
				</div>


-->