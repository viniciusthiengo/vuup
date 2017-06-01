<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="MIBEC, Ministério Betel em Células" />
		<meta name="description" content="Ministério Betel em Células" />
		
		<title><?php echo $_GET['search-text']; ?></title>
		
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
					<h1 class="text-search"><?php echo $_GET['search-text']; ?></h1>
					
					<?php
						$tam = count($arrayPost);
						$html_Post = '';
						
						for($i = 0; $i < $tam; $i++){
							$url = __PATH_FOR_LONG_URL__.$arrayPost[$i]->getUrl();
							$img = __PATH_FOR_LONG_URL__.'img/post/100-100/'.$arrayPost[$i]->getImage()->getRealName();
							$title = $arrayPost[$i]->getTitle();
							$time = $arrayPost[$i]->getDateAsFormatedPost(true);
							$qtdView = $arrayPost[$i]->getQtdView();
							$qtdView = $qtdView == 1 ? $qtdView.' view' : $qtdView.' views';
							$qtdComment = $arrayPost[$i]->getQtdComment();
							$qtdComment = $qtdComment == 1 ? $qtdComment.' comentário' : $qtdComment.' comentários';
							
							$user = '';
							if(is_object($arrayPost[$i]->getUser())){
								$user = '<span class="border-radius" title="Autor"> <i class="fa fa-user"></i> '.$arrayPost[$i]->getUser()->getName().'</span>';
							}
							
							$html_Post .= <<<HTML
								<a href="$url" class="post">
									<img src="$img" width="100" height="100" />
									<div class="info">
										<span>$title</span>
										<div class="conf-post">
											$user
											<span class="border-radius" title="Data publicação">
												<i class="fa fa-calendar"></i>
												$time
											</span>
											<span class="border-radius" title="Visualizações">
												<i class="fa fa-eye"></i>
												$qtdView
											</span>
											<span class="border-radius" title="Comentários">
												<i class="fa fa-comments"></i>
												$qtdComment
											</span>
										</div>
									</div>
									<div class="cl"></div>
								</a>
HTML;
						}
						
						
						if(empty($html_Post)){
							$html_Post = '<br /><h2>Nenhum post encontrado para a busca informada.</h2>';
						}
						
						echo $html_Post;
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
		<!-- end FOOTER -->
	</body>
</html>