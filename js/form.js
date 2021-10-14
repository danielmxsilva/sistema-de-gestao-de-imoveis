$(document).ready(function(){

	$('input[name=telefone]').mask('(99)99999-9999');

	$('input[name=nome]').focus(function(){
		resetarCampoInvalido($(this));
		return false;
	})

	$('input[name=email]').focus(function(){
		resetarCampoInvalido($(this));
		return false;
	})

	$('input[name=telefone]').focus(function(){
		resetarCampoInvalido($(this));
		return false;
	})

	$('body').on('submit','form.contato',(function(){
		var select = $('option[value]').val();
		var nome = $('input[name=nome]').val();
		var email = $('input[name=email]').val();
		var telefone = $('input[name=telefone]').val();
		var radio = $('input[type=radio]').val();

		if(validarNome(nome) == false){
			aplicarCampoInvalido($('input[name=nome]'));
			return false;
		}else if(validarEmail(email) == false){
			aplicarCampoInvalido($('input[name=email]'));
			return false;
		}else if(validarTelefone(telefone) == false){
			aplicarCampoInvalido($('input[name=telefone]'));
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

	function validarNome(nome){
		if(nome == ''){
			return false;
		}

		var amount = nome.split(' ').length;
		var splitStr = nome.split('');

		if(amount >= 2){
			for(var i = 0; i < amount; i++){
				if(splitStr[i].match(/[A-Za-z]{1,}$/)){

				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	function validarEmail(email){
		if(email == ''){
			return false;
		}
		if(email.match(/^([A-Za-z0-9-_.]{1,})+@+([A-Za-z.]{1,})$/) == null){
			return false;
		}
	}

	function validarTelefone(telefone){
		if(telefone == ''){
			return false;
		}

		if(telefone.match(/^\([0-9]{2}\)[0-9]{5}-[0-9]{4}$/) == null){
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