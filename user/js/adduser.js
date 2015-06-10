function ajax_adduser(){
	$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_user.php?method=adduser",
		async: true,
		data: $("#infoform").serialize(),
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("添加新用户成功");
	        	window.location.href="user.php";
	        }else if(data.message=="no login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else if(data.message=="method wrong"){
	        	alert("调用错误的函数名");
	        }else{
	        	alert("未知的错误");
	        }
		}
	});
	return false;
}