<?php
	$arrayGalleryElement = $gallery->getArrayGalleryElement();
	$tam = count($arrayGalleryElement);
	$html_GalleryElement = '';
	
	for($i = 0; $i < $tam; $i++){
		$indice = $i + 1;
		$title = $arrayGalleryElement[$i]->getTitle();
		$text = $arrayGalleryElement[$i]->getText();
		$image = $arrayGalleryElement[$i]->getImage()->getRealName();
		//$position = $arrayGalleryElement[$i]->getPosition().'º';
		$position = ($i + 1).'º';
		
		if($gallery->getType() == 1){
			$text = htmlentities($text);
			$html_GalleryElement .= <<<HTML
				<li class="embed">
					<div class="direction"><i class="fa fa-arrows-v"></i></div>
					<i class="fa fa-video-camera icon-video"></i>
					<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
					<input type="text" id="fca-embed-p-$indice" value="$text" placeholder="*Embed code </>" />
					<div class="position border-radius"> $position</div>
					<div class="cl"></div>
				</li>
HTML;
		}
		else{
			$html_GalleryElement .= <<<HTML
				<li class="embed box-main-img">
					<form action="package/ctrl/CtrlFile.php">
						<div class="direction"><i class="fa fa-arrows-v"></i></div>
						<img src="img/gallery/100-100/$image" width="100" height="100" />
						<div href="#" title="Remover" class="remove border-radius" style="display: block;">
							<i class="fa fa-trash-o"></i>
						</div>
						<div class="info-photo">
							<input type="text" id="fca-title-photo-p-1" value="$title" placeholder="Título" />
							<textarea type="text" id="fca-desc-photo-p-1" placeholder="Descrição">$text</textarea>
						</div>
						<div class="info-photo-util">
							<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
							<div class="cl"></div>
							<div class="position border-radius"> $position</div>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
						<div class="proxy">
							Carregando foto...
						</div>
						<input type="file" class="input-file" name="fca-main-img" id="fca-main-img-1" />
						<a href="#" title="Carregar" class="load-img">
							<i class="fa fa-cloud-upload"></i>
							Carregar foto
						</a>
						<input type="hidden" name="method" id="fca-method" value="" />
						<div class="cl"></div>
					</form>
				</li>
HTML;
		}
	}
	echo $html_GalleryElement;
?>