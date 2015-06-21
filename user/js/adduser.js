$(document).ready(function(){
	$("#eprice").val( $("#etype option:selected").val() );
	$("#wprice").val( $("#wtype option:selected").val() );
})
function ajax_adduser(){
	var sure=confirm("提交前请先确认数据完整性！确认提交？");
	if(sure){
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
		        	cleardata();
		        }else if(data.message=="not login"){
		        	alert("请先登录");
		        }else if(data.message=="system wrong"){
		        	alert("系统繁忙,请检查数据完整性");
		        	window.location.href=window.location.href;
		        }else if(data.message=="method wrong"){
		        	alert("调用错误的函数名");
		        }else{
		        	alert("未知的错误");
		        }
			}
		});
	}
	return false;
}
function cleardata(){
	$("#area").val("");
	$("#pay").val("");
	$("#name").val("");
	$("#address").val("");
	$("#phone").val("");
	$("#note").val("");
}
function Cetype(){
	var eprice=$("#etype option:selected").val();
	$("#eprice").val(eprice);
}
function Cwtype(){
	var wprice=$("#wtype option:selected").val();
	$("#wprice").val(wprice);
}