<?php
	$tam = count($arrayPost);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_POST__){
			$tam--;
			$html_LoadMore = '<a href="package/ctrl/CtrlPost.php|load-more-post" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	$html_Post = '';
	for($i = 0; $i < $tam; $i++){
		$id = $arrayPost[$i]->getId();
		$title = $arrayPost[$i]->getTitle();
		$time = date('d\/m\/Y \à\s H\hi', $arrayPost[$i]->getTime());
		$image = 'img/post/50-50/'.$arrayPost[$i]->getImage()->getRealName();
		$statusIcon = $arrayPost[$i]->getStatus() == 1 ? '' : '<i class="fa fa-ban inactive"></i>';
		$user = is_object($arrayPost[$i]->getUser()) ? $arrayPost[$i]->getUser()->getName() : 'Criador indefinido';
		
		$html_Post .= <<<HTML
			<li id="pt-$id">
				<img src="$image" width="50" height="50" />
				<div class="info">
					<div class="time border-radius"><i class="fa fa-clock-o"></i> $time - <i class="fa fa-user"></i> $user</div>
					$statusIcon
					<div class="cl"></div>
					$title
				</div>
				<a href="package/ctrl/CtrlPost.php|get-form-update-one-post|$id" class="edit-post-bt inner-link border-radius" title="Editar">Editar</a>
				<div class="cl"></div>
			</li>
HTML;
	}
	
	if(empty($html_Post)){
		$html_Post = <<<HTML
			<li>
				<i class="fa fa-warning"></i>
				Nenhum post encontrado.
			</li>
HTML;
	}
?>