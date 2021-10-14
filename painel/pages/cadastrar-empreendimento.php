
<div class="box-content">
	<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/lapis.png">
	<h2>Cadastrar Empreendimento</h2>
	
	<div class="form-editar cadastro-depoimentos">
		<form method="POST" enctype="multipart/form-data">

			<div class="group-depoimento">
				<span>Nome:</span>
				<input type="text" name="titulo">
			</div><!--from-group-->

			<div class="group-depoimento">
				<span>Tipo:</span>
				<select required>
					<option>Residêncial</option>
					<option>Comercial</option>
				</select>
			</div><!--from-group-->

			<div class="group-depoimento">
				<span>Preço:</span>
				<input type="text" name="valor">
			</div><!--from-group-->

			<div class="form-group">
				<span>Imagem:</span>
				<input style="width: calc(100% - 120px)" type="file" name="" id="input-img" value="<?php echo $_SESSION['img'];?>">
				<label style="left: 110px;" for="input-img" name=""><img src="<?php echo INCLUDE_PATH_PAINEL?>img/enviar-img.png"></label>
			</div><!--from-group-->

			<div class="group-depoimento">
				<input <?php permissaoInput(1,'acao_cadastrar','Cadastrar')?>>
			
			</div><!--from-group-->
		</form>
	</div><!--form-editar-->

</div><!--box-content-->

