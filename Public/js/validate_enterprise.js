$().ready(function(){
	$("#enterpriseForm").validate({
		rules:{
			name:{
				required:true,
				maxlength:30
			},
			address:{
				maxlength:30
			},
			contact_person:{
				maxlength:20
			},
			remark:{
				maxlength:45
			},
			is_1part:{
				require_from_group:[1,':checkbox'],
			},
			is_client:{
				require_from_group:[1,':checkbox'],
			},
			is_divideman:{
				require_from_group:[1,':checkbox'],
			},
			is_machineman:{
				require_from_group:[1,':checkbox'],
			},
			is_materialman:{
				require_from_group:[1,':checkbox'],
			},
			is_otherpart:{
				require_from_group:[1,':checkbox'],
			},
			is_transman:{
				require_from_group:[1,':checkbox'],
			},
			phone_number:{
				phoneCN:true
			},
			website:{
				url:true,
				maxlength:50
			},
			zip_number:{
				digits:true,
				rangelength:[6,6]
			},
			fax:{
				fax:true
			},
			email:{
				email:true,
				maxlength:30
			},
			legal_person:{
				maxlength:20
			},
			tax_number:{
				maxlength:30
			},
			service_zone:{
				maxlength:15
			}
		},
		messages:{
			zip_number:{
				digits:"请输入正确的邮编",
				rangelength:"请输入正确的邮编"
			}
		},
		groups:{
			clientType:"is_1part is_client is_divideman is_machineman is_materialman is_otherpart is_transman"
		},
		errorElement:"div",
		errorPlacement:function(error,element){
			if (this.groups.clientType.indexOf(element.attr("name"))>=0){
				$("[name='is_1part']").parents(".col-md-2").append(error.addClass("checkbox"));
			}else{
				error.insertAfter(element);
			}
		}
		// showErrors:function(errorMap,errorList){
			// var error;
			// for ( i = 0; errorList[ i ]; i++ ){
				// error = errorList[i];
				// if (this.groups[error.element.name]){
					// $("[name='is_1part']")
						// .attr('data-container','body')
						// .attr('data-trigger','manual')
						// .attr('data-placement','left')
						// .attr('data-content',error.message)
						// .popover('show');
				// }else{
					// $(error.element)
						// .attr('data-container','body')
						// .attr('data-trigger','manual')
						// .attr('data-content',error.message)
						// .popover('show');
				// }
			// }
			// for ( i = 0, elements = this.validElements(); elements[ i ]; i++ ) {
				// if (this.groups[elements[i].name]){
					// $(elements[i])
						// .attr('data-container','body')
						// .attr('data-trigger','manual')
						// .attr('data-placement','left')
						// .popover('hide');
				// }else{
					// $(elements[i])
						// .attr('data-container','body')
						// .attr('data-trigger','manual')
						// .popover('hide');
				// }
			// }
		// }
	});
});