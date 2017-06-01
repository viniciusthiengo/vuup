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
					<?php
						if(is_object($map) && $map->getStatus() == 1){
							echo '<h1>'.$map->getTitle().'</h1>';
							echo '<div class="location-mobile">'.$map->getText().'</div>';
						}
						else{
							echo '<h1>Indisponível</h1>';
							echo '<p>Localização indisponível no momento</p>';
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
				resizeMap();
				$(window).resize(function(){
					resizeMap();
				});
				
				function resizeMap(){
					$('div.location-mobile').find('iframe').css({
						width: $(window).width()+'px',
						height: $(window).height()+'px'
					});
				}
			</script>
		<!-- end FOOTER -->
	</body>
</html>