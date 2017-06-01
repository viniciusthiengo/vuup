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
					<h1><?php echo $cell->getName(); ?></h1>
					
					<div class="conf-post">
						<span class="border-radius" title="Visualizações">
							<i class="fa fa-users"></i>
							<?php echo count($cell->getArrayCellMember()); ?> membros
						</span>
						<?php
							// COMMENTS
							if($cell->getStatusComment() == 1){
						?>
								<span class="border-radius" title="Comentários">
									<i class="fa fa-comments"></i>
									<?php echo $cell->getQtdComment(); ?> comentários
								</span>
						<?php
							}
						?>
					</div>
					
					<?php
						$arrayCellMember = $cell->getArrayCellMember();
						$html_Cell = '';
						
						for($i = 0, $tam = count($arrayCellMember); $i < $tam; $i++){
							$name = $arrayCellMember[$i]->getName();
							$function = $arrayCellMember[$i]->getFunction();
							$img = __PATH_FOR_LONG_URL__.'img/cell/100-100/'.$arrayCellMember[$i]->getImage()->getRealName();
							
							//$html_Cell = $i % 5 == 0 ? $html_Cell.'<div class="cl"></div>' : $html_Cell;
							$html_Cell .= <<<HTML
								<div class="people-box" style="float: none; display: inline-block;">
									<img src="$img" width="100" height="100" />
									<span>$function</span>
									<div>&bull; &bull; &bull; &bull;</div>
									$name
								</div>
HTML;
						}
						echo $html_Cell;
					?>
					<div class="cl"></div>
					<?php
						// COMMENTS
						if($cell->getStatusComment() == 1){
					?>
							<div class="comment-box">
								<div class="title">
									Comentários
								</div>
								<div class="cl"></div>
								<div class="fb-comments" data-href="http://www.mibec.com.br/celulas/<?php echo $cell->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
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
		<!-- end FOOTER -->
	</body>
</html>