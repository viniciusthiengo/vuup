<?php
	$tam = count($arrayDownload);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_DOWNLOAD__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-download" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	// DOWNLOAD TO UPDATE
		$html_Download = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayDownload[$i]->getId();
			$name = $arrayDownload[$i]->getName();
			$time = date('d\/m\/Y \à\s H\hi', $arrayDownload[$i]->getTime());
			$statusIcon = $arrayDownload[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
			$user = is_object($arrayDownload[$i]->getUser()) ? $arrayDownload[$i]->getUser()->getName() : 'Criador indefinido';
			
			$html_Download .= <<<HTML
				<li id="dw-$id">
					<div class="info">
						<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
						$statusIcon
						<div class="cl"></div>
						$name
					</div>
					<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-download|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
					<div class="cl"></div>
				</li>
HTML;
		}
	
	if(empty($html_Download)){
		$html_Download = <<<HTML
			<li>
				<i class="fa fa-warning"></i>
				Nenhum arquivo para download encontrado.
			</li>
HTML;
	}
?>