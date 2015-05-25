/*用户维护表单验证JS*/

/*检查员工是否选择*/
function employer(){
	if($("#employer").val()==0){
		$("#employer_alert").popover("show");
		return false;
	}
	if($("#employer").val()!=0){
		$("#employer_alert").popover("hide");
	}
};

$(function(){
	$("#employer").blur(employer);
	$("#submit").click(employer);
});

/*检查角色是否选择*/
function role(){
	if($("#role").val()==0){
		$("#role_alert").popover("show");
		return false;
	}
	if($("#role").val()!=0){
		$("#role_alert").popover("hide");
	}
};

$(function(){
	$("#role").blur(role);
	$("#submit").click(role);
});

/*检查用户名是否为空*/
function username(){
	if($("#username").val()==""){
		$("#username_alert_1").popover("hide");
		$("#username_alert_2").popover("show");
		return false;
	}
	if($("#username").val()!=""){
		$("#username_alert_1").popover("hide");
		$("#username_alert_2").popover("hide");
	}
};
$(function(){
	$("#username").focus(function(){
		$("#username_alert_1").popover("show");
	});	
	$("#username").blur(username);
	$("#submit").click(username);
});

/*检查登录密码是否为空*/
function loginpassword(){
	$("#login_pwd_alert_default").popover("hide");
	if($("#login_password").val()==""){
			$("#login_pwd_alert").popover("show");				
				return false;				
		}
		if($("#login_password").val()!=""){
			$("#login_pwd_alert").popover("hide");
		}
};
function loginpwdConfirm(){
	if($("#login_password_confirm").val()!=$("#login_password").val()){
		$("#login_pwd_confirm_alert").popover("show");
			return false;
	}
	if($("#login_password_confirm").val()==$("#login_password").val()){
		$("#login_pwd_confirm_alert").popover("hide");
	}
};
$(function(){
	$("#login_password").focus(function(){
		$("#login_pwd_alert_default").popover("show");
	});
	$("#login_password").blur(loginpassword);	
	$("#login_password_confirm").blur(loginpwdConfirm);
	$("#submit").click(loginpassword);
	$("#submit").click(loginpwdConfirm);
});

/*检查授权密码是否为空*/
function verifypassword(){
	$("#authority_pwd_alert_default").popover("hide");
	if($("#verify_password").val()==""){
			$("#authority_pwd_alert").popover("show");				
				return false;				
		}
		if($("#verify_password").val()!=""){
			$("#authority_pwd_alert").popover("hide");
		}
};
function verifypwdConfirm(){
	if($("#verify_password_confirm").val()!=$("#verify_password").val()){
		$("#authority_pwd_confirm_alert").popover("show");
			return false;
	}
	if($("#verify_password_confirm").val()==$("#verify_password").val()){
		$("#authority_pwd_confirm_alert").popover("hide");
	}
};
$(function(){
	$("#verify_password").focus(function(){
		$("#authority_pwd_alert_default").popover("show");
	});
	$("#verify_password").blur(verifypassword);	
	$("#verify_password_confirm").blur(verifypwdConfirm);
	$("#submit").click(verifypassword);
	$("#submit").click(verifypwdConfirm);
});