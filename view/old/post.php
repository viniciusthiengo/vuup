<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="description" content="<?php echo $post->getSummary(); ?>" />
		
		<title><?php echo $post->getTitle(); ?></title>
		
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
				<div class="left page aux-img-content">
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
							
						
						// RECOMMENDED
							$arrayPostRecommended = $post->getArrayPostRecommended();
							if(count($arrayPostRecommended) > 0){
					?>
								<div class="recommended-box">
									<div class="title">
										Conteúdos relacionados
									</div>
									<?php
										$tam = count($arrayPostRecommended);
										$html_PostRecommended = '';
										
										for($i = 0; $i < $tam; $i++){
											$url = $arrayPostRecommended[$i]->getUrl();
											$title = $arrayPostRecommended[$i]->getTitle();
											$img = __PATH_FOR_LONG_URL__.'img/post/50-50/'.$arrayPostRecommended[$i]->getImage()->getRealName();
											$float = $i % 2 == 0 ? 'left' : 'right';
											
											$html_PostRecommended = $i % 2 == 0 ? '<div class="cl"></div>'.$html_PostRecommended : $html_PostRecommended;
											$html_PostRecommended .= <<<HTML
												<a class="recommended" href="$url" title="$title" style="float: $float">
													<img src="$img" width="50" height="50" alt="$title" />
													<span>
														$title
													</span>
													<div class="cl"></div>
												</a>
HTML;
										}
										echo $html_PostRecommended;
									?>
									<div class="cl"></div>
								</div>
					<?php
						}
						
						// COMMENT
							if($post->getStatusComment() == 1){
					?>					
								<div class="comment-box">
									<div class="title">
										Comentários
									</div>
									<div class="cl"></div>
									<div class="fb-comments" data-href="http://www.mibec.com.br/<?php echo $post->getUrl(); ?>" data-width="690" data-numposts="50" data-colorscheme="light"></div>
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
				var urlCtrl = 'package/ctrl/CtrlPost.php';
				var methodLikes = 'update-likes-facebook';
				var methodComments = 'update-comments-facebook';
				var url = '<?php echo $_SERVER['SCRIPT_URI']; ?>'; // 'http://localhost/vinicius/mibec/<?php echo $post->getUrl(); ?>';
				var post = <?php echo $post->getId(); ?>;
				getfbcount(urlCtrl, methodLikes, url, post);
				getfbcommentscount(urlCtrl, methodComments, url, post);
			</script>
		<!-- end FOOTER -->
	</body>
</html>