$(document).ready(function(){
	$(".delete").click(function(){
		var uuid=$(this).attr("href") || null;
		if(uuid!=null){
			var sure=confirm("确定删除？");
			if(sure){
				$.get("ajax_user.php?method=delete",{"id":uuid},function(data){
					if(data.state=="success"){
						alert("删除成功");
						window.location.href=window.location.href;
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="no id"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
					}else if(data.message=="system wrong"){
						alert("系统繁忙");
					}else{
						alert("未知的错误");
						window.location.href=window.location.href;
					}
				},"json");
			}
		}else{
			alert("参数错误，请刷新页面");
		}

		return false;
	});
	$(".cancel").click(function(){
		var uuid=$(this).attr("href") || null;
		if(uuid!=null){
			var sure=confirm("确定注销？");
			if(sure){
				$.get("ajax_user.php?method=cancel",{"id":uuid},function(data){
					if(data.state=="success"){
						alert("注销成功");
						window.location.href=window.location.href;
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="no id"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
					}else if(data.message=="system wrong"){
						alert("系统繁忙");
					}else{
						alert("未知的错误");
						window.location.href=window.location.href;
					}
				},"json");
			}
		}else{
			alert("参数错误，请刷新页面");
		}

		return false;
	});
	$(".active").click(function(){
		var uuid=$(this).attr("href") || null;
		if(uuid!=null){
			var sure=confirm("确定激活？");
			if(sure){
				$.get("ajax_user.php?method=active",{"id":uuid},function(data){
					if(data.state=="success"){
						alert("激活成功");
						window.location.href=window.location.href;
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="no id"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
					}else if(data.message=="system wrong"){
						alert("系统繁忙");
					}else{
						alert("未知的错误");
						window.location.href=window.location.href;
					}
				},"json");
			}
		}else{
			alert("参数错误，请刷新页面");
		}

		return false;
	});
	$("#start").click(function(){
		var page=$("#topage").val() || 1;
		var baseurl=$(this).attr("href");
		window.location.href=baseurl+"&page="+page;
		return false;
	});
});
function searchBy(){
	var type=$("#type option:selected").val();
	var value=$("#value").val();
	window.location.href="noback.php?type="+type+"&value="+value+"&page=1";
	return false;
}
