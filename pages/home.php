<section class="home-bg">

	<?php 
		$banner = Mysql::conectar()->prepare("SELECT * FROM `tb_site.slides` ORDER BY order_id ASC");
	  	$banner->execute();
	  	$banner = $banner->fetchAll();
		foreach ($banner as $key => $value) {?>

	<div class="banner-single" style="background-image: url(<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $value['slide']?>);"></div>
	<?php } ?>
	<div class="overlay"></div>
	<div class="form-home">
		<h2>Qual o seu melhor e-mail?</h2>
		<form method="post" class="ajax-form">
			<input type="hidden" name="Receber_Novidades">
			<input type="text" name="email" required>
			<input type="submit" name="acao" value="Cadastrar">
		</form>
	</div><!--form-home-->

	<div class="home-btn">

		<div class="bullets-span">
		</div><!--bullets-span-->

	</div><!--home-btn-->
	
</section><!--home-bg-->

<section class="sobre">
	<div class="container">
		<div class="sobre-parte-1">
			<h2><?php echo $infoSite['nome_autor']?></h2>
			<p><?php echo $infoSite['descricao_autor']?></p>
		</div><!--sobre-parte-1-->
		<div class="sobre-parte-2">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $infoSite['img_autor']?>">
		</div><!--sobre-parte-2-->
	</div><!--container-->
</section><!--sobre-->

<section class="especialidades">
	
	<h2>Especialidades</h2>

	<div class="container">
		
		<div class="especialidades-single">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $infoSite['img_especial1']?>">
			<h2><?php echo $infoSite['titulo_especial1']?></h2>
			<p><?php echo $infoSite['descricao_especial1']?></p>
		</div><!--especialidades-single-->

		<div class="especialidades-single">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $infoSite['img_especial2']?>">
			<h2><?php echo $infoSite['titulo_especial2']?></h2>
			<p><?php echo $infoSite['descricao_especial2']?></p>
		</div><!--especialidades-single-->

		<div class="especialidades-single">
			<img src="<?php echo INCLUDE_PATH_PAINEL;?>uploads/<?php echo $infoSite['img_especial3']?>">
			<h2><?php echo $infoSite['titulo_especial3']?></h2>
			<p><?php echo $infoSite['descricao_especial3']?></p>
		</div><!--especialidades-single-->

	</div><!--container-->

</section><!--especialidades-->

<section class="depoimentos-servicos">
	<div class="container">
		<div class="depoimentos" id="depoimentos">
			<h2>Depoimentos dos nossos clientes</h2>
			<?php 
				$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3");
				$sql->execute();
				$depoimentos = $sql->fetchAll();
				foreach($depoimentos as $key => $value){
			?>
			<div class="depoimentos-single">
				<p>"<?php echo $value['depoimento']?>"</p>
				<p><?php echo $value['nome']?> - <?php echo $value['date']?></p>
			</div><!--depoimentos-single-->
			<?php } ?>
		</div><!--depoimentos-->
		<div class="servicos" id="servicos">
			<h2>Serviços</h2>
			<ul>
				<?php
					$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_site.servico` ORDER BY order_id ASC LIMIT 5");
					$sql->execute();
					$servicos = $sql->fetchAll();
					foreach($servicos as $key => $value){
				?>
				<li><?php echo $value['servicos']?></li>
				<?php } ?>
			</ul>
		</div><!--servicos-->
	</div><!--container-->
</section><!--depoimentos-->