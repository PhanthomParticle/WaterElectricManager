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
	<title>用户管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/user.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/user.js"></script>
</head>
<body>
	
	<p>
		<a href="adduser.php">添加用户</a>
	</p>
	<ul id="list">
		<li>
			<span class="autoid">1</span>
			<span class="pay">12345678</span>
			<span class="name">蓝先生</span>
			<span class="address">北区36栋1单元6024房</span>
			<span class="phone">18720960056</span>
			<a href="1" class="detail">详情</a>
			<a href="2" class="delete">删除</a>
			<a href="3" class="cancel">注销</a>
		</li>
		
		
	</ul>
</body>
</html>