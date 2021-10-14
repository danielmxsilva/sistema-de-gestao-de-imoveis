$(document).ready(function(){
	$('input[name=email]').focus(function(){
		resetarCampoInvalido($(this));
		return false;
	})

	$('body').on('submit','form.ajax-form',(function(){
		var email = $('input[name=email]').val();

		if(validarEmail(email) == false){
			aplicarCampoInvalido($('input[name=email]'));
			return false;
		}else{
			var form = $(this);
			$.ajax({
				url: 'ajax/formularios.php',
				method: 'post',
				dataType: 'json',
				data:form.serialize()
			}).done(function(data){

			});
			$('input[type=submit]').val('ENVIADO');
		}

	})

	function validarEmail(email){
		if(email == ''){
			return false;
		}
		if(email.match(/^([A-Za-z0-9-_.]{1,})+@+([A-Za-z.]{1,})$/) == null){
			return false;
		}
	}

	function aplicarCampoInvalido(el){
		el.css('border','2px solid red');
		el.css('color','red');
		el.val('Campo Invalido');
	}

	function resetarCampoInvalido(el){
		el.css('border','1px solid black');
		el.css('color','gray');
		el.val('');
	}


})