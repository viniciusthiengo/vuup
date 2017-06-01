<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<head>
		<?php
			require_once(__PATH__.'/view/head/meta-tag.php');
		?>
		<meta name="keywords" content="V�deos MIBEC" />
		<meta name="description" content="V�deos MIBEC - Minist�rio Betel em C�lulas" />
		
		<title>V�deos</title>
		
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
					<h1>V�deos</h1>
					
					<?php
						require_once(__PATH__.'/view/videos-make-production.php');
						
						echo $html_Gallery;
						echo $html_LoadMore;
					?>
					<div class="cl"></div>
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