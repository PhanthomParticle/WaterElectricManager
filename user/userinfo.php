<?php
	// error_reporting(null);
	// session_start();
	// include("../medoo.php");
	// $databases=new medoo();
	// if(isset($_SESSION["admin"]) && $_SESSION["admin"]==2){

	// }else{
	// 	echo "你没有权限管理此页面";
	// 	exit;
	// }




?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title>用户详细信息</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<link rel="stylesheet" type="text/css" href="css/userinfo.css">
	<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/userinfo.js"></script>
</head>
<body>
	
	<p class="title"><a href="user.php" class="return">&lt;返回</a>用户详细信息</p>
	<!-- 电表弹出框 -->
	<div id="ebox">
		<form action="" id="eform">
			<p>
				<input type="text" name="ename" id="ename" placeholder="电表编号">
			</p>
			<p>
				<input type="text" name="rate" id="rate" placeholder="倍率">
			</p>
			
			<p id="efunc">
				
			</p>
		</form>
	</div>
	<!--  -->
	<!--  -->
	<div id="wbox">
		<form action="" id="wform">
			<p>
				<input type="text" name="wname" id="wname" placeholder="水表编号">
			</p>			
			<p id="wfunc">
				
			</p>
		</form>
	</div>
	<!--  -->

	<div id="userinfo">
		<form action="" method="POST" action="ajax_user.php?method=setinfo" id="infoform">
			<ul>
				<li>
					<span class="item">区号</span>
					<input type="text" name="area" id="area">
				</li>
				<li>
					<span class="item">工资编号</span>
					<input type="text" name="pay" id="pay">				
				</li>
				<li>
					<span class="notice">若不是工资扣款用户，此项可不填</span>
				</li>
				<li>
					<span class="item">用户姓名</span>
					<input type="text" name="name" id="name">
				</li>
				<li>
					<span class="item">用户地址</span>
					<input type="text" name="address" id="address">
				</li>
				<li>
					<span class="item">用户电话</span>
					<input type="text" name="phone" id="phone">
				</li>
				<li>
					<span class="item">用户类型</span>
					<select name="type" id="type">
						<option value="1">工资扣款</option>
					</select>
				</li>
				<li>
					<span class="item">电价类型</span>
					<select name="etype" id="etype">
						<option value="1">居民用电</option>
					</select>
				</li>
				<li>
					<span class="item">电价</span>
					<input type="text" name="eprice" id="eprice">					
				</li>
				<li>
					<span class="notice">电价以此处的数值为准,不超过两位小数</span>
				</li>
				<li>
					<span class="item">水价类型</span>
					<select name="wtype" id="wtype">
						<option value="1">居民用水</option>
					</select>
				</li>
				<li>
					<span class="item">水价</span>
					<input type="text" name="wprice" id="wprice">				
				</li>
				<li>
					<span class="notice">水价以此处的数值为准,不超过两位小数</span>
				</li>
				<li class="note">
					<span class="item">备注</span>
					<textarea name="note" id="note"></textarea>
				</li>
			</ul>
			<p style="text-align:center;">
				<input type="submit" value="提交" id="submit">
			</p>
		</form>
	</div>
	<p class="title">用户电表信息 <span class="add" onclick="openeadd()">增加电表</span></p>
	<div id="electric">
		<ul>
			<li>
				<span>1</span>
				<span>编号:</span>
				<span>201</span>
				<span>倍率:</span>
				<span>4</span>
				<span>备注:</span>
				<span>什大幅度飞地方附带</span>
				<a href="25626" class="delE">删除</a>
				<a href="1231" class="modifyE">修改</a>
			</li>
			
		</ul>
	</div>
	<p class="title">用户水表信息 <span class="add" onclick="openwadd()">增加水表</span></p>
	<div id="water">
		<ul>
			<li>
				<span>1</span>
				<span>编号:</span>
				<span>201</span>
				<span>备注:</span>
				<span>什大幅度飞地方附带</span>
				<a href="25626" class="delW">删除</a>
				<a href="1231" class="modifyW">修改</a>
			</li>
			
		</ul>
	</div>
</body>
</html>