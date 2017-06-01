<?php
	if(preg_match('/^(mensagem-do-dia|versiculo-do-dia){1}$/', $_GET['page'])){
		$title = $obj->getTitle();
		$content = '<p>'.$obj->getText().'</p>';
	}
	else{
		$title = utf8_decode($obj->getName());
		$content = $obj->getContent();
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
			<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/mibec-mobile.css" media="all" />
		<!-- end TOP -->
		<style type="text/css">
			
		</style>
	</head>
	
	
	
	<body>
		
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1><?php echo $title; ?></h1>
					<?php
						echo $content;
					?>
				</div>
			</section>
		<!-- end CENTER -->
		
		<!-- start FOOTER -->
			<script type="text/javascript">
				MibecJavaScript.destroyProgressBar();
			</script>
		<!-- end FOOTER -->
	</body>
</html>