<?php
	// CSS HACK PARA IE
	if((stripos($_SERVER["HTTP_USER_AGENT"], 'Windows') || stripos($_SERVER["HTTP_USER_AGENT"], 'MSIE ')) && stripos($_SERVER["HTTP_USER_AGENT"], 'Firefox') === false){// || strpos($_SERVER["HTTP_USER_AGENT"], 'Opera')) // caso o navegador seja um Internet Explorer adicion-se uma pÃ¡gina CSS hack para esse
		$cssHack = '<link type="text/css" rel="stylesheet" charset="utf-8" media="all" href="'.__PATH_FOR_LONG_URL__.'css/vuup-ie.css" />';
	}
	// CSS HACK PARA CHROME
	if(stripos($_SERVER["HTTP_USER_AGENT"], 'Chrome'))
		$cssHack = '<link type="text/css" rel="stylesheet" charset="utf-8" media="all" href="'.__PATH_FOR_LONG_URL__.'css/vuup-chrome.css" />';
?>
<link type="image/gif" rel="icon" href="<?php echo __PATH_FOR_LONG_URL__; ?>img/system/favicon/vuup-favicon.gif" />
<link type="image/vnd.microsoft.icon" rel="shortcut icon" href="<?php echo __PATH_FOR_LONG_URL__; ?>img/system/logo/favicon/vuup-favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo __PATH_FOR_LONG_URL__; ?>img/system/logo/favicon/vuup-favicon.png" />
<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>js/gallery-image/galery_image.css" media="all" />
<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/datepicker.css" media="all" />
<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/font/awesome/css/font-awesome.min.css" media="all" />
<link type="text/css" rel="stylesheet" href="<?php echo __PATH_FOR_LONG_URL__; ?>css/vuup.css" media="all" />
<?php
	echo $cssHack;
?>