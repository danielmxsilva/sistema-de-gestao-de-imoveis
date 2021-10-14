<div id="map"></div>

<div class="container">
	<form method="POST" class="contato ajax-form">
		<input type="hidden" name="form_contato">
		<p>Serviço a ser solicitado</p>
		<select name="selecione" required>
			<option value="">Selecione</option>
			<option value="website">Website</option>
			<option value="sistema">Sistema</option>
			<option value="aplicativo">Aplicativo</option>
			<option value="duvida">Dúvidas</option>
		</select>
		<input type="text" name="nome" placeholder="Nome Completo">
		<input type="text" name="email" placeholder="E-mail">
		<input type="text" name="telefone" placeholder="Telefone">
		<p>Você é pessoa</p>
		<input type="radio" name="pessoa" value="fisica_cpf" required>&nbsp<span>Física</span>
		<br>
		<input type="radio" name="pessoa" value="juridica_cnpj">&nbsp<span>Juridica</span>
		<input type="submit" name="acao" value="enviar">
	</form>
</div><!--container-->