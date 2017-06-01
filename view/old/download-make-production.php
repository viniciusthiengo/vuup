<?php
	$tam = count($arrayDownload);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_DOWNLOAD__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-download-production" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	$html_Download = '';
	for($i = 0; $i < $tam; $i++){
		$id = $arrayDownload[$i]->getId();
		$name = $arrayDownload[$i]->getName();
		$description = $arrayDownload[$i]->getDescription();
		$url = __PATH_FOR_LONG_URL__.'file/'.$arrayDownload[$i]->getFile()->getName();
		
		$html_Download .= <<<HTML
			<div id="dw-$id" class="download-box">
				$description
				<a href="$url" class="border-radius" title="$name">
					<i class="fa fa-cloud-download"></i>
					$name
				</a>
			</div>
HTML;
	}
	
	if(empty($html_Download)){
		$html_Download = <<<HTML
			<div>
				<br /><br />
				Nenhum arquivo para download disponível.
			</div>
HTML;
	}
?>