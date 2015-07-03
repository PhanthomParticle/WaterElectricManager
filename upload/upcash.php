<?php
	// error_reporting(null);
	session_start();
	include("../medoo.php");
	include("../func/date.php");
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
		"AND"=>array(
			"state"=>1,
			"OR"=>array(
				"type"=>array(3)
			)
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
	<title>现金用户数据录入</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/upcash.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/json2.js"></script>
	<script type="text/javascript" src="js/upcash.js"></script>

	<script type="text/javascript">
	<?php
		//查询用户基本信息
		$datas=$databases->select("user",array(
			"uid",
			"name",
			"address",
			"phone",
			"eprice",
			"wprice"
			),array(
			"AND"=>array(
				"state"=>1,
				"OR"=>array(
					"type"=>array(3)
				)
			),
			"ORDER"=>array(
				"id DESC"
			),
			"LIMIT"=>array(($page-1)*$pageSize,$pageSize)
		));
		
		$result=array();
		for($i=0; $i<count($datas); $i++){
			//创建用户基本信息对象数组
			$result[$i]=array();
			$result[$i]=$datas[$i];
			//查询用户电表信息
			$result[$i]["electric"]=array();
			$electric=$databases->select("electric",array(
				"id",
				"name",
				"rate",
				"note",
				"init"
				),array(
				"uid"=>$datas[$i]["uid"]
			));
			$result[$i]["electric"]=$electric;
			for($j=0; $j<count($result[$i]["electric"]); ++$j){
				$date=GetYearMonth();
				//获取上次的读表数
				$cvalue=$databases->select("evalue",array(
					"cvalue"
					),array(
					"AND"=>array(
						"uid"=>$result[$i]["uid"],
						"eid"=>$result[$i]["electric"][$j]["id"]
					),"ORDER"=>array(
						"time DESC"
					),"LIMIT"=>array(0,1)
				));
				//判断上次是否已经上传了读表数
				if(count($cvalue)>0){
					$result[$i]["electric"][$j]["pvalue"]=$cvalue[0]["cvalue"];
				}else{
					$result[$i]["electric"][$j]["pvalue"]=$result[$i]["electric"][$j]["init"];
				}
				//把本月读表数设为空
				$result[$i]["electric"][$j]["cvalue"]="";
			}//查询用户电表信息结束

			//查询用户水表信息
			$result[$i]["water"]=array();
			$water=$databases->select("water",array(
				"id",
				"name",
				"note",
				"init"
				),array(
				"uid"=>$datas[$i]["uid"]
			));
			$result[$i]["water"]=$water;
			for($k=0; $k<count($result[$i]["water"]); ++$k){
				$date=GetYearMonth();
				//获取上次的读表数
				$cvalue=$databases->select("wvalue",array(
					"cvalue"
					),array(
					"AND"=>array(
						"uid"=>$result[$i]["uid"],
						"wid"=>$result[$i]["water"][$k]["id"]
					),"ORDER"=>array(
						"time DESC"
					),"LIMIT"=>array(0,1)
				));
				//判断上次是否已经上传了读表数
				if(count($cvalue)>0){
					$result[$i]["water"][$k]["pvalue"]=$cvalue[0]["cvalue"];
				}else{
					$result[$i]["water"][$k]["pvalue"]=$result[$i]["water"][$k]["init"];
				}
				//把本月读表数设为空
				$result[$i]["water"][$k]["cvalue"]="";
			}//查询用户水表信息结束
		}
		echo "var UserData=".json_encode($result).";";
	?>
	</script>
</head>
<body>
	<div id="upload">
		<!-- <ul>
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
		</ul> -->
		
		
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