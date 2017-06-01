<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="description" content="<?php echo $cell->getName(); ?>" />
		
		<title><?php echo $cell->getName(); ?></title>
		
		<!-- start TOP -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				//require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
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
						<a href="<?php echo __PATH_FOR_LONG_URL__; ?>celulas" title="Células">Células</a>
						&raquo;
						<?php echo $cell->getName(); ?>
					</div>
				
					<h1><?php echo $cell->getName(); ?></h1>
					
					<?php
						$arrayCellMember = $cell->getArrayCellMember();
						$html_Cell = '';
						
						for($i = 0, $tam = count($arrayCellMember); $i < $tam; $i++){
							$name = $arrayCellMember[$i]->getName();
							$function = $arrayCellMember[$i]->getFunction();
							$img = __PATH_FOR_LONG_URL__.'img/cell/100-100/'.$arrayCellMember[$i]->getImage()->getRealName();
							
							$html_Cell = $i % 5 == 0 ? $html_Cell.'<div class="cl"></div>' : $html_Cell;
							$html_Cell .= <<<HTML
								<div class="people-box">
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
				var methodLikes = 'cells-update-likes-facebook';
				var methodComments = 'cells-update-comments-facebook';
				var url = '<?php echo $_SERVER['SCRIPT_URI']; ?>';
				var post = <?php echo $cell->getId(); ?>;
				getfbcount(urlCtrl, methodLikes, url, post);
				getfbcommentscount(urlCtrl, methodComments, url, post);
			</script>
		<!-- end FOOTER -->
	</body>
</html>