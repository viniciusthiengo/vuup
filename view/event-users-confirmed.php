<?php
	$html = '';
	
	for($i = 0, $tamI = count($arrayObj); $i < $tamI; $i++){
		$name = $arrayObj[$i]->getName();
		$url = __PATH_FULL_PREFIX__.$arrayObj[$i]->getUrlSufix();
		$img = $arrayObj[$i]->getImageUrl(__PATH_FULL_PREFIX__.'img/user/52-52/');
		
		$html .= <<<HTML
			<a href="$url" title="$name" target="_blank">
				<img src="$img" width="52" height="52" />
			</a>
HTML;
	}
	
	$html = <<<HTML
		<div class="modal-main-content br-3">
			<h2>
				<i class="fa fa-users"></i>
				Já confirmaram
				<a href="#" title="Fechar" class="link-close">
					<i class="fa fa-times-circle"></i>
				</a>
			</h2>
			<div class="wrap-content">
				<div class="user-confirm-box">
					$html
					<div class="cl"></div>
				</div>
			</div>
		</div>
HTML;
?>