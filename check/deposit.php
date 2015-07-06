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
	
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>用户管理</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/deposit.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/deposit.js"></script>
	<script type="text/javascript">
	<?php
		echo "var uuid=\"".$_GET["id"]."\";";
	?>
	</script>
</head>
<body>
	
	<?php
		$uuid=$_GET["id"];
		if($uuid==""){
			echo "<p class=\"title\"><a href=\"user.php?page=".$_GET["page"]."\" class=\"return\">&lt;返回</a>参数错误，请按流程进入此页</p>";
			exit;
		}
		$name=$databases->select("user","name",array(
			"uid"=>$uuid
		));
		echo "<p class=\"title\"><a href=\"user.php?page=".$_GET["page"]."\" class=\"return\">&lt;返回</a>".$name[0]."</p>";
	?>
	<!-- <p>
		<input type="text" name="value" id="value" placeholder="输入押金金额">
		<button id="deposit" onclick="deposit()">提交</button>
	</p> -->
	<p>
		押金记录
	</p>
	<ul id="list">
		<li class="navi">
			<span class="autoid">提交时间</span>
			<span class="pay">金额</span>
			<span class="name">是否付款</span>
			<span class="address">付款时间</span>
			<span class="phone">是否退款</span>
			<span class="note">退款时间</span>
		</li>
		<?php
			
			$datas=$databases->select("deposit",array(
				"money",
				"ispay",
				"isback",
				"createtime",
				"paytime",
				"backtime"
				),array(
					"AND"=>array(
						"uid"=>$uuid
					),"ORDER"=>array(
						"createtime DESC"
					)
				)
			);
			for($i=0; $i<count($datas); ++$i){
				echo "<li>";
					echo "<span class=\"autoid\">".substr($datas[$i]["createtime"],0,10)."</span>";
					echo "<span class=\"pay\">".$datas[$i]["money"]."</span>";
					if($datas[$i]["ispay"]==1){
						echo "<span class=\"name\">是</span>";
						echo "<span class=\"address\">".substr($datas[$i]["paytime"],0,10)."</span>";
					}else{
						echo "<span class=\"name\">否</span>";
						echo "<span class=\"address\">&nbsp;</span>";
					}
					if($datas[$i]["isback"]==1){
						echo "<span class=\"phone\">是</span>";
						echo "<span class=\"note\">".substr($datas[$i]["backtime"],0,10)."</span>";
					}else{
						echo "<span class=\"phone\">否</span>";
						echo "<span class=\"note\">&nbsp;</span>";
					}
				echo "</li>";
				$no++;
			}


		?>
		<p>
			押金统计
		</p>
		<li class="footli navi">
			<span>提交总计</span>
			<span>已付总计</span>
			<span>未付总计</span>
			<span>已退总计</span>
			<span>未退总计</span>
			
		</li>
		<li class="footli">
			<?php
				$sum=$databases->sum("deposit","money",array(
					"uid"=>$uuid
				));
				$paysum=$databases->sum("deposit","money",array(
					"AND"=>array(
						"uid"=>$uuid,
						"ispay"=>1
					)
				));
				$nopaysum=$databases->sum("deposit","money",array(
					"AND"=>array(
						"uid"=>$uuid,
						"ispay"=>0
					)
				));
				$backsum=$databases->sum("deposit","money",array(
					"AND"=>array(
						"uid"=>$uuid,
						"isback"=>1
					)
				));
				$nobacksum=$databases->sum("deposit","money",array(
					"AND"=>array(
						"uid"=>$uuid,
						"isback"=>0
					)
				));
				echo "<span>".$sum."</span>";
				echo "<span>".$paysum."</span>";
				echo "<span>".$nopaysum."</span>";
				echo "<span>".$backsum."</span>";
				echo "<span>".$nobacksum."</span>";
			?>
		</li>
	</ul>
	<!-- <div id="pager">
	<?php

		// echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page-1)."\">上一页</a>";
		// $pageStart=($col-1)*$colSize+1;
		// $pageEnd=$col*$colSize;
		// for($i=$pageStart; $i<=$pageEnd; ++$i){
		// 	if($i==$page){
		// 		echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\" class=\"activep\">".$i."</a>";
		// 	}else{
		// 		echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".$i."\">".$i."</a>";
		// 	}
		// }
		// echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."&page=".($page+1)."\">下一页</a>";
		// echo "<input type=\"text\" name=\"topage\" id=\"topage\">";
		// echo "<span>/".$pageCount."</span>";
		// echo "<a href=\"user.php?type=".$_GET["type"]."&value=".$_GET["value"]."\" id=\"start\">跳转</a>";

	?>
		
	</div> -->

</body>
</html>