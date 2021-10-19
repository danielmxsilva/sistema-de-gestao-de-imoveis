<?php
	
	$id = (int)$_GET['id'];

	$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE id = ?");
	$sql->execute(array($id));

	$infoProduto = $sql->fetch();

	$infoImagem = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
	$infoImagem->execute();
	$infoImagem = $infoImagem->fetchAll();

	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL.'/uploads/'.$idImagem);
		$sql = Mysql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imagem = '$idImagem'");
		Painel::alert("sucesso","Imagem deletada com sucesso!");
		$infoImagem = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
		$infoImagem->execute();
		$infoImagem = $infoImagem->fetchAll();
	}else if(isset($_GET['deletarImovel'])){
		foreach($infoImagem as $key => $value) {
			@unlink(BASE_DIR_PAINEL.'/uploads/'.$value['imagem']);
		}
		$sql = Mysql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
		$sql = Mysql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE id = $id");
		Painel::alertJs("Imovel deletado com sucesso!");
		Painel::redirect(INCLUDE_PATH_PAINEL.'listar-empreendimentos');
	}

?>
<div class="wraper-titulo">
		<div class="titulo-content">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/notebook.png">
			<h2>Painel de Controle</h2>
		</div><!--titulo-content-->
		<div class="breadcrump">
		<a href="<?php echo INCLUDE_PATH_PAINEL?>index.php">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/home.png">
			<h2>Home</h2>
		</a>
		<a href="<?php echo INCLUDE_PATH_PAINEL?>listar-empreendimento">
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/listar.png">
			<h2>Visualizar empreendimento</h2>
		</a>
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/editar-depoimento-gray.png">
			<h2 class="active-btn">Editar Produto</h2>
		</div><!--breadcrump-->
</div><!--wraper-titulo-->

<div class="box-content">
	<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/lapis.png">
	<h2>Editando Produto: <?php echo $infoProduto['nome']?></h2>

	<?php permissaoPagina(1); ?>

	<div class="form-editar">

		
		<form method="POST" enctype="multipart/form-data">

			<div class="form-group form-produto">
				<span class="block-span">Nome:</span>
				<input style="width:100%;" type="text" name="nome" value="<?php echo $infoProduto['nome']?>" >
			</div><!--from-group-->

			<div class="form-group form-produto">
				<span class="block-span">Preço:</span>
				<input style="width:100%;" type="text" name="nome" value="<?php echo $infoProduto['preco']?>" >
			</div><!--from-group-->

			<div class="form-group form-produto">
				<span class="block-span">Area:</span>
				<input style="width:100%;" type="text" name="nome" value="<?php echo $infoProduto['area']?>" >
			</div><!--from-group-->

			<div class="form-group form-produto">
				<span class="block-span">Imagen:</span>
				<input multiple type="file" name="imagem[]" id="input-img-adicionar">
				<label style="width: 150px; left: 0;" for="input-img-adicionar" name="imagem"><img src="<?php echo INCLUDE_PATH_PAINEL?>img/enviar-img.png"></label>
			</div><!--from-group-->

			<div class="form-group">
				<input type="hidden" name="tipo_acao" value="cadastrar_cliente">
				<input <?php permissaoInput(1,'acao_adicionar','Editar')?>>
			
			</div><!--from-group-->

			<div class="box-btn" style="margin-top:5px;text-align: left;">

				<a <?php
						if($_SESSION['cargo'] >= 1){
					  ?>
					   class="btn-delete" style="background-color: #FF7B52;" item_id="<?php echo $value['id']?>" href="<?php echo INCLUDE_PATH_PAINEL?>editar-imovel?id=<?php echo $id?>?&deletarImovel=<?php echo $infoProduto['id']?>"
					  <?php }else{ ?> 
					  	actionBtn="negado" style="background-color: #FF7B52;" href="#"
					  <?php } ?>
					  ><img src='img/excluir-depoimento-red.png'>Deletar Imovel
				</a>

			</div><!--box-btn-->

		</form>
	</div><!--form-editar-->

		<div class="form-editar">

	<?php
		foreach ($infoImagem as $key => $value) {
	?>

	<div class="box-single-wraper">
		<div class="box-single" style="box-shadow: 1px 1px 10px #ccc;min-height: inherit;">
			<div class="box-topo">
				<img style="width: 50%;height: 90px;border-radius: unset;" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['imagem']?>">
			</div><!--box-topo-->

			<div class="box-btn" style="margin-top:5px;">

				<a <?php
						if($_SESSION['cargo'] >= 1){
					  ?>
					   class="btn-delete" style="background-color: #FF7B52;" item_id="<?php echo $value['id']?>" href="<?php echo INCLUDE_PATH_PAINEL?>editar-imovel?id=<?php echo $id?>&deletarImagem=<?php echo $value['imagem']?>"
					  <?php }else{ ?> 
					  	actionBtn="negado" style="background-color: #FF7B52;" href="#"
					  <?php } ?>
					  ><img src='img/excluir-depoimento-red.png'>Deletar
				</a>

			</div><!--box-btn-->
		</div><!--box-single-->
	</div><!--box-single-wraper-->

	<?php }?>

	<div class="clear"></div>

	</div><!--form-editar-->


<script>
	var slider01 = document.getElementById("Larg");
	var output01 = document.getElementById("printLarg");
	output01.innerHTML = slider01.value;

	slider01.oninput = function() {
	  output01.innerHTML = this.value;
	};

	var slider02 = document.getElementById("Alt");
	var output02 = document.getElementById("printAlt");
	output02.innerHTML = slider02.value;

	slider02.oninput = function() {
	  output02.innerHTML = this.value;
	};

	var slider03 = document.getElementById("Com");
	var output03 = document.getElementById("printCom");
	output03.innerHTML = slider03.value;

	slider03.oninput = function() {
	  output03.innerHTML = this.value;
	};

	var slider04 = document.getElementById("Pes");
	var output04 = document.getElementById("printPes");
	output04.innerHTML = slider04.value;

	slider04.oninput = function() {
	  output04.innerHTML = this.value;
	};
</script>


</div><!--box-content-->