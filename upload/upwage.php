<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	$databases=new medoo();
	if(isset($_SESSION["adminname"])){

	}else{
		echo "你没有权限管理此页面";
		exit;
	}

	//页数大小
	$pageSize=20;
	//获取访问的页数
	if($_GET["page"]>0){
		$page=$_GET["page"];
	}else{
		$page=1;
	}
	//计算总页数
	$count=$databases->count("user",array(
		"OR"=>array(
			"type"=>1,
			"type"=>2
		),
		"ORDER"=>array(
			"id DESC"
		)
	));
	if(($count%$pageSize)==0){
		$pageCount=floor($count/$pageSize);
	}else{
		$pageCount=floor($count/$pageSize)+1;
	}
	//列大小
	$colSize=10;
	//计算第几列
	if(($page%$colSize)==0){
		$col=floor($page/$colSize);
	}else{
		$col=floor($page/$colSize)+1;
	}
	
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>代扣用户数据录入</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/upwage.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/json2.js"></script>
	<script type="text/javascript" src="js/upwage.js"></script>
	<script type="text/javascript">
	<?php
		$datas=$databases->select("user",array(
			"uid",
			"name",
			"address",
			"phone",
			"eprice",
			"wprice"
			),array(
			"OR"=>array(
				"type"=>1,
				"type"=>2
			),
			"ORDER"=>array(
				"id DESC"
			),
			"LIMIT"=>array(($page-1)*$pageSize,$pageSize)
		));




	?>

	</script>
</head>
<body>
	<div id="upload">
		<ul>
			<input type="hidden" name="u0" id="u0" value="sadlkjrlk2143214">
			<p class="title">
				<span>姓名:蓝先生</span>
				<span>地址:北区36栋一单元6024</span>
				<span>电话:18720960056</span>
			</p>
			<li>
				<span>36栋1号</span>
				<input type="text" name="u0e0" id="u0e0" readonly="true">
				<input type="text" name="u0e1" id="u0e1">
				<span class="note">申请停用</span>
			</li>
			<li>
				<span>36栋1号</span>
				<input type="text" name="u0e0" id="u0e0">
				<input type="text" name="u0e1" id="u0e1">
			</li>
			<li>
				<span>36栋1号</span>
				<input type="text" name="u0e0" id="u0e0">
				<input type="text" name="u0e1" id="u0e1">
			</li>
			<p class="sort">水表</p>
			<li>
				<span>36栋1号</span>
				<input type="text" name="u0w0" id="u0w0">
				<input type="text" name="u0w1" id="u0w1">
			</li>
			<li>
				<span>36栋1号</span>
				<input type="text" name="u0w0" id="u0w0">
				<input type="text" name="u0w1" id="u0w1">
			</li>
		</ul>
		
		
	</div>
	<div id="save">
		<span onclick="SaveData()">提交</span>
	</div>
	<div id="pager">
	<?php

		echo "<a href=\"upwage.php?page=".($page-1)."\">上一页</a>";
		$pageStart=($col-1)*$colSize+1;
		$pageEnd=$col*$colSize;
		for($i=$pageStart; $i<=$pageEnd; ++$i){
			if($i==$page){
				echo "<a href=\"upwage.php?page=".$i."\" class=\"active\">".$i."</a>";
			}else{
				echo "<a href=\"upwage.php?page=".$i."\">".$i."</a>";
			}
		}
		echo "<a href=\"upwage.php?page=".($page+1)."\">下一页</a>";
		echo "<input type=\"text\" name=\"topage\" id=\"topage\">";
		echo "<span>/".$pageCount."</span>";
		echo "<a href=\"\" id=\"start\">跳转</a>";

	?>
	</div>
</body>
</html>