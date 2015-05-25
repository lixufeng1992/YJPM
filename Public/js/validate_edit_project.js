$().ready(function(){
	$("#addProgressForm").validate({
		rules:{
			content:{
				required:true
			}
		},
		ignore:"",
		errorElement:"div",
		errorPlacement:function(error,element){
			if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
				element.parent().append(error);
			}else{
				error.insertAfter(element);
			}
		}
		
	});
	$("#editProgressForm").validate({
		rules:{
			content:{
				required:true
			}
		},
		ignore:"",
		errorElement:"div",
		errorPlacement:function(error,element){
			if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
				element.parent().append(error);
			}else{
				error.insertAfter(element);
			}
		}
		
	});
	$("#addCompetitiveForm").validate({
		rules:{
			name:{
				required:true
			},
			linkman_phone:{
				phoneCN:true
			}
		},
		ignore:"",
		errorElement:"div",
		errorPlacement:function(error,element){
			if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
				element.parent().append(error);
			}else{
				error.insertAfter(element);
			}
		}
		
	});
	$("#editCompetitiveForm").validate({
		rules:{
			name:{
				required:true
			},
			linkman_phone:{
				phoneCN:true
			}
		},
		ignore:"",
		errorElement:"div",
		errorPlacement:function(error,element){
			if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
				element.parent().append(error);
			}else{
				error.insertAfter(element);
			}
		}
		
	});
});