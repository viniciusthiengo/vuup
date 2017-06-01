<?php
	$tam = count($arrayProject);
	$html_Project = '';

	for($i = 0; $i < $tam; $i++){
		$html_Project .= $arrayProject[$i]->getId();
		$html_Project .= '-SPDATA-';
		$html_Project .= 'http://www.mibec.com.br/projetos/'.$arrayProject[$i]->getUrl().__COMP_URL_MOBILE__;
		$html_Project .= '-SPDATA-';
		$html_Project .= $arrayProject[$i]->getName();
		$html_Project .= '-SPDATA-';
		$html_Project .= $arrayProject[$i]->getDescription();
		$html_Project .= '-SPDATA-';
		$html_Project .= $arrayProject[$i]->getQtdComment();
		$html_Project .= '-SPDATA-';
		$html_Project .= $arrayProject[$i]->getStatusComment();
		$html_Project .= '-SPMAIN-';
	}
	$html_Project = preg_replace('/(-SPMAIN-){1}$/', '', $html_Project);
	echo $html_Project;
?>