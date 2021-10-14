<?php
	
	$url = explode('/',$_GET['url']);

	if(!isset($url[2])){

	$categoria = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$categoria->execute(array(@$url[1]));
	$categoria = $categoria->fetch();
?>
<section class="header-noticias">
	<div class="container">
		<h2>Inscreva-se em nossa lista</h2>
		<form>
			<input type="text" name="email-lista" placeholder="E-mail" required>
			<input type="submit" name="acao-lista" value="CADASTRAR-SE">
		</form>
	</div><!--container-->
</section><!--header-noticias-->
<div class="container">

<aside class="aside-lateral">

	<div class="container">
		<h2>Insira uma busca</h2>
		<form method="POST">
			<input type="text" name="parametro" placeholder="Buscar">
			<input type="submit" name="busca" value="BUSCAR">
		</form>
	</div><!--container-->

	<div class="container">
		<h2>Selecione a Categoria</h2>
		<form>
			<select name="categoria">
				<option value="" selected>Todas as categorias</option>
				<?php
					$categoria = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
					$categoria->execute();
					$categoria = $categoria->fetchAll();

					foreach($categoria as $key => $value) {
						
				?>
				<option <?php if($value['slug'] == @$url[1]) echo 'selected';?> value="<?php echo $value['slug']?>"><?php echo $value['nome']?></option>
				<?php } ?>
			</select>
		</form>
	</div><!--container-->

	<div class="container autor">
		<h2>Conheça o autor</h2>
		<?php
			$infoAutor = Mysql::conectar()->prepare("SELECT * FROM `tb_site.config`");
			$infoAutor->execute();
			$infoAutor = $infoAutor->fetch();
		?>
		<div class="img-autor">
			<img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $infoAutor['img_autor']?>">
		</div>
		<h3><?php echo $infoAutor['nome_autor']?></h3>
		<p><?php echo substr($infoAutor['descricao_autor'],0,250).'..'?></p>
	</div><!--container-->

	<div class="container">
		<h2>As mais lidas</h2>
		<ol>
			<li>
				Loren ipsum dollor
				<hr>
			</li>
			<li>
				Loren ipsum dollor
				<hr>
			</li>
			<li>
				Loren ipsum dollor
				<hr>
			</li>
		</ol>
	</div><!--container-->

</aside>



<section class="conteudo-noticias">
	<div class="container">
		<?php
		$categoria = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
		$categoria->execute(array(@$url[1]));
		$categoria = $categoria->fetch();
		$porPagina = 2;
			if(!isset($_POST['parametro'])){
				if(@$categoria['nome'] == ''){
					echo '<h2>Visualizando Todos os Posts</h2>';
				}else{
					echo '<h2>Visualizando Posts em <b style="text-transform:uppercase;">'.$categoria['nome'].'</b></h2>';
				}
			}else{
				if(@$categoria['nome'] == ''){
					echo '<h2>Mostrando resultados de "'.$_POST['parametro'].'" em todas as categorias.';
				}else{
					echo '<h2>Mostrando resultados de "'.$_POST['parametro'].'" na categoria '.$categoria['nome'].'</h2>';
				}
			}

			$query = "SELECT * FROM `tb_site.noticias` ";
			if(@$categoria['nome'] != ''){
				$categoria['id'] = (int)$categoria['id'];
				$query.="WHERE categoria_id = $categoria[id]";
			}
			if(isset($_POST['parametro'])){
				if(strstr($query,'WHERE') !== false){
					$busca = $_POST['parametro'];
					$query.=" AND titulo LIKE '%$busca%'";
				}else{
					$busca = $_POST['parametro'];
					$query.=" WHERE titulo LIKE '%$busca%'";
				}
			}
			$query2 = "SELECT * FROM `tb_site.noticias` ";
			if(@$categoria['nome'] != ''){
				$categoria['id'] = (int)$categoria['id'];
				$query2.="WHERE categoria_id = $categoria[id]";
			}
			if(isset($_POST['parametro'])){
				if(strstr($query2,'WHERE') !== false){
					$busca = $_POST['parametro'];
					$query2.=" AND titulo LIKE '%$busca%'";
				}else{
					$busca = $_POST['parametro'];
					$query2.=" WHERE titulo LIKE '%$busca%'";
				}
			}
			$totalPagina = Mysql::conectar()->prepare($query2);
			$totalPagina->execute();
			$totalPagina = ceil($totalPagina->rowCount() / $porPagina);
			if(!isset($_POST['parametro'])){
				if(isset($_GET['pagina'])){
					$pagina = (int)$_GET['pagina'];
					if($pagina > $totalPagina)
						$pagina = 1;
					$queryPg = ($pagina - 1) * $porPagina;
					$query.=" ORDER BY order_id DESC LIMIT $queryPg,$porPagina";
				}else{
					$pagina = 1;
					$query.=" ORDER BY order_id DESC LIMIT 0,$porPagina";
				}
			}else{
				$query.=" ORDER BY order_id DESC";
			}
			$sql = Mysql::conectar()->prepare($query);
			$sql->execute();
			$noticias = $sql->fetchAll();
		?>
		<?php
			foreach($noticias as $key => $value){
			$sql = Mysql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ? ");
			$sql->execute(array($value['categoria_id']));
			$categoriaNome = $sql->fetch()['slug'];
		?>
		<div class="noticia-single">
			<h3><?php echo date('d/m/Y',strtotime($value['data']))?> - <?php echo strip_tags($value['titulo'])?></h3>
			<p><?php echo substr(strip_tags($value['conteudo']),0,350)?>...</p>
			<a href="<?php echo INCLUDE_PATH?>noticias/<?php echo $categoriaNome;?>/<?php echo $value['slug']?>">Ler Mais</a>
			<hr>
		</div><!--noticia-single-->
		<?php } ?>
		<?php
			

		?>
		<div class="paginacao">
			<?php
				if(!isset($_POST['parametro'])){
					for($i = 1; $i <= $totalPagina; $i++){
						$catStr = (@$categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
						if($pagina == $i){
							echo '<a class="pag-selected" href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
						}else{
							echo '<a href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
						}
					}
				}
			?>
			
		</div><!--paginacao-->

	</div><!--container-->
</section><!--conteudo-noticias-->

<div class="clear"></div>

</div><!--container-->

<?php }else{
	include('noticia_single.php');
}?>