
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
		<a href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias">
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/listar.png">
			<h2>Gerenciar Pagamentos</h2>
		</a>
			<span>/</span>
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>img/lapis.png">
			<h2 class="active-btn">Visualizando Pagamentos</h2>
		</div><!--breadcrump-->
</div><!--wraper-titulo-->

<div class="box-content">

	<div class="busca">
		<h2>Realizar uma busca</h2>
		<form method="post">
			<input type="text" name="busca" placeholder="nome do pagamento, valor">
			<input type="submit" name="acao" value="Buscar">
		</form>
	</div><!--busca-->

	<div class="table-wraper">
		<table>
			<thead class="titulo-tabela">
				<th>Nome do Pagamento</th>
				<th>Cliente</th>
				<th>Valor</th>
				<th>Vencimento</th>
				<th>Enviar E-mail</th>
				<th>Marcar como Pago</th>
			</thead>

			
			<?php

			if($_GET['url'] == 'controle-financeiro'){
				$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` WHERE status = 0 ORDER BY vencimento ASC");
			}
				$sql->execute();
				$pendentes = $sql->fetchAll();
				foreach($pendentes as $key => $value) {
					$nomeCliente = Mysql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
					$nomeCliente->execute();
					$nomeCliente = $nomeCliente->fetch()['nome'];
					$style = "";
				if(strtotime(date('Y-m-d')) >= strtotime($value['vencimento'])){
					$style = 'style="background-color:#bf360c;color:white;font-weight:bold;"';
				}
			?>

			<?php
			/*
				$query = "";
				if(isset($_POST['acao'])){
					$busca = $_POST['busca'];
					$query = "WHERE nome LIKE '%$busca%' OR valor LIKE '%$busca%' ";
				}
				$clientes = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.financeiro` $query");
				$clientes->execute();
				$clientes = $clientes->fetchAll();
				if(isset($_POST['acao'])){
					echo '<div class="cliente-result">Foram encontrados <b>'.count($clientes).'</b> resultado(s)</div>';
				}
				foreach($clientes as $value){
					$nomeCliente = Mysql::conectar()->prepare("SELECT `nome` FROM `tb_admin.clientes` WHERE id = $value[cliente_id]");
					$nomeCliente->execute();
					$nomeCliente = $nomeCliente->fetch()['nome'];
				}
				*/
			?>
			<tbody <?php echo $style;?>>		
				<td><?php echo $value['nome']; ?></td>
				<td><?php echo $nomeCliente; ?></td>
				<td><?php echo $value['valor']; ?></td>
				<td><?php echo date('d/m/Y',strtotime($value['vencimento'])); ?></td>
				<td class="tb-editar">
					<a <?php
							if($_SESSION['cargo'] >= 1){
						  ?>
						   href=""
						  <?php }else{ ?> 
						  	actionBtn="negado" href="#"
						  <?php } ?>
						 ><img src="img/editar-depoimento-verde.png"></a>
				</td>
				<td class="tb-excluir">
					<a <?php
							if($_SESSION['cargo'] >= 1){
						  ?>
						   href="<?php echo INCLUDE_PATH_PAINEL?>editar-clientes?id=<?php echo $id?>&pago=<?php echo $value['id']?>"
						  <?php }else{ ?> 
						  	actionBtn="negado" href="#"
						  <?php } ?>
						 >
					<img src='img/excluir-depoimento-red.png'></a>
				</td>
			</tbody>
			<?php }?>	
			

		</table>
	</div><!--table-wraper-->

</div><!--box-content-->

<?php include("listar-concluidos.php")?>