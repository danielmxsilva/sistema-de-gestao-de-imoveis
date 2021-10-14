$(document).ready(function(){

	if($('target').length > 0){
		var elemento = '#'+$('target').attr('target');

		var divScroll = $(elemento).offset().top;

		$('html,body').animate({scrollTop:divScroll},2000);
	}

	carregarDinamico();

	function carregarDinamico(){
		$('[realtime]').click(function(){
			var pagina = $(this).attr('realtime');
			$('.container-principal').load('/site_dinamico_aula/pages/'+pagina+'.php');
				initialize();
				addMarker(-23.137119,-47.074032,'',"<font color='#12A0C9' size='3'><b>Minha casa</b></font> <br> Seg a Sex 6h às 22h | Sab das 7h às 12h",undefined,true);
				addMarker(-23.134988,-47.077725,'',"<font color='#12A0C9' size='3'><b>Casa do diego</b></font> <br> Seg a Sex 6h às 22h | Sab das 7h às 12h",undefined,true);
			return false;
		})
	}

})