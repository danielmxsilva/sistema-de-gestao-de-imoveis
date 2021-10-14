<?php include('config.php');?>
<?php Site::updateUsuarioOnline();?>
<?php Site::contador();?>
<?php
	$infoSite = Mysql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	$infoSite->execute();
	$infoSite = $infoSite->fetch();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $infoSite['titulo']?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH?>css/style.css">
	<link rel="shortcut icon" type="icon/png" href="<?php echo INCLUDE_PATH?>img/icone.png">
	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '{your-pixel-id-goes-here}');
	  fbq('track', 'PageView');
	</script>
	<noscript>
	  <img height="1" width="1" style="display:none" 
	       src="https://www.facebook.com/tr?id={your-pixel-id-goes-here}&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
</head>
<body>

	<?php

		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch($url){
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;
			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}


	?>

	<header class="header-index">
		<div class="container">
			<a href="<?php echo INCLUDE_PATH;?>home" attr="logo"></a>
			<nav class="desktop">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH;?>home">HOME</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">DEPOIMENTOS</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>servicos">SERVIÇOS</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>noticias">BLOG</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">CONTATO</a></li>
				</ul>
			</nav>
			<nav class="mobile">
				<div class="icone-menu"></div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH;?>home">HOME</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">DEPOIMENTOS</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>servicos">SERVIÇOS</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>noticias">BLOG</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">CONTATO</a></li>
				</ul>
			</nav>
		</div><!--container-->
	</header>

<div class="container-principal">

	<?php

		//$url = isset($_GET['url']) ? $_GET['url'] : 'home';

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			if($url != 'depoimentos' && $url != 'servicos'){
				$urlPar = explode('/',$url)[0];
				if($urlPar != 'noticias'){
					$pageof = true;
					include('pages/pageoff.php');
				}else{
					include('pages/noticias.php');
				}
			}else{
				include('pages/home.php');
			}
			
		}

	?>
	

</div><!--container-principal-->

<footer <?php if(isset($pageof) && $pageof == true) echo 'class="fixed"';?>>
	<div class="container">
		<p>Todos os direitos reservados</p>
	</div><!--container-->
</footer>

	<script src="<?php echo INCLUDE_PATH?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH?>js/menu.js"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/home.js"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/slide.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCDIxxm6r_Lygi8XG1oCs_ZWyD4G2fPpSM"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/scripts.js"></script>
	<?php
		if($url == 'home' || $url == ''){
	?>
	<script src="<?php echo INCLUDE_PATH;?>js/form-home.js"></script>
	<?php
		}
	?>
	<?php
		if(is_array($url) && strstr($url[0],'noticias') !== false){
	?>
	<script>
		$(function(){
			var url = 'http://localhost/site_dinamico_aula/';
			$('select').change(function(){
				location.href=url+"noticias/"+$(this).val();
			})
		})
	</script>
	<?php } ?>

	<?php
		if($url == 'contato'){
	?>
	<script src="<?php echo INCLUDE_PATH;?>js/jquery.mask.js"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/form.js"></script>
	<?php
		}
	?>

</body>
</html>