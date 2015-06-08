window.onload=function(){
	init();
}
function login(){
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	password=$.md5(password);
	if(username=="" || username==undefined || username==null){
		alert("请输入账号");
	}else if(password=="" || password==undefined || password==null){
		alert("请输入密码");
	}else{
		$.ajax({
			cache: false,
			type: "POST",
			url: "./ajax_login.php?method=login",
			async: true,
			dataType: "json",
			data: {"password":password,"username":username},
			success: function(data){
				if(data.state=="success"){
					window.location.href="index.php";
				}else if(data.message=="password wrong"){
					alert("账号和密码不匹配");
				}else if(data.message=="data wrong"){
					alert("信息不完整，请重试");
				}else{
					alert("未知的错误，请刷新页面");
				}
			},
			error: function(XMLHttpRequest,textStatus,errorThrown){
			     alert("链接失败，请检查你的网络");
			}
		});
	}
}

function init(){
	var bodyheight=document.getElementById("body").offsetHeight;
	var bor=document.getElementById("border");
	var bg=document.getElementById("bgcolor");
	setTimeout(function(){
		bor.style.top=(bodyheight/2)-150+"px";
		bor.style.opacity=1;
	},500);
	setTimeout(function(){
		bg.style.height="50%";
		bg.style.opacity=1;
	},500);
}