var lastobj=null;
$(document).ready(function(){
	$("#header a").click(function(){
		if(lastobj!=null){
			lastobj.removeClass("active");
		}
		$(this).addClass("active");
		$("#content").attr( "src",$(this).attr("href") );
		lastobj=$(this);
		return false;
	});
})
function exit(){
	$.ajax({
			cache: false,
			type: "POST",
			url: "./ajax_login.php?method=signout",
			async: true,
			dataType: "json",
			success: function(data){
				if(data.state=="success"){
					window.location.href="login.php";
				}
			},
			error: function(XMLHttpRequest,textStatus,errorThrown){
			     alert("链接失败，请检查你的网络");
			}
	});
}