<?php
	$tam = count($arrayProject);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_PROJECT__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-project" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	// PROJECT TO UPDATE
		$html_Project = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayProject[$i]->getId();
			$name = $arrayProject[$i]->getName();
			$time = date('d\/m\/Y \à\s H\hi', $arrayProject[$i]->getTime());
			$statusIcon = $arrayProject[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
			$user = is_object($arrayProject[$i]->getUser()) ? $arrayProject[$i]->getUser()->getName() : 'Criador indefinido';
			
			$html_Project .= <<<HTML
				<li id="pr-$id">
					<div class="info">
						<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
						$statusIcon
						<div class="cl"></div>
						$name
					</div>
					<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-project|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
					<div class="cl"></div>
				</li>
HTML;
		}
		
	if(empty($html_Project)){
		$html_Project = <<<HTML
			<li>
				<i class="fa fa-warning"></i>
				Nenhum projeto encontrado.
			</li>
HTML;
	}
?>