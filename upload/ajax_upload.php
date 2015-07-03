<?php
	error_reporting(null);
	session_start();
	include("../medoo.php");
	include("../func/date.php");
	$databases=new medoo();
	$method=$_GET["method"];
	
	if($method=="upwage"){
		if(isset($_SESSION["adminname"])){
			if(isset($_POST["JsonData"])){
				$JsonData=$_POST["JsonData"];
				$json=json_decode($JsonData);
				$date=GetYearMonth();
				for($i=0; $i<count($json); ++$i){
					//保存用户电表读表信息
					for($j=0; $j<count($json[$i]->electric); ++$j){
						//判断是否填写了本月读表数
						if("" != $json[$i]->electric[$j]->cvalue){
							//判断本月该用户的该电表是否已经存在读表数
							$allow=$databases->count("evalue",array(
								"AND"=>array(
									"uid"=>$json[$i]->uid,
									"date"=>$date,
									"eid"=>$json[$i]->electric[$j]->id
								)
							));
							if($allow>0){
								$flag=$databases->update("evalue",array(
									"cvalue"=>$json[$i]->electric[$j]->cvalue
									),array(
									"AND"=>array(
										"uid"=>$json[$i]->uid,
										"date"=>$date,
										"eid"=>$json[$i]->electric[$j]->id
									)
								));
							}else{
								$flag=$databases->insert("evalue",array(
									"uid"=>$json[$i]->uid,
									"date"=>$date,
									"eid"=>$json[$i]->electric[$j]->id,
									"rate"=>$json[$i]->electric[$j]->rate,
									"price"=>$json[$i]->eprice,
									"pvalue"=>$json[$i]->electric[$j]->pvalue,
									"cvalue"=>$json[$i]->electric[$j]->cvalue,
									"state"=>0
								));
							}
						}
					}//保存电表读表数结束
					//保存用户水表读表信息
					for($k=0; $k<count($json[$i]->water); ++$k){
						//判断是否填写了本月读表数
						if("" != $json[$i]->water[$k]->cvalue){
							//判断本月该用户的该水表是否已经存在读表数
							$allow=$databases->count("wvalue",array(
								"AND"=>array(
									"uid"=>$json[$i]->uid,
									"date"=>$date,
									"wid"=>$json[$i]->water[$k]->id
								)
							));
							if($allow>0){
								$flag=$databases->update("wvalue",array(
									"cvalue"=>$json[$i]->water[$k]->cvalue
									),array(
									"AND"=>array(
										"uid"=>$json[$i]->uid,
										"date"=>$date,
										"wid"=>$json[$i]->water[$k]->id
									)
								));
							}else{
								$flag=$databases->insert("wvalue",array(
									"uid"=>$json[$i]->uid,
									"date"=>$date,
									"wid"=>$json[$i]->water[$k]->id,
									"price"=>$json[$i]->wprice,
									"pvalue"=>$json[$i]->water[$k]->pvalue,
									"cvalue"=>$json[$i]->water[$k]->cvalue,
									"state"=>0
								));
							}
						}
					}//保存水表读表数结束
				}
				$result=array();
				$result["state"]="success";
				$result["message"]="all done";
				$json_result=json_encode($result);
				echo $json_result;
			}else{
				$result=array();
				$result["state"]="wrong";
				$result["message"]="data lost";
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
	}else if($method=="upcash"){
		if(isset($_SESSION["adminname"])){
			if(isset($_POST["JsonData"])){
				$JsonData=$_POST["JsonData"];
				$json=json_decode($JsonData);
				$date=GetYearMonth();
				for($i=0; $i<count($json); ++$i){
					//保存用户电表读表信息
					for($j=0; $j<count($json[$i]->electric); ++$j){
						//判断是否填写了本月读表数
						if("" != $json[$i]->electric[$j]->cvalue){
							$flag=$databases->insert("evalue",array(
								"uid"=>$json[$i]->uid,
								"date"=>$date,
								"eid"=>$json[$i]->electric[$j]->id,
								"rate"=>$json[$i]->electric[$j]->rate,
								"price"=>$json[$i]->eprice,
								"pvalue"=>$json[$i]->electric[$j]->pvalue,
								"cvalue"=>$json[$i]->electric[$j]->cvalue,
								"state"=>0
							));
						}
					}//保存电表读表数结束
					//保存用户水表读表信息
					for($k=0; $k<count($json[$i]->water); ++$k){
						//判断是否填写了本月读表数
						if("" != $json[$i]->water[$k]->cvalue){
							$flag=$databases->insert("wvalue",array(
								"uid"=>$json[$i]->uid,
								"date"=>$date,
								"wid"=>$json[$i]->water[$k]->id,
								"price"=>$json[$i]->wprice,
								"pvalue"=>$json[$i]->water[$k]->pvalue,
								"cvalue"=>$json[$i]->water[$k]->cvalue,
								"state"=>0
							));
						}
					}//保存水表读表数结束
				}
				$result=array();
				$result["state"]="success";
				$result["message"]="all done";
				$json_result=json_encode($result);
				echo $json_result;
			}else{
				$result=array();
				$result["state"]="wrong";
				$result["message"]="data lost";
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
	}else if($method=="setDep"){
		if(isset($_SESSION["adminname"])){
			if(isset($_GET["money"]) && isset($_GET["uid"])){
				$datas=$databases->insert("deposit",array(
					"uid"=>$_GET["uid"],
					"money"=>$_GET["money"],
					"ispay"=>0,
					"isback"=>0
				));
				if($datas>0){
					$result=array();
					$result["state"]="success";
					$result["message"]="all done";
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
				$result["message"]="data lost";
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