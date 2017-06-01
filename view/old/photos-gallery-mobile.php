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
						<span class="border-radius" title="Visualizações">
							<i class="fa fa-camera"></i>
							<?php echo count($gallery->getArrayGalleryElement()); ?> fotos
						</span>
						<?php
							// COMMENTS
							if($gallery->getStatusComment() == 1){
						?>
								<span class="border-radius" title="Comentários">
									<i class="fa fa-comments"></i>
									<?php echo $gallery->getQtdComment(); ?> comentários
								</span>
						<?php
							}
						?>
					</div>
					
					<div class="gallery-mibec">
						<?php
							$arrayGalleryElement = $gallery->getArrayGalleryElement();
							if(count($arrayGalleryElement) > 0){
								$id = $arrayGalleryElement[0]->getId();
								$title = $arrayGalleryElement[0]->getTitle();
								$description = $arrayGalleryElement[0]->getText();
								$img = __PATH_FOR_LONG_URL__.'img/gallery/1000-1000/'.$arrayGalleryElement[0]->getImage()->getRealName();
								$arrowPrev = __PATH_FOR_LONG_URL__.'img/system/mobile/icon/arrow_06.png';
								$arrowNext = __PATH_FOR_LONG_URL__.'img/system/mobile/icon/arrow_07.png';
								
								$html_Gallery = <<<HTML
									<div id="glf-$id" class="gallery-row">
										<div class="img-gm">
											<img src="$img" />
											<a id="to-prev" href="#" class="to-prev"><img src="$arrowPrev" /></a>
											<a id="to-next" href="#" class="to-next"><img src="$arrowNext" /></a>
										</div>
										<div class="title-gm">$title</div>
										<div class="desc-gm">$description</div>
									</div>
HTML;
								for($i = 0, $tam = count($arrayGalleryElement); $i < $tam; $i++){
									$id = $arrayGalleryElement[$i]->getId();
									$title = $arrayGalleryElement[$i]->getTitle();
									$description = $arrayGalleryElement[$i]->getText();
									$img = __PATH_FOR_LONG_URL__.'img/gallery/1000-1000/'.$arrayGalleryElement[$i]->getImage()->getRealName();
									
									$html_Gallery .= <<<HTML
										<div id="gl-$id" class="gallery-hide">
											<span><img src="$img" /></span>
											<span>$title</span>
											<span>$description</span>
										</div>
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
								<div class="fb-comments" data-href="http://www.mibec.com.br/fotos/<?php echo $gallery->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
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
				$('a.to-prev, a.to-next').click(function(e){
					
					e.preventDefault();
					var $handle = $(this).parents('div.gallery-row');
					var id = $handle.attr('id').replace(/[^\d]/g, '');
					var prevNext = $(this).hasClass('to-prev') ? $('#gl-'+id).prev('div') : $('#gl-'+id).next('div');
					
					$handle.stop(true, true).fadeTo('slow', 0.1);
					$handle.attr('id', 'glf-'+prevNext.attr('id').replace(/[^\d]/g, ''));
					$handle.find('div.img-gm').find('img').eq(0).attr('src', prevNext.find('span').eq(0).find('img').attr('src'));
					$handle.find('div.title-gm').text(prevNext.find('span').eq(1).text());
					$handle.find('div.desc-gm').text(prevNext.find('span').eq(2).text());
					$handle.stop(true, true).fadeTo('slow', 1);
					verifyPrevNext($handle, 1);
					verifyPrevNext($handle, 2);
				});
				
				verifyPrevNext($('div.gallery-row'), 1);
				verifyPrevNext($('div.gallery-row'), 2);
				
				function verifyPrevNext($handle, type){
					var id = $handle.attr('id').replace(/[^\d]/g, '');
					
					if(type == 1 && $('#gl-'+id).prev('div.gallery-hide').length > 0){
						$('a.to-prev').stop(true, true).fadeIn('fast');
					}
					else if(type == 1){
						$('a.to-prev').stop(true, true).fadeOut('fast');
					}
					else if(type == 2 && $('#gl-'+id).next('div.gallery-hide').length > 0){
						$('a.to-next').stop(true, true).fadeIn('fast');
					}
					else{
						$('a.to-next').stop(true, true).fadeOut('fast');
					}
				}
			</script>
		<!-- end FOOTER -->
	</body>
</html>