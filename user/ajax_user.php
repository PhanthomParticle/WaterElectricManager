<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	include("../func/uuid.php");
	$databases=new medoo();
	$method=$_GET["method"];
	if($method=="adduser"){
		if(isset($_SESSION["adminname"])){
			$uid=create_guid();
			$area=$_POST["area"];
			$name=$_POST["name"];
			$pay=$_POST["pay"];
			$address=$_POST["address"];
			$phone=$_POST["phone"];
			$type=$_POST["type"];
			$eprice=$_POST["eprice"];
			$wprice=$_POST["wprice"];
			$note=$_POST["note"];
			$datas=$databases->insert("user",array(
				"uid"=>$uid,
				"area"=>$area,
				"wage"=>$pay,
				"name"=>$name,
				"address"=>$address,
				"phone"=>$phone,
				"note"=>$note,
				"type"=>$type,
				"state"=>1,
				"eprice"=>$eprice,
				"wprice"=>$wprice,
				"#createtime"=>"NOW()"
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
			$result["message"]="not login";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else if($method=="delete"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->delete("user",array(
					"uid"=>$id
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
			$result["message"]="not login";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else if($method=="active"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->update("user",array(
					"state"=>1,
					"#updatetime"=>"NOW()"
					),array(
					"uid"=>$id
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
			$result["message"]="not login";
			$json_result=json_encode($result);
			echo $json_result;
		}
	}else if($method=="cancel"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->update("user",array(
					"state"=>0,
					"#updatetime"=>"NOW()"
					),array(
					"uid"=>$id
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
			$result["message"]="not login";
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