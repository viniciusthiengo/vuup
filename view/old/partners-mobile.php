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
					<h1>Parceiros</h1>
					<?php
						$html_Partners = '';
						for($i = 0, $tam = count($arraySponsor); $i < $tam; $i++){
							$name = $arraySponsor[$i]->getName();
							$url = $arraySponsor[$i]->getUrl();
							$img = __PATH_FOR_LONG_URL__.'img/sponsor/240-1000/'.$arraySponsor[$i]->getImage()->getRealName();
							
							$html_Partners .= <<<HTML
								<div class="partner-box">
									<h1 style="">$name</h1>
									<a href="$url" title="$name">
										<img src="$img" width="240" />
									</a>
								</div>
HTML;
						}
						echo $html_Partners;
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
				$('div.partner-box').find('a').click(function(e){
					e.preventDefault();
					var url = $(this).attr('href');
					MibecJavaScript.callWebPage(url);
				});
			</script>
		<!-- end FOOTER -->
	</body>
</html>