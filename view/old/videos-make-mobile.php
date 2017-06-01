<?php
	$tam = count($arrayGallery);
	$html_Gallery = '';
	
	for($i = 0; $i < $tam; $i++){
		$html_Gallery .= $arrayGallery[$i]->getId();
		$html_Gallery .= '-SPDATA-';
		$html_Gallery .= 'http://www.mibec.com.br/videos/'.$arrayGallery[$i]->getUrl().__COMP_URL_MOBILE__;
		$html_Gallery .= '-SPDATA-';
		$html_Gallery .= $arrayGallery[$i]->getTitle();
		$html_Gallery .= '-SPDATA-';
		$html_Gallery .= count($arrayGallery[$i]->getArrayGalleryElement());
		$html_Gallery .= '-SPDATA-';
		$html_Gallery .= $arrayGallery[$i]->getQtdComment();
		$html_Gallery .= '-SPDATA-';
		$html_Gallery .= $arrayGallery[$i]->getStatusComment();
		$html_Gallery .= '-SPMAIN-';
	}
	$html_Gallery = preg_replace('/(-SPMAIN-){1}$/', '', $html_Gallery);
	echo $html_Gallery;
?>