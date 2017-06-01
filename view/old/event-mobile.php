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
						$date = date('d\/m\/Y', $eventTime->getTimeInit());
						$time = date('H:i', $eventTime->getTimeInit());
						$time .= $eventTime->getTimeInit() < $eventTime->getTimeEnd() ? ' - '.date('H:i', $eventTime->getTimeEnd()) : '';
					?>
					<h1>
						<?php
							echo '<i class="fa fa-calendar fa-6"></i> '.$date;
							echo '<br />';
							echo '<i class="fa fa-clock-o fa-6"></i> '.$time;
							echo '<br />';
							echo '<i class="fa fa-caret-right"></i> '.$eventTime->getEvent()->getTitle();
						?>
					</h1>
					<?php
						echo $eventTime->getEvent()->getContent(true);
					?>
				</div>
			</section>
		<!-- end CENTER -->
		
		<!-- start FOOTER -->
			<script type="text/javascript">
				MibecJavaScript.destroyProgressBar();
			</script>
		<!-- end FOOTER -->
	</body>
</html>