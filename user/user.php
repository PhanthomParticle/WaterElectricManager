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
	if($_GET["type"]!="" && $_GET["value"]!=""){
		$count=$databases->count("user",array(
			$_GET["type"]."[~]"=>$_GET["value"]
		));
	}else{
		$count=$databases->count("user");
	}
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
	<title>用户管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/user.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/user.js"></script>
</head>
<body>
	
	<!-- <p>
		<a href="adduser.php">添加用户</a>
	</p> -->
	<p>
		<?php
			
			
			echo "<select name=\"type\" id=\"type\">";
			if($_GET["type"]=="area"){
				echo "<option value=\"area\" selected=\"true\">区号</option>";
			}else{
				echo "<option value=\"area\">区号</option>";
			}
			if($_GET["type"]=="wage"){
				echo "<option value=\"wage\" selected=\"true\">工资编号</option>";
			}else{
				echo "<option value=\"wage\">工资编号</option>";
			}
			if($_GET["type"]=="name"){
				echo "<option value=\"name\" selected=\"true\">姓名</option>";
			}else{
				echo "<option value=\"name\">姓名</option>";
			}
			if($_GET["type"]=="address"){
				echo "<option value=\"address\" selected=\"true\">地址</option>";
			}else{
				echo "<option value=\"address\">地址</option>";
			}
			
			echo "</select>";
			echo "<input type=\"text\" name=\"value\" id=\"value\" value=\"".$_GET["value"]."\">";



		?>
		
		<button id="search" onclick="searchBy()">查找</button>
	</p>
	<ul id="list">
		<li class="navi">
			<span class="autoid">序号</span>
			<span class="pay">工资编号</span>
			<span class="name">姓名</span>
			<span class="address">地址</span>
			<span class="phone">电话</span>
			<span class="note">备注</span>
		</li>
		<?php
			if($_GET["type"]!="" && $_GET["value"]!=""){
				$datas=$databases->select("user",array(
					"uid",
					"wage",
					"name",
					"address",
					"phone",
					"note",
					"state"
					),array(
						$_GET["type"]."[~]"=>$_GET["value"],
						"LIMIT"=>array(($page-1)*$pageSize,$pageSize)
					)
				);
			}else{
				$datas=$databases->select("user",array(
					"uid",
					"wage",
					"name",
					"address",
					"phone",
					"note",
					"state"
					),array(
					"LIMIT"=>array(($page-1)*$pageSize,$pageSize)
				));
			}

			$no=($page-1)*$pageSize+1;
			for($i=0; $i<count($datas); ++$i){
				echo "<li>";
					echo "<span class=\"autoid\">".$no."</span>";
					echo "<span class=\"pay\">".$datas[$i]["wage"]."</span>";
					echo "<span class=\"name\">".$datas[$i]["name"]."</span>";
					echo "<span class=\"address\">".$datas[$i]["address"]."</span>";
					echo "<span class=\"phone\">".$datas[$i]["phone"]."</span>";
					echo "<span class=\"note\">".$datas[$i]["note"]."</span>";
					echo "<a href=\"userinfo.php?id=".$datas[$i]["uid"]."\" class=\"detail\">详情</a>";
					echo "<a href=\"".$datas[$i]["uid"]."\" class=\"delete\">删除</a>";
					if($datas[$i]["state"]==1){
						echo "<a href=\"".$datas[$i]["uid"]."\" class=\"cancel\">注销</a>";
					}else{
						echo "<a href=\"".$datas[$i]["uid"]."\" class=\"active\">激活</a>";
					}
				echo "</li>";
				$no++;
			}


		?>

		
		
		
	</ul>
	<div id="pager">
	<?php

		echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page-1)."\">上一页</a>";
		$pageStart=($col-1)*$colSize+1;
		$pageEnd=$col*$colSize;
		for($i=$pageStart; $i<=$pageEnd; ++$i){
			if($i==$page){
				echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\" class=\"activep\">".$i."</a>";
			}else{
				echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\">".$i."</a>";
			}
		}
		echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page+1)."\">下一页</a>";
		echo "<input type=\"text\" name=\"topage\" id=\"topage\">";
		echo "<span>/".$pageCount."</span>";
		echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."\" id=\"start\">跳转</a>";

	?>
		
	</div>

</body>
</html>