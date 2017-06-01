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
					<h1><?php echo $post->getTitle(); ?></h1>
					
					<div class="conf-post">
						<span class="border-radius" title="Autor">
							<i class="fa fa-user"></i>
							<?php echo $post->getUser()->getName(); ?>
						</span>
						<span class="border-radius" title="Data publicação">
							<i class="fa fa-calendar"></i>
							<?php echo $post->getTimeFormated(); ?>
						</span>
						<span class="border-radius" title="Visualizações">
							<i class="fa fa-eye"></i>
							<?php echo $post->getQtdView(); ?> views
						</span>
						<?php
							// COMMENT
							if($post->getStatusComment() == 1){
						?>	
								<span class="border-radius" title="Comentários">
									<i class="fa fa-comments"></i>
									<?php echo $post->getQtdComment(); ?> comentários
								</span>
						<?php
							}
						?>
					</div>
					
					<?php
						// CONTENT
							echo $post->getContent();
						// COMMENT
							if($post->getStatusComment() == 1){
					?>					
								<div class="comment-box">
									<div class="title">
										Comentários
									</div>
									<div class="fb-comments" data-notify="true" data-mobile="true" data-href="http://www.mibec.com.br/<?php echo $post->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
								</div>
					<?php
						}
					?>
				</div>
			</section>
		<!-- end CENTER -->
		
		<!-- start FOOTER -->
			<script type="text/javascript">
				MibecJavaScript.destroyProgressBar();
			</script>
			<?php
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript">
				var url = '<?php echo $_SERVER['SCRIPT_URI']; ?>';
				var post = <?php echo $post->getId(); ?>;
				getfbcount(url, post);
				getfbcommentscount(url, post);
				gettwcount(url, post);
			</script>
		<!-- end FOOTER -->
	</body>
</html>