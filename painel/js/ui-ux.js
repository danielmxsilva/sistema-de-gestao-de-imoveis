$(function(){
	$('.ajax-ui').sortable({
		start:function(){
			var el = $(this);
			el.find(".box-single-wraper > div:nth-of-type(1)").css("border","2px dashed #ccc");
		},
		update:function(event,ui){
			var data = $(this).sortable('serialize');
			console.log(data);
			var el = $(this);
			el.find(".box-single-wraper > div:nth-of-type(1)").css("border","1px solid #ccc");
		}
	});

})