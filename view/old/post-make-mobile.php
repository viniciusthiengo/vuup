<?php
	$tam = count($arrayPost);
	$html_Post = '';

	for($i = 0; $i < $tam; $i++){
		$html_Post .= $arrayPost[$i]->getId();
		$html_Post .= '-SPDATA-';
		//$html_Post .= 'http://localhost/vinicius/mibec/'.$arrayPost[$i]->getUrl();
		$html_Post .= 'http://www.mibec.com.br/'.$arrayPost[$i]->getUrl().__COMP_URL_MOBILE__;
		$html_Post .= '-SPDATA-';
		$html_Post .= $arrayPost[$i]->getTitle();
		$html_Post .= '-SPDATA-';
		$html_Post .= 'http://www.mibec.com.br/img/post/100-100/'.$arrayPost[$i]->getImage()->getRealName();
		$html_Post .= '-SPDATA-';
		$html_Post .= $arrayPost[$i]->getQtdComment();
		$html_Post .= '-SPDATA-';
		$html_Post .= $arrayPost[$i]->getStatusComment();
		$html_Post .= '-SPDATA-';
		$html_Post .= $arrayPost[$i]->getQtdView();
		$html_Post .= '-SPDATA-';
		$html_Post .= $arrayPost[$i]->getUser()->getName();
		$html_Post .= '-SPMAIN-';
	}
	$html_Post = preg_replace('/(-SPMAIN-){1}$/', '', $html_Post);
	echo $html_Post;
?>