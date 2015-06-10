<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	$databases=new medoo();
	$method=$_GET["method"];
	if($method=="addD"){
		if(isset($_SESSION["admin"]) && $_SESSION["admin"]==2){
			$username=$_POST["username"];
			$name=$_POST["name"];
			$password=$_POST["password"];
			$password=md5($password);
			$datas=$databases->insert("admin",array(
				"loginname"=>$username,
				"name"=>$name,
				"password"=>$password,
				"level"=>1,
				"state"=>1
			));
				$result=array();
				$result["state"]="success";
				$result["message"]="done";
				$json_result=json_encode($result);
				echo $json_result;
		}else{
			$result=array();
			$result["state"]="wrong";
			$result["message"]="no login";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else if($method=="delD"){
		$id=$_GET["id"];
		if(isset($_SESSION["admin"]) && $_SESSION["admin"]==2){
			if($id!=""){
				$datas=$databases->delete("service",array(
					"id"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]=$datas;
					$json_result=json_encode($result);
					echo $json_result;
				}else{
					$result=array();
					$result["state"]="wrong";
					$result["message"]="system wrong";
					$json_result=json_encode($result);
					echo $json_result;
				}
			}else{
				$result=array();
				$result["state"]="wrong";
				$result["message"]="no id";
				$json_result=json_encode($result);
				echo $json_result;
			}
		}else{
			$result=array();
			$result["state"]="wrong";
			$result["message"]="no login";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else{
		$result=array();
		$result["state"]="wrong";
		$result["message"]="method wrong";
		$json_result=json_encode($result);
		echo $json_result;
	}
?>