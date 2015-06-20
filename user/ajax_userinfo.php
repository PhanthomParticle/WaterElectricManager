<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	include("../func/uuid.php");
	$databases=new medoo();
	$method=$_GET["method"];
	if($method=="setinfo"){
		if(isset($_SESSION["adminname"])){
			if(isset($_GET["id"])){
				$id=$_GET["id"];
				$area=$_POST["area"];
				$name=$_POST["name"];
				$pay=$_POST["pay"];
				$address=$_POST["address"];
				$phone=$_POST["phone"];
				$type=$_POST["type"];
				$eprice=$_POST["eprice"];
				$wprice=$_POST["wprice"];
				$note=$_POST["note"];
				$datas=$databases->update("user",array(
					"area"=>$area,
					"wage"=>$pay,
					"name"=>$name,
					"address"=>$address,
					"phone"=>$phone,
					"note"=>$note,
					"type"=>$type,
					"eprice"=>$eprice,
					"wprice"=>$wprice
					),array(
					"uid"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="done";
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
	}else if($method=="getinfo"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->select("user",array(
					"area",
					"wage",
					"name",
					"address",
					"phone",
					"note",
					"type",
					"eprice",
					"wprice"
					),array(
					"uid"=>$id
				));
				if(count($datas)>0){
					$result=array();
					$result["state"]="success";
					$result["message"]=$datas;
					$result["result"]=$datas[0];
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
	}else if($method=="addE"){
		$id=$_POST["uuid"];
		$ename=$_POST["ename"];
		$rate=$_POST["rate"];
		$notee=$_POST["notee"];
		$inite=$_POST["inite"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->select("electric","id",array(
					"AND"=>array(
						"name"=>$ename,
						"uid"=>$id
					)
				));
				if(count($datas)>0){
					$result=array();
					$result["state"]="wrong";
					$result["message"]="already";
					$json_result=json_encode($result);
					echo $json_result;
				}else{
					$datas=$databases->insert("electric",array(
						"name"=>$ename,
						"uid"=>$id,
						"rate"=>$rate,
						"note"=>$notee,
						"init"=>$inite
					));
					if($datas>0){
						$result=array();
						$result["state"]="success";
						$result["message"]="done";
						$json_result=json_encode($result);
						echo $json_result;
					}else{
						$result=array();
						$result["state"]="wrong";
						$result["message"]="system wrong";
						$json_result=json_encode($result);
						echo $json_result;
					}
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
	}else if($method=="addW"){
		$id=$_POST["uuid"];
		$wname=$_POST["wname"];
		$notew=$_POST["notew"];
		$initw=$_POST["initw"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->select("water","id",array(
					"AND"=>array(
						"name"=>$wname,
						"uid"=>$id
					)
				));
				if(count($datas)>0){
					$result=array();
					$result["state"]="wrong";
					$result["message"]="already";
					$json_result=json_encode($result);
					echo $json_result;
				}else{
					$datas=$databases->insert("water",array(
						"name"=>$wname,
						"uid"=>$id,
						"note"=>$notew,
						"init"=>$initw
					));
					if($datas>0){
						$result=array();
						$result["state"]="success";
						$result["message"]="done";
						$json_result=json_encode($result);
						echo $json_result;
					}else{
						$result=array();
						$result["state"]="wrong";
						$result["message"]="system wrong";
						$json_result=json_encode($result);
						echo $json_result;
					}
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
	}else if($method=="modiE"){
		$id=$_POST["id"];
		$ename=$_POST["ename"];
		$rate=$_POST["rate"];
		$notee=$_POST["notee"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->update("electric",array(
					"name"=>$ename,
					"rate"=>$rate,
					"note"=>$notee
					),array(
					"id"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="done";
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
	}else if($method=="modiW"){
		$id=$_POST["id"];
		$wname=$_POST["wname"];
		$notew=$_POST["notew"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->update("water",array(
					"name"=>$wname,
					"note"=>$notew
					),array(
					"id"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="done";
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
	}else if($method=="delE"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->delete("electric",array(
					"id"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="done";
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
	}else if($method=="delW"){
		$id=$_GET["id"];
		if(isset($_SESSION["adminname"])){
			if($id!=""){
				$datas=$databases->delete("water",array(
					"id"=>$id
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="done";
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