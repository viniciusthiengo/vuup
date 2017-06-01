<?php
	session_start();
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/apl/AplFile.php');
	
	
	$apl = new AplFile();
	
	/*$f = fopen('ARQUIVO.txt', 'w');
	fwrite($f, $_POST['method']."\r\n");
	fwrite($f, $_FILES['fct-img']['tmp_name']."\r\n");
	fwrite($f, $_FILES['fct-img']['type']."\r\n");
	fwrite($f, $_FILES['fct-img']['size']."\r\n");
	fclose($f);*/
	
	if(strcasecmp($_POST['method'], 'set-tmp-main-img') == 0){
		$image = new Image();
		$image->setName($_FILES['fct-img']['tmp_name']);
		$image->setCorrectType($_FILES['fct-img']['type']);
		$image->setSize($_FILES['fct-img']['size']);
		$image->setTime(time());
		$return = $apl->setTmpMainImg($image);
		echo $return;
	}
	
	
	else if(strcasecmp($_POST['method'], 'set-tmp-doc-file') == 0){
		$file = new File();
		$file->setName($_FILES['fct-doc-file']['tmp_name']);
		$file->setCorrectType($_FILES['fct-doc-file']['name']);
		$file->setSize($_FILES['fct-doc-file']['size']);
		$file->setTime(time());
		$return = $apl->setTmpFileDownload($file);
		echo $return;
	}
	
	
	/*else if(strcasecmp($_POST['method'], 'set-tmp-main-img-search') == 0){
		$file = new File();
		$file->setName($_FILES['fct-img-search']['tmp_name']);
		$file->setCorrectType($_FILES['fct-img-search']['name']);
		$file->setSize($_FILES['fct-img-search']['size']);
		$file->setTime(time());
		$return = $apl->setTmpFileDownload($file);
		echo $return.'|'.$_FILES['fct-img-search']['name'];
	}*/
	
	
	/*else if(strcasecmp($_POST['method'], 'set-img-content') == 0){
		$file = new File();
		$file->setName($_FILES['fca-img-hack']['tmp_name']);
		$file->setCorrectType($_FILES['fca-img-hack']['name']);
		$file->setSize($_FILES['fca-img-hack']['size']);
		$file->setTime(time());
		$return = $apl->setTmpFileDownload($file, 'img/post/normal/');
		echo $return;
	}*/
?>