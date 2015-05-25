// JavaScript Document
// JavaScript Document
String.prototype.trim=function() { return this.replace(/(^\s*)|(\s*$)/g, ""); }
var bootstrapButton = $.fn.button.noConflict(); // return $.fn.button to previously assigned value
$.fn.bootstrapBtn = bootstrapButton;           // give $().bootstrapBtn the Bootstrap functionality
$().ready(function(){
	$("#bodynav").width($(window).width()-160);
	$("#left-menu").height($(window).height()-50);	
	$("#left-affix").height($(window).height()-50);
	$(".ui.sidebar.panel.panel-default").height($(window).height()-100);
	$(window).resize(function(){
		$("#bodynav").width($(window).width()-160);
		$("#left-menu").height($(window).height()-50);	
		$("#left-affix").height($(window).height()-50);	
		$(".ui.sidebar.panel.panel-default").height($(window).height()-100);
	});
	$(".datepicker").datepicker({
		changeMonth:true,
		changeYear:true,			
		yearRange:'c-60:c+20',
		
		/*区域化周名为中文*/
		dayNamesMin : ["日", "一", "二", "三", "四", "五", "六"],
		/*每周从周一开始*/
		firstDay : 1,
		/*区域化月名为中文*/
		monthNames : ["1月", "2月", "3月", "4月", "5月", "6月",
				"7月", "8月", "9月", "10月", "11月", "12月"],
		monthNamesShort : ["1月", "2月", "3月", "4月", "5月", "6月",
				"7月", "8月", "9月", "10月", "11月", "12月"],
		/*月份显示在年后面*/
		showMonthAfterYear : true,
		/*年份后缀字符*/
		yearSuffix: "年" ,
		dateFormat: "yy-mm-dd"
	});
	$('.select-create-true').selectize({
		create: true,
		createOnBlur: true
	});
	$('.select-create-false').selectize({
		create: false,
		onInitialize:function(){
			$(this.$control_input).prop("readonly",true);
		}
	});
	$("a.btn-danger").click(function(){
		return confirm('确认删除?');
	});
	$('.overlay.sidebar').sidebar({
		overlay: true
	});
	$(".list-group-item.collapse").prev().find(".glyphicon").click(function(e){
		$(this).parent().next().collapse('toggle');
	});
	$(".list-group-item.collapse").on("show.bs.collapse",function(e){
		$(e.target).prev().children().first().removeClass("glyphicon-plus-sign").addClass("glyphicon-minus-sign");
	});
	$(".list-group-item.collapse").on("hide.bs.collapse",function(e){
		$(e.target).prev().children().first().removeClass("glyphicon-minus-sign").addClass("glyphicon-plus-sign");
	});
	//$(".sidebar-tree .tree-item").click(function(){
	//	$(this).parents(".sidebar-tree").find(".list-group-item").removeClass("active");
	//	$(this).parent().addClass("active");
	//});
		$(document).ajaxStart(function(){
                    $("#loading").modal("show");
		});

                $(document).ajaxComplete(function(){
                    $("#loading").modal("hide");
                });
});
