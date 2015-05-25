$().ready(function(){
	$("#projectForm").validate({
		rules:{
			projectname:{
				required:true,
				maxlength:30
			},
			constract_counterparty:{
				selectmaxlength:15
			},
			project_address:{
				maxlength:30
			},
			clerkname:{
				required:true,
				selectmaxlength:20
			},
			biddoc_type:{
				selectmaxlength:20
			},
			a_project_director_name:{
				maxlength:20
			},
			a_technology_director_name:{
				maxlength:20
			},
			constructunit_director_name:{
				maxlength:20
			},
			project_type:{
				required:true,
				selectmaxlength:20
			},
			getbid_price:{
				number:true
			},
			currentstatusid:{
				required:true
			},
			biddate_date:{
				required:true
			},
			questionanswerdate_date:{
				required:true
			},
			submitbiddocdate_date:{
				required:true
			},
			startbiddate_date:{
				required:true
			},
			margindate_date:{
				required:true
			},
			getbid_price:{
				number:true
			},
			a_project_director_phone:{
				phoneCN:true
			},
			a_technology_director_phone:{
				phoneCN:true
			},
			constructunit_director_phone:{
				phoneCN:true
			},
			covered_area:{
				number:true
			},
			use_purpose:{
				selectmaxlength:20
			},
			info_source:{
				selectmaxlength:20
			},
			scale:{
				maxlength:20
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
		// showErrors:function(errorMap,errorList){
			// var error,element;
			// for ( i = 0; errorList[ i ]; i++ ){
				// error = errorList[i];
				// element = $(error.element);
				// if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
					// element = element.next("div");
				// }
				// element
					// .attr('data-container','body')
					// .attr('data-trigger','manual')
					// .attr('data-content',error.message)
					// .popover('show');
			// }
			// for ( i = 0, elements = this.validElements(); elements[ i ]; i++ ) {
				// element = $(elements[i]);
				// if (element.hasClass("select-create-true")||element.hasClass("select-create-false")){
					// element = element.next("div");
				// }
				// element
					// .attr('data-container','body')
					// .attr('data-trigger','manual')
					// .popover('hide');
			// }
		// }
	});
});