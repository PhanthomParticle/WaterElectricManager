<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	$databases=new medoo();
	$type=0;
	$type=$_GET["type"];
	$login=false;
	if(isset($_SESSION["adminname"])){
		$login=true;
	}else{
		$login=false;
		echo "<h1>你无权管理此页面</h1>";
		exit;
	}
	

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>用户管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
</head>
<body>
	<div id="header">
		
		
		<a href="upwage.php" class="item">非现金用户</a>
		
		
		
		
		
	</div>
	<iframe id="content" src="">
		你的浏览器不支持iframe，强烈推荐使用 chrome 浏览器
	</iframe>
</body>
</html>