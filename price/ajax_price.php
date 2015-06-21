<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	$databases=new medoo();
	$method=$_GET["method"];
	//---------------------------------------删除电价
	if($method=="delE"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			if(isset($_GET["id"])){
				$id=$_GET["id"];
				$datas=$databases->delete("eprice",array(
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
				$result["message"]="data wrong";
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
	//--------------------------------------删除水价
	}else if($method=="delW"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			if(isset($_GET["id"])){
				$id=$_GET["id"];
				$datas=$databases->delete("wprice",array(
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
				$result["message"]="data wrong";
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
	//-------------------------------------------增加电价
	}else if($method=="addE"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			$name=$_POST["name"];
			$price=$_POST["price"];
			$datas=$databases->insert("eprice",array(
				"name"=>$name,
				"price"=>$price
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
	//--------------------------------------增加水价
	}else if($method=="addW"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			$name=$_POST["name"];
			$price=$_POST["price"];
			$datas=$databases->insert("wprice",array(
				"name"=>$name,
				"price"=>$price
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
	//------------------------------------修改电价
	}else if($method=="modiE"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			if(isset($_GET["id"])){
				$id=$_GET["id"];
				$name=$_POST["name"];
				$price=$_POST["price"];
				$datas=$databases->update("eprice",array(
					"name"=>$name,
					"price"=>$price
				),array(
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
				$result["message"]="data wrong";
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
	//------------------------------------修改水价
	}else if($method=="modiW"){
		if(isset($_SESSION["adminname"]) && $_SESSION["level"]==2){
			if(isset($_GET["id"])){
				$id=$_GET["id"];
				$name=$_POST["name"];
				$price=$_POST["price"];
				$datas=$databases->update("wprice",array(
					"name"=>$name,
					"price"=>$price
				),array(
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
				$result["message"]="data wrong";
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