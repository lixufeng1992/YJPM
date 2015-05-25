/*身份证格式验证*/
$(function(){
	$("#id_number").blur(function(){
		if(($("#id_number").val().length!=15)||($(this).val().length!=18)){					
			$("#idnumberalert").popover("show");
		}
		if(($(this).val().length==15)||($(this).val().length==18)){
			$("#idnumberalert").popover("hide");
		}
	});	
});

/*邮箱自动补全*/
$(function(){
	var availableemail = ["@163.com", "@126.com", "@sohu.com", "@qq.com", "@sina.com", "@gmail.com"];
	$("#email").autocomplete({
		source: availableemail
	});
});


/*验证用户名是否为空*/
function name(){
	if($("#real_name").val()==""){
		$("#name_alert").popover("show");
		return false;
	}
	if($("#real_name").val()!=""){
		$("#name_alert").popover("hide");
	}
};
$(function(){
	$("#real_name").blur(name);
	$("#submit").click(name);
});

/*验证联系方式是否为空*/
function phone_number(){
	if($("#phone_number").val()==""){
		$("#phone_number_alert").popover("show");
		return false;
	}
	if($("#phone_number").val()!=""){
		$("#phone_number_alert").popover("hide");
	}
};
$(function(){
	$("#phone_number").blur(phone_number);
	$("#submit").click(phone_number);
});

/*检查所属公司是否选择*/
function company(){
	if($("#company").val()==0){
		$("#company_alert").popover("show");
		return false;
	}
	if($("#company").val()!=0){
		$("#company_alert").popover("hide");
	}
};

$(function(){
	$("#company").blur(company);
	$("#submit").click(company);
});

/*检查所属部门是否选择*/
function department(){
	if($("#department").val()==0){
		$("#department_alert").popover("show");
		return false;
	}
	if($("#department").val()!=0){
		$("#department_alert").popover("hide");
	}
};

$(function(){
	$("#department").blur(department);
	$("#submit").click(department);
});

/*检查工种是否选择*/
function worktype(){
	if($("#worktype").val()==0){
		$("#worktype_alert").popover("show");
		return false;
	}
	if($("#worktype").val()!=0){
		$("#worktype_alert").popover("hide");
	}
};

$(function(){
	$("#worktype").blur(worktype);
	$("#submit").click(worktype);
});

/*检查职位是否选择*/
function position(){
	if($("#position").val()==0){
		$("#position_alert").popover("show");
		return false;
	}
	if($("#position").val()!=0){
		$("#position_alert").popover("hide");
	}
};

$(function(){
	$("#position").blur(position);
	$("#submit").click(position);
});