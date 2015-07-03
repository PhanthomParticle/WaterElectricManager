$(document).ready(function(){
	DisplayData();
	$("#start").click(function(){
		var page=$("#topage").val() || 1;
		window.location.href="upcash.php?page="+page;
		return false;
	});
});

function DisplayData(){
	if("undefined" != typeof UserData){
		var html="";
		var d=UserData;
		var tabindex=1;
		for(var i=0; i<d.length; ++i){
			html+="<ul>";
				//html+="<input type="hidden" name="u0" id="u0" value="sadlkjrlk2143214">";
				html+="<p class=\"title\">";
					html+="<span>工资编号:"+d[i].wage+"</span>";
					html+="<span>姓名:"+d[i].name+"</span>";
					html+="<span>地址:"+d[i].address+"</span>";
					html+="<span>电话:"+d[i].phone+"</span>";
				html+="</p>";
				var e=d[i].electric;
				for(var j=0; j<e.length; ++j){
					html+="<li>";
						html+="<span>"+e[j].name+"</span>";
						html+="<input type=\"text\" name=\"u"+i+"e"+j+"p\" id=\"u"+i+"p"+j+"p\" readonly=\"true\" tabindex=\"-1\" value=\""+e[j].pvalue+"\">";
						html+="<input type=\"text\" name=\"u"+i+"e"+j+"c\" id=\"u"+i+"e"+j+"c\" tabindex=\""+tabindex+"\" value=\""+e[j].cvalue+"\">";
						html+="<span class=\"note\">"+e[j].note+"</span>";
					html+="</li>";
					tabindex++;
				}
				html+="<p class=\"sort\">水表</p>";
				var w=d[i].water;
				for(var k=0; k<w.length; ++k){
					html+="<li>";
						html+="<span>"+w[k].name+"</span>";
						html+="<input type=\"text\" name=\"u"+i+"w"+k+"p\" id=\"u"+i+"w"+k+"p\" readonly=\"true\" tabindex=\"-1\" value=\""+w[k].pvalue+"\">";
						html+="<input type=\"text\" name=\"u"+i+"w"+k+"c\" id=\"u"+i+"w"+k+"c\" tabindex=\""+tabindex+"\" value=\""+w[k].cvalue+"\">";
						html+="<span class=\"note\">"+w[k].note+"</span>";
					html+="</li>";
					tabindex++;
				}
			html+="</ul>";
		}
		$("#upload").html(html);
	}else{
		alert("参数错误，请刷新页面");
	}
}
var save=true;
function SaveData(){
	if(save){
		if("undefined" != typeof UserData){
			save=false;
			for(var i=0; i<UserData.length; ++i){
				
				for(var j=0; j<UserData[i].electric.length; ++j){
					UserData[i].electric[j].cvalue=$("#u"+i+"e"+j+"c").val();
				}
				
				for(var k=0; k<UserData[i].water.length; ++k){
					UserData[i].water[k].cvalue=$("#u"+i+"w"+k+"c").val();
				}
			}
			var JsonData=JSON.stringify(UserData);
			$.ajax({
				cache: false,
				type: "POST",
				url:"ajax_upload.php?method=upcash",
				async: true,
				data: {"JsonData":JsonData},
				dataType:"json",
				error: function(request){
					alert("连接失败,请检查网络连接");
					save=true;
				},
				success: function(data) {
			        if(data.state=="success"){
			        	alert("数据保存成功");
			        }else if(data.message=="not login"){
			        	alert("请先登录");
			        }else if(data.message=="data lost"){
			        	alert("数据丢失,请检查数据完整性");
			        }else if(data.message=="method wrong"){
			        	alert("调用错误的函数名");
			        }else{
			        	alert("未知的错误");
			        }
			        save=true;
				}
			});
		}else{
			alert("参数错误，请刷新页面");
		}
	}else{
		alert("请不要重复提交");
	}
}
