$().ready(function(){
	$("#roleForm").validate({
		rules:{
			rolename:{
				required:true,
				maxlength:20
			}
		},
		errorElement:"div"
		// showErrors:function(errorMap,errorList){
			// var error;
			// for ( i = 0; errorList[ i ]; i++ ){
				// error = errorList[i];
				// $(error.element)
					// .attr('data-container','body')
					// .attr('data-trigger','manual')
					// .attr('data-content',error.message)
					// .popover('show');
			// }
			// for ( i = 0, elements = this.validElements(); elements[ i ]; i++ ) {
				// $(elements[i])
					// .attr('data-container','body')
					// .attr('data-trigger','manual')
					// .popover('hide');
			// }
		// }
	});
});