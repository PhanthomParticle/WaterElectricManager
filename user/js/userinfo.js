$(document).ready(function(){
	$(".delE").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			var sure=confirm("确定删除？");
			if(sure){
				$.get("ajax_userinfo.php?method=delE",{"id":id},function(data){
					if(data.state=="success"){
						alert("删除成功");
						window.location.href=window.location.href;
					}else if(data.message=="no login"){
						alert("请先登录");
					}else if(data.message=="no id"){
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
	$(".delW").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			var sure=confirm("确定删除？");
			if(sure){
				$.get("ajax_userinfo.php?method=delW",{"id":id},function(data){
					if(data.state=="success"){
						alert("删除成功");
						window.location.href=window.location.href;
					}else if(data.message=="no login"){
						alert("请先登录");
					}else if(data.message=="no id"){
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
	$(".modifyE").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			Geid=id;
			var ename=$(this).prevAll()[5].innerHTML;
			var rate=$(this).prevAll()[3].innerHTML;
			$("#ename").val(ename);
			$("#rate").val(rate);
			var html="<span onclick=\"modifyE()\">修改</span><span onclick=\"cebox()\">取消</span>";
			$("#efunc").html(html);
			cebox();
		}else{
			alert("参数错误，请刷新页面");
		}
		return false;
	});
	$(".modifyW").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			Gwid=id;
			var wname=$(this).prevAll()[3].innerHTML;
			$("#wname").val(wname);
			var html="<span onclick=\"modifyW()\">修改</span><span onclick=\"cwbox()\">取消</span>";
			$("#wfunc").html(html);
			cwbox();
		}else{
			alert("参数错误，请刷新页面");
		}
		return false;
	});
});
var Geid;
var Gwid;
function openeadd(){
	var html="<span onclick=\"eadd()\">增加</span><span onclick=\"cebox()\">取消</span>";
	$("#ename").val("");
	$("#rate").val("");
	$("#efunc").html(html);
	cebox();
}
function openwadd(){
	var html="<span onclick=\"wadd()\">增加</span><span onclick=\"cwbox()\">取消</span>";
	$("#wname").val("");
	$("#wfunc").html(html);
	cwbox();
}
function modifyE(){
	var ename=$("#ename").val();
	var rate=$("#rate").val();
	if(ename!="" && rate!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=modifyE",
		async: true,
		data: {"id":Geid,"ename":ename,"rate":rate},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("修改成功");
	        	cebox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="no login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function modifyW(){
	var wname=$("#wname").val();
	if(wname!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=modifyW",
		async: true,
		data: {"id":Gwid,"wname":wname},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("修改成功");
	        	cwbox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="no login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function eadd(){
	var ename=$("#ename").val();
	var rate=$("#rate").val();
	if(ename!="" && rate!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=addE",
		async: true,
		data: {"uuid":Guuid,"ename":ename,"rate":rate},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("增加成功");
	        	cebox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="no login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function wadd(){
	var wname=$("#wname").val();
	if(wname!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=addW",
		async: true,
		data: {"uuid":Guuid,"wname":wname},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("增加成功");
	        	cwbox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="no login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
var edisplay=false;
var wdisplay=false;
function cebox(){
	if(edisplay){
		document.getElementById('ebox').style.width="560px";
		document.getElementById('ebox').style.height="400px";
		document.getElementById('ebox').style.paddingTop="220px";
		document.getElementById('ebox').style.opacity="0";
		document.getElementById('ebox').style.zIndex="-10";
		edisplay=false;
	}else{
		document.getElementById('ebox').style.width="360px";
		document.getElementById('ebox').style.height="200px";
		document.getElementById('ebox').style.paddingTop="20px";
		document.getElementById('ebox').style.opacity="1";
		document.getElementById('ebox').style.zIndex="10";
		edisplay=true;
	}
}
function cwbox(){
	if(wdisplay){
		document.getElementById('wbox').style.width="560px";
		document.getElementById('wbox').style.height="400px";
		document.getElementById('wbox').style.paddingTop="220px";
		document.getElementById('wbox').style.opacity="0";
		document.getElementById('wbox').style.zIndex="-10";
		wdisplay=false;
	}else{
		document.getElementById('wbox').style.width="360px";
		document.getElementById('wbox').style.height="200px";
		document.getElementById('wbox').style.paddingTop="20px";
		document.getElementById('wbox').style.opacity="1";
		document.getElementById('wbox').style.zIndex="10";
		wdisplay=true;
	}
}