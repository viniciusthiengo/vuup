<?php
	$tam = count($arrayGallery);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_GALLERY__){
			$tam--;
			$html_LoadMore = '<div class="cl"></div><a href="package/ctrl/CtrlAdmin.php|'.$arrayGallery[0]->getMethodLoadMore(true).'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	// GALLERY TO UPDATE
		$html_Gallery = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayGallery[$i]->getId();
			$title = $arrayGallery[$i]->getTitle();
			$url = __PATH_FOR_LONG_URL__.'fotos/'.$arrayGallery[$i]->getUrl();
			
			// PHOTOS
				$html_Media = '';
				$arrayGalleryElement = $arrayGallery[$i]->getArrayGalleryElement();
				for($j = 0; $j < 4; $j++){
					
					if(is_object($arrayGalleryElement[$j])){
						$img = $arrayGalleryElement[$j]->getImage()->getRealName();
						$html_Media .= '<img src="'.__PATH_FOR_LONG_URL__.'img/gallery/80-80/'.$img.'" width="80" height="80" />';
					}
					else{
						$html_Media .= '<img src="" width="80" height="80" />';
					}
					$html_Media .= $j % 2 == 1 ? '<div class="cl"></div>' : '';
				}
			
			$html_Gallery .= $i % 3 == 0 ? '<div class="cl"></div>' : '';
			
			$html_Gallery .= <<<HTML
				<div id="ph-$id" class="photos-box">
					$html_Media
					<a href="$url" class="mask">
						<i class="fa fa-camera"></i><br />
						$title
					</a>
				</div>
HTML;
		}
		
	if(empty($html_Gallery)){
		$html_Gallery = <<<HTML
			<div>
				<br /><br />
				Nenhuma foto disponível.
			</div>
HTML;
	}
?>