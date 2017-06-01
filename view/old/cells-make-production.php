<?php
	$tam = count($arrayCell);
	$html_LoadMore = '';
	
	// LOAD MORE BUTTON
		if($tam == __LIMIT_CELL__){
			$tam--;
			$html_LoadMore = '<div class="cl"></div><a href="package/ctrl/CtrlAdmin.php|load-more-cell-production" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
		}
	
	$html_Cell = '';
	for($i = 0; $i < $tam; $i++){
		$id = $arrayCell[$i]->getId();
		$name = $arrayCell[$i]->getName();
		$url = __PATH_FOR_LONG_URL__.'celulas/'.$arrayCell[$i]->getUrl();
		
		// MEMBERS
			$html_Media = '';
			$arrayCellMember = $arrayCell[$i]->getArrayCellMember();
			for($j = 0; $j < 4; $j++){
				
				if(is_object($arrayCellMember[$j])){
					$img = $arrayCellMember[$j]->getImage()->getRealName();
					$html_Media .= '<img src="'.__PATH_FOR_LONG_URL__.'img/cell/80-80/'.$img.'" width="80" height="80" />';
				}
				else{
					$html_Media .= '<img src="" width="80" height="80" />';
				}
				$html_Media .= $j % 2 == 1 ? '<div class="cl"></div>' : '';
			}
		
		$html_Cell .= $i % 3 == 0 ? '<div class="cl"></div>' : '';
		
		$html_Cell .= <<<HTML
			<div id="ph-$id" class="photos-box">
				$html_Media
				<a href="$url" class="mask">
					<i class="fa fa-users"></i><br />
					$name
				</a>
			</div>
HTML;
	}
		
	if(empty($html_Cell)){
		$html_Cell = <<<HTML
			<div>
				<br /><br />
				Nenhuma célula ainda criada.
			</div>
HTML;
	}
?>