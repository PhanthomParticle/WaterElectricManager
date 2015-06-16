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
	<title>水价管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/wprice.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/wprice.js"></script>
</head>
<body>
	<div id="addServiceBox">
		<form action="" id="ServiceForm">
			<p>
				<input type="text" name="name" id="name" placeholder="名字">
			</p>
			<p>
				<input type="text" name="price" id="price" placeholder="水价">
			</p>
			
			<p id="func">
				
			</p>
		</form>
	</div>
	<p>
		<span id="addService" onclick="openadd()">增加水价类型</span>
	</p>
	<ul id="list">
		<?php
			$datas=$databases->select("wprice",array(
				"id",
				"name",
				"price"
			));
			for($i=0; $i<count($datas); ++$i){
				echo "<li>";
					echo "<span class=\"autoid\">".($i+1)."</span>";
					echo "<span class=\"name\">".$datas[$i]["name"]."</span>";
					echo "<span class=\"price\">".$datas[$i]["price"]."</span>";
					echo "<a href=\"".$datas[$i]["id"]."\" class=\"modify\">修改</a>";
					echo "<a href=\"".$datas[$i]["id"]."\" class=\"del\">删除</a>";
				echo "</li>";
			}

		?>
		
	</ul>
</body>
</html>