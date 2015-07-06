$(document).ready(function(){
	$(".del").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			var sure=confirm("确定删除？");
			if(sure){
				$.get("ajax_price.php?method=delE",{"id":id},function(data){
					if(data.state=="success"){
						window.location.href=window.location.href;
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="data wrong"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
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
	$(".modify").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			Gid=id;
			var name=$(this).prev().prev().text();
			var price=$(this).prev().text();
			$("#name").val(name);
			$("#price").val(price);
			var html="<span onclick=\"ajaxmodify()\">修改</span><span onclick=\"closeBox()\">取消</span>";
			$("#func").html(html);
			closeBox();
		}else{
			alert("参数错误，请刷新页面");
		}

		return false;
	});
})
var Gid=0;
var display=false;
function ajaxmodify(){
	$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_price.php?method=modiE&id="+Gid,
		async: true,
		data: $("#ServiceForm").serialize(),
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("修改成功");
	        	closeBox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else{
	        	alert("未知的错误,请刷新页面");
	        }
		}
	});
	return false;
}
function ajaxadd(){
	$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_price.php?method=addE",
		async: true,
		data: $("#ServiceForm").serialize(),
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("添加成功");
	        	closeBox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else{
	        	alert("未知的错误");
	        }
		}
	});
	return false;
}
function openadd(){
	var html="<span onclick=\"ajaxadd()\">增加</span><span onclick=\"closeBox()\">取消</span>";
	$("#name").val("");
	$("#price").val("");
	$("#func").html(html);
	closeBox();
}
function setPrice(){
	var area=$("#area").val();
	var price=$("#setPrice").val();
	if(area=="" || price==""){
		alert("请输入区号和价格");
	}else{
		$.ajax({
			cache: false,
			type: "GET",
			url:"ajax_price.php?method=setEByArea",
			async: true,
			data: {"area": area,"price": price},
			dataType:"json",
			error: function(request){
				alert("连接失败");
			},
			success: function(data) {
		        if(data.state=="success"){
		        	alert("已设置 "+area+" 区 "+data.message+" 户的电价为 "+price);
		        	window.location.href=window.location.href;
		        }else if(data.message=="not login"){
		        	alert("请先登录");
		        }else if(data.message=="system wrong"){
		        	alert("系统繁忙");
		        	window.location.href=window.location.href;
		        }else if(data.message=="data lost"){
		        	alert("数据丢失，请检查数据完整性");
		        }else{
		        	alert("未知的错误");
		        }
			}
		});
	}
}
function closeBox(){
	if(display){
		document.getElementById('addServiceBox').style.width="560px";
		document.getElementById('addServiceBox').style.height="400px";
		document.getElementById('addServiceBox').style.paddingTop="220px";
		document.getElementById('addServiceBox').style.opacity="0";
		document.getElementById('addServiceBox').style.zIndex="-10";
		display=false;
	}else{
		document.getElementById('addServiceBox').style.width="360px";
		document.getElementById('addServiceBox').style.height="200px";
		document.getElementById('addServiceBox').style.paddingTop="20px";
		document.getElementById('addServiceBox').style.opacity="1";
		document.getElementById('addServiceBox').style.zIndex="10";
		display=true;
	}
}