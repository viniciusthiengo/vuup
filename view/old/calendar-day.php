<div id="box-modal-content">
	<h2><i class="fa fa-calendar"></i> Agenda do dia <?php echo date('d\/m\/Y', $_POST['time-init'])?></h2>
	<a href="#" class="close" title="Fechar"><i class="fa fa-times-circle"></i></a>
	<div class="container">
		<?php
			$html_Event = '';
			
			for($i = 0, $tam = count($arrayEventTime); $i < $tam; $i++){
				$timeInit = date('H:i', $arrayEventTime[$i]->getTimeInit()).' - ';
				$timeEnd = $arrayEventTime[$i]->getTimeInit() < $arrayEventTime[$i]->getTimeEnd() ? date('H:i', $arrayEventTime[$i]->getTimeEnd()).' - ' : '';
				$title = $arrayEventTime[$i]->getEvent()->getTitle();
				$content = $arrayEventTime[$i]->getEvent()->getContent();
				
				$html_Event .= <<<HTML
					<div class="section">
						<div class="title">
							<i class="fa fa-clock-o"></i>
							$timeInit
							$timeEnd
							$title
						</div>
						$content
					</div>
HTML;
		?>
		<?php
			}
		
			echo $html_Event;
		?>
	</div>
	<div class="copyright">&copy; MIBEC - Ministério Betel em Células <?php echo date('Y'); ?></div>
</div>