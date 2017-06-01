<?php
	$tam = count($arrayGallery);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_GALLERY__){
			$tam--;
			$html_LoadMore = '<div class="cl"></div><a href="package/ctrl/CtrlAdmin.php|'.$arrayGallery[0]->getMethodLoadMore(true).'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
		$html_Gallery = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayGallery[$i]->getId();
			$title = $arrayGallery[$i]->getTitle();
			$url = __PATH_FOR_LONG_URL__.'videos/'.$arrayGallery[$i]->getUrl();
			
			$html_Gallery .= <<<HTML
				<div id="ph-$id" class="photos-box videos-box">
					<div class="aux-videos-box"></div>
					<div class="aux-videos-box"></div>
					<div class="cl"></div>
					<div class="aux-videos-box"></div>
					<div class="aux-videos-box"></div>
					<div class="cl"></div>
					
					<a href="$url" class="mask">
						<i class="fa fa-video-camera"></i><br />
						$title
					</a>
				</div>
HTML;
		}
		
	if(empty($html_Gallery)){
		$html_Gallery = <<<HTML
			<div>
				<br /><br />
				Nenhum vídeo disponível.
			</div>
HTML;
	}
?>