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
		<style>
			
		</style>
	</head>
	
	<body>
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					<h1><?php echo $gallery->getTitle(); ?></h1>
					
					<div class="conf-post">
						<span class="border-radius" title="VisualizaÃ§Ãµes">
							<i class="fa fa-video-camera fa-6"></i>
							<?php echo count($gallery->getArrayGalleryElement()); ?> vídeos
						</span>
						<?php
							// COMMENTS
							if($gallery->getStatusComment() == 1){
						?>
								<span class="border-radius" title="ComentÃ¡rios">
									<i class="fa fa-comments"></i>
									<?php echo $gallery->getQtdComment(); ?> comentários
								</span>
						<?php
							}
						?>
					</div>
					
					<div class="gallery-mibec video-box">
						<?php
							$arrayGalleryElement = $gallery->getArrayGalleryElement();
							if(count($arrayGalleryElement) > 0){
								for($i = 0, $tam = count($arrayGalleryElement); $i < $tam; $i++){
									$position = $i + 1;
									$video = $arrayGalleryElement[$i]->getVideoUrl();
									
									$html_Gallery .= <<<HTML
										<a href="$video">
											<i class="fa fa-video-camera fa-6"></i>
											Vídeo $position
										</a>
HTML;
								}
								echo $html_Gallery;
							}
						?>
					</div>
					
					<div class="cl"></div>
					<?php
						// COMMENTS
						if($gallery->getStatusComment() == 1){
					?>
							<div class="comment-box">
								<div class="title">
									Comentários
								</div>
								<div class="cl"></div>
								<div class="fb-comments" data-href="http://www.mibec.com.br/videos/<?php echo $gallery->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
								<script>(function(d, s, id) {
								  var js, fjs = d.getElementsByTagName(s)[0];
								  if (d.getElementById(id)) return;
								  js = d.createElement(s); js.id = id;
								  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=574639209279867";
								  fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
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
				$('div.video-box').find('a').click(function(e){
					e.preventDefault();
					
					var url = $(this).attr('href');
					MibecJavaScript.callWebPage(url);
				});
			</script>
		<!-- end FOOTER -->
	</body>
</html>