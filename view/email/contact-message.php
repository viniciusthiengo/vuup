<?php
	$email = $contactMessage->getUserTo()->getEmail();
	$userToName = $name = $contactMessage->getUserTo()->getName();
	
	$message = $contactMessage->getMessage();
	
	$userFromName = $contactMessage->getUserFrom()->getName();
	$userFromEmail = $contactMessage->getUserFrom()->getEmail();
	$userFromUrl = '';
	if($contactMessage->getUserFrom()->getId() > 0){
		$userFromUrl = __PATH_FULL_PREFIX__.$contactMessage->getUserFrom()->getUrlSufix();
		$userFromUrl = '<div>Página de '.$contactMessage->getUserFrom()->getName().': <a href="'.$userFromUrl.'" title="$userFromnName">'.$userFromUrl.'</a></div>';
	}
	
	$eventUrl = '';
	if(!is_array($contactMessage->getEvent()) && is_object($contactMessage->getEvent()) && $contactMessage->getEvent()->getId() > 0){
		$eventUrl = '<div>Evento: <a href="'.$contactMessage->getEvent()->getFullUrl().'" title="'.$contactMessage->getEvent()->getName().'">'.$contactMessage->getEvent()->getName().'</a></div>';
	}
	
	$urlsHtml = '';
	if(!empty($userFromUrl) || !empty($eventUrl)){
		$urlsHtml = <<<HTML
			<br /><br />
			<div style="padding: 8px; border-radius: 3px; background: #ffffcc; border: 1px solid #ffcc99;">
				$eventUrl
				$userFromUrl
			</div>
HTML;
	}
	
	$subject = 'Mensagem de contato - vuup';
	
	$body = <<<HTML
		<html>
			<body>
				<div style="font-family: Arial, sans-serif; font-size: 13px; line-height: 22px; color: #000000; width: 550px;">
					<div style="padding: 10px; color: #ffffff;">
						<a href="http://www.vuup.com.br" title="vuup">
							<img src="http://www.vuup.com.br/img/system/logo/vuup-140x40.png" alt="vuup logo" width="140" height="40" />
						</a>
					</div>
					
					<div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
						Olá $userToName, nova mensagem de contato de <b>$userFromName</b> ($userFromEmail)
						
						$urlsHtml
						<br />
						
						<b>$message</b>
						<br /><br />
					</div>
					--
					<br />
					<a href="http://www.vuup.com.br" title="Vuup Events">vuup.com.br</a>
					<br />
					Brasil
				</div>
			</body>
		</html>
HTML;
?>