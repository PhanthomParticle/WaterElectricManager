$(document).ready(function(){
	
});
function deposit(){
	var value=$("#value").val();
	if(value=="" || uuid==""){
		alert("金额或uid参数错误");
	}else{
		$.ajax({
			cache: false,
			type: "GET",
			url:"ajax_upload.php?method=setDep",
			async: true,
			data: {"uid":uuid,"money":value},
			dataType:"json",
			error: function(request){
				alert("连接失败,请检查网络连接");
			},
			success: function(data) {
			    if(data.state=="success"){
			    	alert("押金提交成功");
			    	window.location.href=window.location.href;
			    }else if(data.message=="not login"){
			    	alert("请先登录");
			    }else if(data.message=="data lost"){
			    	alert("数据丢失,请检查数据完整性");
			    	window.location.href=window.location.href;
			    }else if(data.message=="method wrong"){
			    	alert("调用错误的函数名");
			    }else if(data.message=="system wrong"){
			    	alert("系统繁忙，请检查数据完整性");
			    	window.location.href=window.location.href;
			    }else{
			    	alert("未知的错误");
			    	window.location.href=window.location.href;
			    }
			}
		});
	}
	return false;
}
