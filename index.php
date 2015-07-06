<?php
	error_reporting(null);
	session_start();
	$type=0;
	$type=$_GET["type"];
	$login=false;
	if(isset($_SESSION["adminname"])){
		$login=true;
	}else{
		$login=false;
		header("Location: login.php");
		echo "<h1>你无权管理此页面</h1>";
		exit;
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>华东交通大学水电管理系统</title>
	<link rel="stylesheet" href="./css/style.css">
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->
	<script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./js/index.js"></script>
</head>
<body>
	<div id="header">
		<a href="user/index.php" class="item">用户管理</a>
		<a href="upload/index.php" class="item">数据录入</a>
		<a href="check/index.php" class="item">账单记录</a>
		<a href="" class="item">查询数据</a>
		<a href="admin/index.php" class="item">系统设置</a>
	</div>
	<iframe name="iframe" src="" frameborder="0" id="iframe"></iframe>
</body>
</html>