<?php
	error_reporting(null);
	session_start();
	include("medoo.php");
	$databases=new medoo();
	$method=$_GET["method"];
	if($method=="login"){
		$username=$_POST["username"];
		$password=$_POST["password"];
		if($username!="" && $password!=""){
			$datas=$databases->select("admin",array(
				"loginname",
				"name",
				"password",
				"level"
				),array(
				"loginname"=>$username
			));
			$flag=strcmp($password, $datas[0]["password"]);
			if($flag==0 && $datas[0]["level"]==2){
				$_SESSION["admin"]=2;
				$_SESSION["adminname"]=$datas[0]["name"];
				$result=array();
				$result["state"]="success";
				$result["message"]="all done";
				$json_result=json_encode($result);
				echo $json_result;
			}else if($flag==0 && $datas[0]["level"]==1){
				$_SESSION["admin"]=1;
				$_SESSION["adminname"]=$datas[0]["name"];
				$result=array();
				$result["state"]="success";
				$result["message"]="all done";
				$json_result=json_encode($result);
				echo $json_result;
			}else{
				$result=array();
				$result["state"]="wrong";
				$result["message"]="password wrong";
				$json_result=json_encode($result);
				echo $json_result;
			}
		}else{
			$result=array();
			$result["state"]="wrong";
			$result["message"]="data wrong";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else if($method=="signout"){
		session_destroy();
		unset($_SESSION);
		$result=array();
		$result["state"]="success";
		$result["message"]="signout";
		$json_result=json_encode($result);
		echo $json_result;
	}else{
		$result=array();
		$result["state"]="wrong";
		$result["message"]="method wrong";
		$json_result=json_encode($result);
		echo $json_result;
	}




?>