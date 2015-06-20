$(document).ready(function(){
	ajax_get();
	//------------------------------删除
	$(".delE").click(function(){
		var id=$(this).attr("href") || null;
		if(id!=null){
			var sure=confirm("确定删除？");
			if(sure){
				$.get("ajax_userinfo.php?method=delE",{"id":id},function(data){
					if(data.state=="success"){
						alert("删除成功");
						window.location.href=window.location.href;
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="no id"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
					}else if(data.message=="system wrong"){
						alert("系统繁忙，请检查数据完整性");
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
					}else if(data.message=="not login"){
						alert("请先登录");
					}else if(data.message=="no id"){
						alert("参数错误，请刷新页面");
						window.location.href=window.location.href;
					}else if(data.message=="system wrong"){
						alert("系统繁忙，请检查数据完整性");
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
			var notee=$(this).prevAll()[1].innerHTML;
			$("#ename").val(ename);
			$("#rate").val(rate);
			$("#inite").val("此项无效,不用填");
			$("#notee").val(notee);
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
			var notew=$(this).prevAll()[1].innerHTML;
			$("#wname").val(wname);
			$("#initw").val("此项无效,不用填");
			$("#notew").val(notew);
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
	$("#inite").val("");
	$("#notee").val("");
	$("#efunc").html(html);
	cebox();
}
function openwadd(){
	var html="<span onclick=\"wadd()\">增加</span><span onclick=\"cwbox()\">取消</span>";
	$("#wname").val("");
	$("#initw").val("");
	$("#notew").val("");
	$("#wfunc").html(html);
	cwbox();
}
function Cetype(){
	var eprice=$("#etype option:selected").val();
	$("#eprice").val(eprice);
}
function Cwtype(){
	var wprice=$("#wtype option:selected").val();
	$("#wprice").val(wprice);
}
function modifyE(){
	var ename=$("#ename").val();
	var rate=$("#rate").val();
	var notee=$("#notee").val();
	if(ename!="" && rate!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=modifyE",
		async: true,
		data: {"id":Geid,"ename":ename,"rate":rate,"notee":notee},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("修改成功");
	        	cebox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else{
	        	alert("未知的错误");
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function modifyW(){
	var wname=$("#wname").val();
	var notew=$("#notew").val();
	if(wname!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=modifyW",
		async: true,
		data: {"id":Gwid,"wname":wname,"notew":notew},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("修改成功");
	        	cwbox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else{
	        	alert("未知的错误");
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
	var inite=$("#inite").val();
	var notee=$("#notee").val();
	if(ename!="" && rate!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=addE",
		async: true,
		data: {"uuid":Guuid,"ename":ename,"rate":rate,"inite":inite,"notee":notee},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("增加成功");
	        	cebox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else if(data.message=="already"){
	        	alert("已经存在相同名字的表");
	        }else{
	        	alert("未知的错误");
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function wadd(){
	var wname=$("#wname").val();
	var initw=$("#initw").val();
	var notew=$("#notew").val();
	if(wname!=""){
		$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=addW",
		async: true,
		data: {"uuid":Guuid,"wname":wname,"initw":initw,"notew":notew},
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("增加成功");
	        	cwbox();
	        	window.location.href=window.location.href;
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙");
	        	window.location.href=window.location.href;
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else if(data.message=="already"){
	        	alert("已经存在相同名字的表");
	        }else{
	        	alert("未知的错误");
	        }
		}
		});
	}else{
		alert("请输入完整的信息");
	}
}
function ajax_save(){
	$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=setinfo&id="+Guuid,
		async: true,
		data: $("#infoform").serialize(),
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	alert("保存成功");
	        	cleardata();
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙,请检查数据完整性");
	        	window.location.href=window.location.href;
	        }else if(data.message=="method wrong"){
	        	alert("调用错误的函数名");
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else{
	        	alert("未知的错误");
	        }
		}
	});
	return false;
}
function ajax_get(){
	$.ajax({
		cache: false,
		type: "POST",
		url:"ajax_userinfo.php?method=getinfo&id="+Guuid,
		async: true,
		dataType:"json",
		error: function(request){
			alert("连接失败");
		},
		success: function(data) {
	        if(data.state=="success"){
	        	var d=data.result;
	        	$("#area").val(d.area);
	        	$("#pay").val(d.wage);
	        	$("#name").val(d.name);
	        	$("#address").val(d.address);
	        	$("#phone").val(d.phone);
	        	$("#type option:selected").val(d.type);
	        	$("#eprice").val(d.eprice);
	        	$("#wprice").val(d.wprice);
	        	$("#note").val(d.note);
	        }else if(data.message=="not login"){
	        	alert("请先登录");
	        }else if(data.message=="system wrong"){
	        	alert("系统繁忙,请检查数据完整性");
	        	window.location.href=window.location.href;
	        }else if(data.message=="method wrong"){
	        	alert("调用错误的函数名");
	        }else if(data.message=="no id"){
	        	alert("参数错误，请刷新页面");
	        }else{
	        	alert("未知的错误");
	        }
		}
	});
	return false;
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