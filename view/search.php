<!doctype html>
<html lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="vuup" />
		<meta name="description" content="" />
		<meta property="og:image" content="" />
		
		<title>Vuup</title>
		
		<!-- start CSS -->
			<?php
				require_once(__PATH__.'/view/head/css.php');
				require_once(__PATH__.'/view/head/analyticstracking.php');
			?>
		<!-- end CSS -->
	</head>
	
	
	
	<body id="search-page">
		<!-- HEADER -->
			<?php
				require_once(__PATH__.'/view/head/top.php');
			?>
		<!-- HEADER -->
		
		
		
		<!-- MAIN -->
			<main>
				<div class="box-mode-search">
					<a class="list-bt br-3" title="Lista" href="box-list">
						<i class="fa fa-align-justify"></i>
					</a>
					<a class="grade-bt br-3 selected" title="Grade" href="box-grade">
						<i class="fa fa-th-large"></i>
					</a>
					<div class="cl"></div>
				</div>
				
				<div class="left">
					<div class="box-filter">
						<?php
							require_once(__PATH__.'/view/search-form.php');
						?>
					</div>
				</div>
				
				<div class="right">
					<div class="box-events">
						<?php
							require_once(__PATH__.'/view/event-list-make.php');
							
							if(count($arrayObj) > 0){
								echo $htmlGrade;
								echo $htmlList;
							}
							else{
						?>
								<p class="no-content">
									<i class="fa fa-frown-o"></i>
									Nenhum evento encontrado.
								</p>
						<?php
							}
						?>
					</div>
				</div>
				
				<div class="cl"></div>
			</main>
		<!-- MAIN -->
		
		
		
		
		

		
		<!-- start FOOTER -->
			<?php
				require_once(__PATH__.'/view/footer/footer.php');
				require_once(__PATH__.'/view/footer/js.php');
			?>
		<!-- end FOOTER -->
	</body>
</html>