$(document).ready(function(){

	var curIndex = 0;
	var maxIndex = $('.banner-single').length-1;
	var delay = 8;

	initiSlide();
	//changeSlide();

	function initiSlide(){
		$('.banner-single').hide();
		$('.banner-single').eq(0).show();

		for(var i = 0; i < maxIndex+1; i++){
			var content = $('.bullets-span').html();
			if(i == 0)
				content+='<span class="active-slider"></span>';
			else
				content+='<span></span>';
			$('.bullets-span').html(content);
		}

	}

	function changeSlide(){
		setInterval(function(){
			$('.banner-single').eq(curIndex).fadeOut(2000);
			curIndex++;
			if(curIndex > maxIndex)
				curIndex = 0;	
			$('.banner-single').eq(curIndex).fadeIn(2000);
			$('.bullets-span span').removeClass('active-slider');
			$('.bullets-span span').eq(curIndex).addClass('active-slider');
		},delay * 1000);
	}


	$('body').on('click','.bullets-span span',function(){
		var currentBullet = $(this);
		$('.banner-single').eq(curIndex).fadeOut(1000);
		curIndex = currentBullet.index();
		$('.banner-single').eq(curIndex).fadeIn(1000);
		$('.bullets-span span').removeClass('active-slider');
		currentBullet.addClass('active-slider');
	})

	$('body').on('click','.arrow-left',function(){
		curIndex--;
		if(curIndex < maxIndex-1)
			curIndex = maxIndex-1;
		console.log(curIndex);
		$('.banner-single').eq(curIndex).fadeOut(1000);
		$('.bullets-span span').removeClass('active-slider');
		$('.bullets-span span').eq(curIndex).addClass('active-slider');
		$('.banner-single').eq(curIndex).fadeIn(1000);
	})

	$('body').on('click','.arrow-right',function(){
		curIndex++;
		if(curIndex >= maxIndex+1)
			curIndex = 0;
		console.log(curIndex);
		$('.banner-single').eq(curIndex).fadeOut(1000);
		$('.bullets-span span').removeClass('active-slider');
		$('.bullets-span span').eq(curIndex).addClass('active-slider');
		$('.banner-single').eq(curIndex).fadeIn(1000);
	})
	


})