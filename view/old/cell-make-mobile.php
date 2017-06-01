<?php
	$tam = count($arrayCell);
	$html_Cell = '';
	
	for($i = 0; $i < $tam; $i++){
		$html_Cell .= $arrayCell[$i]->getId();
		$html_Cell .= '-SPDATA-';
		$html_Cell .= 'http://www.mibec.com.br/celulas/'.$arrayCell[$i]->getUrl().__COMP_URL_MOBILE__;
		$html_Cell .= '-SPDATA-';
		$html_Cell .= $arrayCell[$i]->getName();
		$html_Cell .= '-SPDATA-';
		$html_Cell .= count($arrayCell[$i]->getArrayCellMember());
		$html_Cell .= '-SPDATA-';
		$html_Cell .= $arrayCell[$i]->getQtdComment();
		$html_Cell .= '-SPDATA-';
		$html_Cell .= $arrayCell[$i]->getStatusComment();
		$html_Cell .= '-SPDATA-';
		
		// PHOTOS
			$arrayCellMember = $arrayCell[$i]->getArrayCellMember();
			for($j = 0; $j < 4; $j++){
				if(is_object($arrayCellMember[$j])){
					$img = $arrayCellMember[$j]->getImage()->getRealName();
					$html_Cell .= 'http://www.mibec.com.br/img/cell/100-100/'.$img;
					$html_Cell .= '-SPSUBDATA-';
				}
				else{
					$html_Cell .= '-SPSUBDATA-';
				}
			}
		$html_Cell = preg_replace('/(-SPSUBDATA-){1}$/', '', $html_Cell);
		$html_Cell .= '-SPMAIN-';
	}
	$html_Cell = preg_replace('/(-SPMAIN-){1}$/', '', $html_Cell);
	echo $html_Cell;
?>