<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>水电管理系统登陆</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="body">
	<div id="border">
		<div>
			<span class="in-name">用户名</span>
			<input type="text" name="username" id="username">
		</div>
		<div>
			<span class="in-name">密码</span>
			<input type="password" name="password" id="password">
		</div>
		<div>
			<span id="submit" onclick="login()">登陆</span>
		</div>
	</div>
	<div id="bgcolor"></div>
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.md5.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>