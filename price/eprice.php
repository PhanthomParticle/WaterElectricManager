<?php
	// error_reporting(null);
	// session_start();
	// include("../medoo.php");
	// $databases=new medoo();
	// if(isset($_SESSION["admin"]) && $_SESSION["admin"]==2){

	// }else{
	// 	echo "你没有权限管理此页面";
	// 	exit;
	// }




?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>电价管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/eprice.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/eprice.js"></script>
</head>
<body>
	<div id="addServiceBox">
		<form action="" id="ServiceForm">
			<p>
				<input type="text" name="name" id="name" placeholder="名字">
			</p>
			<p>
				<input type="text" name="price" id="price" placeholder="电价">
			</p>
			
			<p id="func">
				
			</p>
		</form>
	</div>
	<p>
		<span id="addService" onclick="openadd()">增加电价类型</span>
	</p>
	<ul id="list">
		<li>
			<span class="autoid">1</span>
			<span class="name">商用电价</span>
			<span class="price">1.2</span>
			<a href="1" class="modify">修改</a>
			<a href="1" class="del">删除</a>
		</li>
		<li>
			<span class="autoid">1</span>
			<span class="name">民用电价</span>
			<span class="price">1.2</span>
			<a href="1" class="modify">修改</a>
			<a href="1" class="del">删除</a>
		</li>

		<li>
			<span class="autoid">1</span>
			<span class="name">工业电价</span>
			<span class="price">1.2</span>
			<a href="1" class="modify">修改</a>
			<a href="1" class="del">删除</a>
		</li>

		
		
	</ul>
</body>
</html>