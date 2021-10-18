$(function(){
	$('.ajax-ui').sortable({
		start:function(){
			var el = $(this);
			el.find(".box-single-wraper > div:nth-of-type(1)").css("border","2px dashed #ccc");
		},
		update:function(event,ui){
			var data = $(this).sortable('serialize');
			var el = $(this);
			el.find(".box-single-wraper > div:nth-of-type(1)").css("border","1px solid #ccc");
			$.ajax({
				url: include_path+'ajax/forms.php',
				method: 'post',
				data: data
			}).done(function(data){
				console.log(data);
			})
		}
	});

})