<?php
	$tam = count($arrayGallery);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_GALLERY__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|'.$arrayGallery[0]->getMethodLoadMore().'" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	// GALLERY TO UPDATE
		$html_Gallery = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayGallery[$i]->getId();
			$title = $arrayGallery[$i]->getTitle();
			$time = date('d\/m\/Y \à\s H\hi', $arrayGallery[$i]->getTime());
			
			$method = $arrayGallery[$i]->getMethod();
			$statusIcon = $arrayGallery[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
			$user = is_object($arrayGallery[$i]->getUser()) ? $arrayGallery[$i]->getUser()->getName() : 'Criador indefinido';
			
			$html_Gallery .= <<<HTML
				<li id="ga-$id">
					<div class="info">
						<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
						$statusIcon
						<div class="cl"></div>
						$title
					</div>
					<a href="package/ctrl/CtrlAdmin.php|$method|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
					<div class="cl"></div>
				</li>
HTML;
		}
		
	if(empty($html_Gallery)){
		$html_Gallery = <<<HTML
			<li>
				<i class="fa fa-warning"></i>
				Nenhuma galeria encontrada.
			</li>
HTML;
	}
?>