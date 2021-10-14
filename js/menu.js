$(document).ready(function(){
	$('.mobile').click(function(e){
		e.stopPropagation();
		if($(this).find('ul').is(':visible')){
			$('.icone-menu').css('background-image','url(img/menu.png)');
		}else{
			$('.icone-menu').css('background-image','url(img/menu-open.png)');
		}

		$(this).find('ul').slideToggle();
	})


	$('body').click(function(e){
		e.stopPropagation();
		$('.mobile').find('ul').slideUp();
		$('.icone-menu').css('background-image','url(img/menu.png)');
	})
})