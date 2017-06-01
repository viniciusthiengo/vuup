<?php
	$tam = count($arrayProject);
	$html_LoadMore = '';
	$html_Project = '';
	
	// LOAD MORE
		if($tam == __LIMIT_PROJECT__){
			$tam--;
			$html_LoadMore = '<a class="load-more" title="Carregar mais" href="package/ctrl/CtrlAdmin.php|load-more-project-production">Carregar mais</a>';
		}
	
	for($i = 0; $i < $tam; $i++){
		$id = $arrayProject[$i]->getId();
		$name = $arrayProject[$i]->getName();
		$url = __PATH_FOR_LONG_URL__.'projetos/'.$arrayProject[$i]->getUrl();
		$description = $arrayProject[$i]->getDescription();
		
		$html_Project .= <<<HTML
			<div id="pr-$id" class="project">
				<h2>
					<i class="fa fa-folder"></i> $name
					<a href="$url" class="border-radius" title="Acessar projeto">
						Acessar projeto
						<i class="fa fa-chevron-right"></i>
					</a>
					<div class="cl"></div>
				</h2>
				<p>
					$description
				</p>
			</div>
HTML;
	}
	
	if(empty($html_Download)){
		$html_Download = <<<HTML
			<div>
				Nenhum projeto criado.
			</div>
HTML;
	}
?>