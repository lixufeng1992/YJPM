$().ready(function(){
	$("#addPeriodworkForm").validate({
		rules:{
			confirm_date:{
				required:true,
				date:true
			},
			period_count:{
				required:true,
				number:true
			},
			remark:{
				maxlength:100
			}
		},
		errorElement:"div"
	});
	$("#editPeriodworkForm").validate({
		rules:{
			confirm_date:{
				required:true,
				date:true
			},
			period_count:{
				required:true,
				number:true
			},
			remark:{
				maxlength:100
			}
		},
		errorElement:"div"
	});
});