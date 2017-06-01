<?php
	$arraySelect = array('', '', '', '', '', '', '', '', '', '', '');
	
	
	if(strcasecmp('radio', $_GET['page']) == 0){
		$arraySelect[0] = ' select';
	}
	else if(strcasecmp('celulas', $_GET['page']) == 0){
		$arraySelect[1] = ' select';
	}
	else if(strcasecmp('projetos', $_GET['page']) == 0){
		$arraySelect[2] = ' select';
	}
	else if(strcasecmp('downloads', $_GET['page']) == 0){
		$arraySelect[3] = ' select';
	}
	
	
	// ADJUST WIDGETS POSITIONS
		$positions = array('','','','','','','','','','');
		
		// RADIO
			
			if(is_object($radio) && $radio->getStatus() == 1){
				$url = 'http://www.mibec.maisouvida.com/#'; //__PATH_FOR_LONG_URL__.'radio';
				$positions[ $arrayWidgetPosition[0]->getPosition() ] = <<<HTML
					<a href="$url" class="radio $arraySelect[0];" target="_blank" title="Entrar na Rádio MIBEC">
						<i class="fa fa-volume-up"></i>
						Rádio MIBEC
					</a>
HTML;
			}
		
		// MESSAGE DAY
			if(is_object($messageDay) && $messageDay->getStatus() == 1){
				$title = strlen($messageDay->getTitle()) == 0 ? '' : '<div class="title">'.$messageDay->getTitle().'</div>';
				$text = $messageDay->getText();
				$positions[ $arrayWidgetPosition[1]->getPosition() ] = <<<HTML
					<div class="default">
						$title
						$text
					</div>
HTML;
			}
		
		// EMAIL COLETOR
			if(is_object($emailWidget) && $emailWidget->getStatus() == 1){
				$label = strlen($emailWidget->getLabel()) == 0 ? '' : '<div class="title">'.$emailWidget->getLabel().'</div>';
				$positions[ $arrayWidgetPosition[2]->getPosition() ] = <<<HTML
					<form id="form-email" class="default">
						$label
						<input type="text" id="fe-email" placeholder="Email" />
						<a href="#" id="fe-submit" title="Registrar email">
							Registrar
						</a>
						<div class="cl"></div>
					</form>
HTML;
			}
		
		// BANNER
			if(is_object($bannerSide) && $bannerSide->getStatus() == 1 && strlen($bannerSide->getImage()->getRealName()) > 0){
				$img = __PATH_FOR_LONG_URL__.'img/banner/300/'.$bannerSide->getImage()->getRealName();
				$url = $bannerSide->getUrl();
				$positions[ $arrayWidgetPosition[3]->getPosition() ] = <<<HTML
					<a href="$url" class="banner" target="_blank">
						<img src="$img" width="300" />
					</a>
HTML;
			}
			
		// VIDEO EMBED
			if(is_object($videoEmbed) && $videoEmbed->getStatus() == 1){
				$iframe = $videoEmbed->getText();
				$positions[ $arrayWidgetPosition[4]->getPosition() ] = <<<HTML
					<div class="default">
						<div class="title">Vìdeo em destaque</div>
						$iframe
						<!-- PEGAR PRIMEIRO FRAME DE VIDEO NO YOUTUBE http://img.youtube.com/vi/dCDLiWviOO8/0.jpg -->
					</div>
HTML;
			}
		
		// MENU SIDE
			$urlCells = __PATH_FOR_LONG_URL__.'celulas';
			$urlProjects = __PATH_FOR_LONG_URL__.'projetos';
			$urlDownloads = __PATH_FOR_LONG_URL__.'downloads';
			$positions[ $arrayWidgetPosition[5]->getPosition() ] = <<<HTML
				<a href="$urlCells" class="radio downloads $arraySelect[1]" title="Células">
					<i class="fa fa-users"></i>
					Células
				</a>
				<a href="$urlProjects" class="radio downloads $arraySelect[2]" title="Projetos">
					<i class="fa fa-folder"></i>
					Projetos
				</a>
				<a href="$urlDownloads" class="radio downloads $arraySelect[3]" title="Downloads">
					<i class="fa fa-cloud-download"></i>
					Downloads
				</a>
HTML;
		
		// FACEBOOK PLUGIN
			if(is_object($facebook) && $facebook->getStatus() == 1){
				$title = strlen($facebook->getTitle()) == 0 ? '' : '<div class="title">'.$facebook->getTitle().'</div>';
				$code = $facebook->getText();
				$positions[ $arrayWidgetPosition[6]->getPosition() ] = <<<HTML
					<div class="default">
						$title
						$code
					</div>
HTML;
			}
		
		// TWITTER PLUGIN
			if(is_object($twitter) && $twitter->getStatus() == 1){
				$title = strlen($twitter->getTitle()) == 0 ? '' : '<div class="title">'.$twitter->getTitle().'</div>';
				$code = $twitter->getText();
				$positions[ $arrayWidgetPosition[7]->getPosition() ] = <<<HTML
					<div class="default">
						$title
						$code
					</div>
HTML;
			}
		
		// YOUTUBE PLUGIN
			if(is_object($youtube) && $youtube->getStatus() == 1){
				$title = strlen($youtube->getTitle()) == 0 ? '' : '<div class="title">'.$youtube->getTitle().'</div>';
				$code = $youtube->getText();
				$positions[ $arrayWidgetPosition[8]->getPosition() ] = <<<HTML
					<div class="default">
						$title
						$code
					</div>
HTML;
			}
		
		// SPONSORS
			if(count($arraySponsor) > 0){
				$html_Sponsors = '';
				for($i = 0, $tam = count($arraySponsor); $i < $tam; $i++){
					$name = $arraySponsor[$i]->getName();
					$url = $arraySponsor[$i]->getUrl();
					$img = __PATH_FOR_LONG_URL__.'img/sponsor/240-1000/'.$arraySponsor[$i]->getImage()->getRealName();
					
					$html_Sponsors .= <<<HTML
						<a href="$url" target="_blank" title="$name">
							<img src="$img" width="240" />
						</a>
HTML;
				}
				$positions[ $arrayWidgetPosition[9]->getPosition() ] = <<<HTML
					<div class="default">
						<div class="title">Patrocinadores</div>
						$html_Sponsors
					</div>
HTML;
			}
?>
<div class="right">
	<form id="form-search" class="default" method="get" action="<?php echo __PATH_FOR_LONG_URL__; ?>busca">
		<input type="text" name="q" id="fs-search" value="<?php echo $_GET['search-text']; ?>" placeholder="Pesquisa" />
		<button type="submit" id="fs-submit" title="Pesquisar">
			<i class="fa fa-search"></i>
		</button>
		<div class="cl"></div>
	</form>
	
	
	<?php
		for($i = 0, $tam = count($positions); $i < $tam; $i++){
			echo $positions[$i];
		}
	?>
	
</div>