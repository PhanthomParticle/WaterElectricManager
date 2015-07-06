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
	//计算总页数,$count是总行数
	$sql1="SELECT DISTINCT uid FROM evalue WHERE state=0";
	$sql2="SELECT DISTINCT uid FROM wvalue WHERE state=0";
	$count1=count($databases->query($sql1)->fetchAll());
	$count2=count($databases->query($sql2)->fetchAll());
	
	if($count1>$count2){
		$count=$count1;
		$sql="SELECT DISTINCT uid FROM evalue WHERE state=0 ORDER BY time DESC LIMIT ".($page-1)*$pageSize.",".$pageSize;
	}else{
		$count=$count2;
		$sql="SELECT DISTINCT uid FROM wvalue WHERE state=0 ORDER BY time DESC LIMIT ".($page-1)*$pageSize.",".$pageSize;
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
	<link rel="stylesheet" type="text/css" href="css/card.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/card.js"></script>
</head>
<body>
	
	<!-- <p>
		<a href="adduser.php">添加用户</a>
	</p> -->
	<!-- <p>
		<?php
			
			//输出筛选条件select
			// echo "<select name=\"type\" id=\"type\">";
			// if($_GET["type"]=="area"){
			// 	echo "<option value=\"area\" selected=\"true\">区号</option>";
			// }else{
			// 	echo "<option value=\"area\">区号</option>";
			// }
			// if($_GET["type"]=="wage"){
			// 	echo "<option value=\"wage\" selected=\"true\">工资编号</option>";
			// }else{
			// 	echo "<option value=\"wage\">工资编号</option>";
			// }
			// if($_GET["type"]=="name"){
			// 	echo "<option value=\"name\" selected=\"true\">姓名</option>";
			// }else{
			// 	echo "<option value=\"name\">姓名</option>";
			// }
			// if($_GET["type"]=="address"){
			// 	echo "<option value=\"address\" selected=\"true\">地址</option>";
			// }else{
			// 	echo "<option value=\"address\">地址</option>";
			// }
			
			// echo "</select>";
			// echo "<input type=\"text\" name=\"value\" id=\"value\" value=\"".$_GET["value"]."\">";



		?>
		
		<button id="search" onclick="searchBy()">查找</button>
	</p> -->
	<p>
		
	</p>
	<?php
		$uid=$databases->query($sql)->fetchAll();
		for($i=0; $i<count($uid); $i++){
			$name=$databases->select("user","name",array(
				"AND"=>array(
					"uid"=>$uid[$i]
				)
			));
			$electric=$databases->select("evalue",array(
				"date",
				"rate",
				"price",
				"pvalue",
				"cvalue"
				),array(
					"AND"=>array(
						"uid"=>$uid[$i],
						"state"=>0
					),
					"ORDER"=>array(
						"time ASC"
					)
				)
			);
			$water=$databases->select("wvalue",array(
				"date",
				"price",
				"pvalue",
				"cvalue"
				),array(
				"AND"=>array(
					"uid"=>$uid[$i],
					"state"=>0
				),"ORDER"=>array(
					"time ASC"
				)
			));
			//计算水电总金额
			$total=0;
			for($j=0; $j<count($electric); $j++){
				$total+=( floatval($electric[$j]["cvalue"])-floatval($electric[$j]["pvalue"]) )*floatval($electric[$j]["rate"])*floatval($electric[$j]["price"]);
			}
			for($k=0; $k<count($water); $k++){
				$total+=( floatval($water[$k]["cvalue"])-floatval($water[$k]["pvalue"]) )*floatval($water[$k]["price"]);
			}
			echo "<ul class=\"list\">";
				echo "<li class=\"headli\">";
					echo "<span>户名</span>";
					echo "<span class=\"name\">".$name[0]."</span>";
					echo "<span class=\"total\">总金额</span>";
					echo "<span class=\"total\">".$total."</span>";
					echo "<a href=\"".$uid[$i]["uid"]."\">详细</a>";
				echo "</li>";
				echo "<li>";
					echo "<span>类型</span>";
					echo "<span class=\"pre\">上月读数</span>";
					echo "<span class=\"cur\">本月读数</span>";
					echo "<span class=\"sum\">总计用量</span>";
					echo "<span class=\"price\">单价</span>";
					echo "<span class=\"count\">总金额</span>";
					echo "<span class=\"time\">时间</span>";
				echo "</li>";
				for($j=0; $j<count($electric); $j++){
					echo "<li class=\"waterli\">";
						echo "<span>电表</span>";
						echo "<span class=\"pre\">".$electric[$j]["pvalue"]."</span>";
						echo "<span class=\"cur\">".$electric[$j]["cvalue"]."</span>";
						echo "<span class=\"sum\">".(intval($electric[$j]["cvalue"])-intval($electric[$j]["pvalue"]))."</span>";
						echo "<span class=\"price\">".$electric[$i]["price"]."</span>";
						echo "<span class=\"count\">".(floatval($electric[$j]["cvalue"])-floatval($electric[$j]["pvalue"]))*$electric[$j]["rate"]*floatval($electric[$j]["price"])."</span>";
						echo "<span class=\"time\">".$electric[$j]["date"]."</span>";
					echo "</li>";
				}
				echo "<hr class=\"hrli\"/>";
				for($k=0; $k<count($water); $k++){
					echo "<li class=\"waterli\">";
						echo "<span>水表</span>";
						echo "<span class=\"pre\">".$water[$k]["pvalue"]."</span>";
						echo "<span class=\"cur\">".$water[$k]["cvalue"]."</span>";
						echo "<span class=\"sum\">".(intval($water[$k]["cvalue"])-intval($water[$k]["pvalue"]))."</span>";
						echo "<span class=\"price\">".$water[$k]["price"]."</span>";
						echo "<span class=\"count\">".(floatval($water[$k]["cvalue"])-floatval($water[$k]["pvalue"]))*floatval($water[$k]["price"])."</span>";
						echo "<span class=\"time\">".$water[$k]["date"]."</span>";
					echo "</li>";
				}
			echo "</ul>";
		}

	?>
	

	<div id="pager">
	<?php

		echo "<a href=\"card.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page-1)."\">上一页</a>";
		$pageStart=($col-1)*$colSize+1;
		$pageEnd=$col*$colSize;
		for($i=$pageStart; $i<=$pageEnd; ++$i){
			if($i==$page){
				echo "<a href=\"card.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\" class=\"activep\">".$i."</a>";
			}else{
				echo "<a href=\"card.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\">".$i."</a>";
			}
		}
		echo "<a href=\"card.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page+1)."\">下一页</a>";
		echo "<input type=\"text\" name=\"topage\" id=\"topage\">";
		echo "<span>/".$pageCount."</span>";
		echo "<a href=\"card.php?type=".$_GET["type"]."&value=".$_GET["value"]."\" id=\"start\">跳转</a>";

	?>
		
	</div>

</body>
</html>