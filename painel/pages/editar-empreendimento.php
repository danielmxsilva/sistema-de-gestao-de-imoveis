<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$categoria = Painel::select('tb_admin.empreendimentos','id = ?',array($id));
	}else{
		Painel::alert('erro','Você Precisa Passar o ID!');
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
		<a href="<?php echo INCLUDE_PATH_PAINEL?>listar-empreendimentos">
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/listar.png">
			<h2>Gerenciar Empreendimentos</h2>
		</a>
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/editar-depoimento-gray.png">
			<h2 class="active-btn">Editar Empreendimento</h2>
		</div><!--breadcrump-->
</div><!--wraper-titulo-->

<div class="box-content" style="margin-top:40px;">
	<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/editar-depoimento-gray.png">

	<h2>Empreendimento: </h2>

	<div class="wraper10">

		<div class="row3">
			<h2 class="title-blue">Imagem do empreendimento</h2>
			<img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $categoria['imagem']?>">
		</div><!--row3-->

		<div class="row7">
			<h2 class="title-blue">Informações do empreendimento</h2>
			<p>Empreendimento: <?php echo $categoria['nome']?></p>
			<p>Tipo: <?php echo $categoria['tipo']?></p>
		</div><!--row7-->

	</div><!--wraper10-->


</div><!--box-content-->

<div class="box-content">
	<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/editar-usuario.png">
	<h2>Cadastrar Imovel</h2>

	<?php

		if(isset($_POST['acao_adicionar'])){
			$empreendId = $id;
			$nome = $_POST['nome'];
			$preco = $_POST['valor'];
			$area = $_POST['area'];

			$imagens = array();
			$amountFiles = count($_FILES['imagem']['name']);

			$sucesso = true;

			if($_FILES['imagem']['name'][0] != ''){

				for($i = 0; $i < $amountFiles; $i++){
					$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i],
					'size'=>$_FILES['imagem']['size'][$i]];
					if(Painel::imagemValida($imagemAtual) == false){
						$sucesso = false;
						Painel::alert('erro','Alguma imagem não é válida, por favor selecione imagem no formato jpg,jpeg ou png');
						break;
					}
				}
				
			}else{
				$sucesso = false;
				Painel::alert('erro','A imagem precisa ser selecionada!');
			}

			if($sucesso){

				for($i = 0; $i < $amountFiles; $i++) { 
					$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i],
					'name'=>$_FILES['imagem']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
				}

				$sql = Mysql::conectar()->prepare("INSERT INTO `tb_admin.imoveis` VALUES(null,?,?,?,?,?)");
				$sql->execute(array($empreendId,$nome,$preco,$area,0));
				$lastId = Mysql::conectar()->lastInsertId();
				foreach($imagens as $key => $value){
					$sql = Mysql::conectar()->exec("INSERT INTO `tb_admin.imagens_imoveis` VALUES(null,$lastId,'$value')");
				}

				Painel::alert('sucesso','Imovel adicionado com sucesso!');
			}
		}

	?>

	<div class="form-editar">
		<form method="POST" enctype="multipart/form-data">

			<div class="form-group form-produto">
				<span class="block-span">Nome:</span>
				<input style="width:100%;" type="text" name="nome" value="" >
			</div><!--from-group-->

			<div class="form-group form-produto">
				<span class="block-span">Preço:</span>
				<input style="width:100%;" type="text" name="valor" required value="">
			</div><!--from-group-->

			<div class="form-group form-produto">
				<span class="block-span">Area:</span>
				<span id="printLarg"></span>
				<input name="area" style="width:100%;" type="range" value="50" step="10" min="10" max="100" id="Larg">
			</div><!--form-group-->

			<div class="form-group form-produto">
				<span class="block-span">Imagens:</span>
				<input multiple type="file" name="imagem[]" id="input-img-adicionar">
				<label style="width: 150px; left: 0;" for="input-img-adicionar" name="imagem"><img src="<?php echo INCLUDE_PATH_PAINEL?>img/enviar-img.png"></label>
			</div><!--from-group-->

			<div class="form-group">
				<input type="hidden" name="tipo_acao" value="cadastrar_cliente">
				<input <?php permissaoInput(1,'acao_adicionar','Cadastrar')?>>
			
			</div><!--from-group-->
		</form>
	</div><!--form-editar-->

</div><!--box-content-->

<div class="box-content">
	<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/listar.png">
	<h2>Imoveis Cadastrados</h2>
	<div class="table-wraper">
		<table>
			<thead class="titulo-tabela">
				<th>Nome</th>
				<th>Preço</th>
				<th class="btn-green">Editar</th>
			</thead>
		<?php
			$pegaImovel = Painel::selectQuery('tb_admin.imoveis','empreendimento_id=?',array($id));
			foreach($pegaImovel as $key => $value){
		?>
			<tbody>
				<td>Imovel: <?php echo $value['nome']?></td>
				<td>Preço: R$ <?php echo $value['preco']?></td>
				<td class="tb-editar">
						<a href="<?php echo INCLUDE_PATH_PAINEL?>editar-imovel?id=<?php echo $value['id']?>"><img src="img/editar-depoimento-verde.png"></a>
				</td>
			</tbody>
		<?php } ?>
		</table>
	</div><!--table-wraper-->
</div><!--box-content-->


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


