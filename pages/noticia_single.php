<?php
	$url = explode('/',$_GET['url']);
	$verifica_categoria = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'noticias');
	}

	$post = $post->fetch();
?>

<section class="noticia-single">
	<header style="background-image:url('../../painel/uploads/<?php echo $post['capa']?>');">
		<div style="background-color: rgba(0, 0, 0, 0.6);" class="overlay"></div>
		<h1 style="color: white;font-weight: bold; position: relative; z-index: 99;"><?php echo date('d/m/Y',strtotime($post['data']))?> - <?php echo $post['titulo']?></h1>
	</header>
	<div class="container">
		<article>
			
			
			<?php echo $post['conteudo']?>
			
		</article>
	</div><!--container-->
</section><!--noticia-single-->