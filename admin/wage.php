<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	$databases=new medoo();
	if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){

	}else{
		echo "你没有权限管理此页面";
		exit;
	}




?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>工资财务管理员</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/admindata.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/wage.js"></script>
</head>
<body>
	<div id="addServiceBox">
		<form action="" id="ServiceForm">
			<p>
				<input type="text" name="username" placeholder="登录账号">
			</p>
			<p>
				<input type="text" name="name" placeholder="名字">
			</p>
			<p>
				<input type="text" name="password" placeholder="登录密码">
			</p>
			<p>
				<span onclick="addService()">提交</span>
				<span onclick="closeBox()">取消</span>
			</p>
		</form>
	</div>
	<p>
		<span id="addService" onclick="closeBox()">增加管理员</span>
	</p>
	<ul id="list">
		<?php
			$datas=$databases->select("admin",array(
				"id",
				"loginname",
				"name",
				"password"
			),array(
				"level"=>5
			));
			for($i=0; $i<count($datas); ++$i){
				echo "<li>";
					echo "<span class=\"id\">".($i+1)."</span>";
					echo "<span class=\"username\">".$datas[$i]["loginname"]."</span>";
					echo "<span class=\"name\">".$datas[$i]["name"]."</span>";
					echo "<span class=\"password\">".$datas[$i]["password"]."</span>";
					echo "<a href=\"".$datas[$i]["id"]."\" class=\"delete\">删除</a>";
				echo "</li>";
			}
		?>
		
		
	</ul>
</body>
</html>