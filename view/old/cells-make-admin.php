<?php
	$tam = count($arrayCell);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_CELL__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-cell" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	// CELL TO UPDATE
		$html_Cell = '';
		for($i = 0; $i < $tam; $i++){
			$id = $arrayCell[$i]->getId();
			$name = $arrayCell[$i]->getName();
			$time = date('d\/m\/Y \à\s H\hi', $arrayCell[$i]->getTime());
			$statusIcon = $arrayCell[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
			$user = is_object($arrayCell[$i]->getUser()) ? $arrayCell[$i]->getUser()->getName() : 'Criador indefinido';
			
			$html_Cell .= <<<HTML
				<li id="ce-$id">
					<div class="info">
						<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
						$statusIcon
						<div class="cl"></div>
						$name
					</div>
					<a href="package/ctrl/CtrlAdmin.php|get-form-update-one-cell|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
					<div class="cl"></div>
				</li>
HTML;
		}
		
	if(empty($html_Cell)){
		$html_Cell = <<<HTML
			<li>
				<i class="fa fa-warning"></i>
				Nenhuma célula encontrada.
			</li>
HTML;
	}
?>