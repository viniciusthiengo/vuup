<?php
	$page = $_SERVER['SCRIPT_URI'];
	$year = date('Y');
	
	$html_metaTag = <<<HTML
		<meta charset="utf-8" />
		<meta name="viewport" content="width-device-width, initial-scale=1.0" />
		<meta name="DC.Identifier" content="$page">
		<meta name="rating" content="general" />
		<meta name="copyright" content="&copy; $year Vuup" />
		<meta name="DC.publisher" content="Vuup Developer Team" />
		<meta name="author" content="Vuup Developer Team" />
		<meta name="Custodian" content="Vuup" />
		<meta name="robots" content="all" />
HTML;

	if(strcasecmp('administrador', $_GET['page']) == 0){
		$html_metaTag .= <<<HTML
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
HTML;
	}
	echo $html_metaTag;
?>