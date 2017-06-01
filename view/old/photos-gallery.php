<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="description" content="<?php echo $gallery->getTitle(); ?>" />
		
		<title><?php echo $gallery->getTitle(); ?></title>
		
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
			<link rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>js/galleriffic-2.0/css/galleriffic-2.css" type="text/css" />
		<!-- end TOP -->
	</head>
	
	
	
	<body>
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- end TOP -->
		
		
		
		
		<!-- start CENTER -->
			<section id="center">
				<div class="left page">
					
					<div class="bread-combs border-radius">
						<a href="<?php echo __PATH_FOR_LONG_URL__; ?>" title="Home">Home</a>
						&raquo;
						<a href="<?php echo __PATH_FOR_LONG_URL__; ?>fotos" title="Fotos">Fotos</a>
						&raquo;
						<?php echo $gallery->getTitle(); ?>
					</div>
					
					<h1><?php echo $gallery->getTitle(); ?></h1>
					
					<div id="gallery" class="content">
						<div id="controls" class="controls"></div>
						<div class="slideshow-container">
							<div id="loading" class="loader"></div>
							<div id="slideshow" class="slideshow"></div>
						</div>
						<div id="caption" class="caption-container"></div>
					</div>
					<div class="cl"></div>
					<div class="hl"></div>
					<div id="thumbs" class="navigation">
						<ul class="thumbs noscript">
							<?php
								$arrayGalleryElement = $gallery->getArrayGalleryElement();
								$html_Gallery = '';
								
								for($i = 0, $tam = count($arrayGalleryElement); $i < $tam; $i++){
									$title = $arrayGalleryElement[$i]->getTitle();
									$description = $arrayGalleryElement[$i]->getText();
									$img = __PATH_FOR_LONG_URL__.'img/gallery/1000-1000/'.$arrayGalleryElement[$i]->getImage()->getRealName();
									$imgThumb = __PATH_FOR_LONG_URL__.'img/gallery/80-80/'.$arrayGalleryElement[$i]->getImage()->getRealName();
									
									$html_Gallery .= <<<HTML
										<li>
											<a class="thumb" name="leaf" href="$img" title="$title">
												<img src="$imgThumb" alt="$title" />
											</a>
											<div class="caption">
												<div class="image-title">$title</div>
												<div class="image-desc">$description</div>
											</div>
										</li>
HTML;
								}
								echo $html_Gallery;
							?>
						</ul>
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
								<div class="fb-comments" data-href="http://www.mibec.com.br/<?php echo $gallery->getPathUrl().$gallery->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
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
				
				
				
				
				<!-- start RIGHT -->
					<?php
						require_once(__PATH__.'/view/body/right.php');
					?>
				<!-- end RIGHT -->
				<div class="cl"></div>
			</section>
		<!-- end CENTER -->
		
		
		
      

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
			<script type="text/javascript">
				var urlCtrl = '../package/ctrl/CtrlAdmin.php';
				var methodLikes = 'photos-update-likes-facebook';
				var methodComments = 'photos-update-comments-facebook';
				var url = '<?php echo $_SERVER['SCRIPT_URI']; ?>';
				var post = <?php echo $gallery->getId(); ?>;
				getfbcount(urlCtrl, methodLikes, url, post);
				getfbcommentscount(urlCtrl, methodComments, url, post);
			</script>
			<script type="text/javascript" src="<?php echo __PATH_FOR_LONG_URL__; ?>js/galleriffic-2.0/js/jquery.galleriffic.js"></script>
			<script type="text/javascript" src="<?php echo __PATH_FOR_LONG_URL__; ?>js/galleriffic-2.0/js/jquery.opacityrollover.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					// We only want these styles applied when javascript is enabled
					$('div.navigation').css({'width' : '300px', 'float' : 'left'});
					$('div.content').css('display', 'block');

					// Initially set opacity on thumbs and add
					// additional styling for hover effect on thumbs
					var onMouseOutOpacity = 0.67;
					$('#thumbs ul.thumbs li').opacityrollover({
						mouseOutOpacity:   onMouseOutOpacity,
						mouseOverOpacity:  1.0,
						fadeSpeed:         'fast',
						exemptionSelector: '.selected'
					});
					
					// Initialize Advanced Galleriffic Gallery
					var gallery = $('#thumbs').galleriffic({
						delay:                     2500,
						numThumbs:                 1000,
						preloadAhead:              10,
						enableTopPager:            false,
						enableBottomPager:         true,
						maxPagesToShow:            7,
						imageContainerSel:         '#slideshow',
						controlsContainerSel:      '#controls',
						captionContainerSel:       '#caption',
						loadingContainerSel:       '#loading',
						renderSSControls:          true,
						renderNavControls:         true,
						playLinkText:              'Iniciar',
						pauseLinkText:             'Pausar',
						prevLinkText:              '&lsaquo; Foto anterior',
						nextLinkText:              'Próxima foto &rsaquo;',
						nextPageLinkText:          'Próxima &rsaquo;',
						prevPageLinkText:          '&lsaquo; Anterior',
						enableHistory:             false,
						autoStart:                 false,
						syncTransitions:           true,
						defaultTransitionDuration: 900,
						onSlideChange:             function(prevIndex, nextIndex) {
							// 'this' refers to the gallery, which is an extension of $('#thumbs')
							this.find('ul.thumbs').children()
								.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
								.eq(nextIndex).fadeTo('fast', 1.0);
						},
						onPageTransitionOut:       function(callback) {
							this.fadeTo('fast', 0.0, callback);
						},
						onPageTransitionIn:        function() {
							this.fadeTo('fast', 1.0);
						}
					});
				});
			</script>
		<!-- end FOOTER -->
	</body>
</html>