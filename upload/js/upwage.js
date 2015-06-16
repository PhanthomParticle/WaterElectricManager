$(document).ready(function(){
	// DisplayData();
	$("#start").click(function(){
		var page=$("#topage").val() || 1;
		window.location.href="upwage.php?page="+page;
		return false;
	});
});

function DisplayData(){
	if("undefined" != typeof UserData){
		var html="";
		var d=UserData;
		for(var i=0; i<d.length; ++i){
			html+="<ul>";
				//html+="<input type="hidden" name="u0" id="u0" value="sadlkjrlk2143214">";
				html+="<p class=\"title\">";
					html+="<span>姓名:"+d[i].name+"</span>";
					html+="<span>地址:"+d[i].address+"</span>";
					html+="<span>电话:"+d[i].phone+"</span>";
				html+="</p>";
				var e=d[i].electric;
				for(var j=0; j<e.length; ++j){
					html+="<li>";
						html+="<span>"+e[j].name+"</span>";
						html+="<input type=\"text\" name=\"u"+i+"p"+j+"\" id=\"u"+i+"p"+j+"\" readonly=\"true\" value=\""+e[j].pvalue+"\">";
						html+="<input type=\"text\" name=\"u"+i+"e"+j+"\" id=\"u"+i+"e"+j+"\">";
						html+="<span class=\"note\">"+e[j].note+"</span>";
					html+="</li>";
				}
				html+="<p class=\"sort\">水表</p>";
				var w=d[i].water;
				for(var k=0; k<w.length; ++k){
					html+="<li>";
						html+="<span>"+w[k].name+"</span>";
						html+="<input type=\"text\" name=\"u"+i+"w"+k+"\" id=\"u"+i+"w"+k+"\" value=\""+w[k].pvalue+"\">";
						html+="<input type=\"text\" name=\"u"+i+"w"+k+"\" id=\"u"+i+"w"+k+"\">";
					html+="</li>";
				}
			html+="</ul>";
		}
		$("#upload").html(html);
	}else{
		alert("参数错误，请刷新页面");
	}
}