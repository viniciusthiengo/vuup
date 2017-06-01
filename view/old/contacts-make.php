<?php
	$tam = count($arrayContact);
	$html_Contacts = '';
	$html_LoadMore = '';
	
	if($tam == __LIMIT_CONTACT__){
		$tam--;
		$html_LoadMore = '<a href="package/ctrl/CtrlAdmin.php|load-more-contact" class="load-more" title="Carregar mais">Carregar mais</a> <div class="cl"></div>';
	}
	
	
	for($i = 0; $i < $tam; $i++){
		$id = $arrayContact[$i]->getId();
		$name = $arrayContact[$i]->getUser()->getName();
		$email = $arrayContact[$i]->getUser()->getEmail();
		$time = date('d\/m\/Y\/ \à\s H:i', $arrayContact[$i]->getTime());
		$subject = $arrayContact[$i]->getContactSubject()->getLabelItem();
		$message = $arrayContact[$i]->getMessage();
	
		$html_Contacts .= <<<HTML
			<div id="ct-$id" class="contact border-radius">
				<div class="title">
					<b>Usuário:</b>
					$name ($email)
					<div class="time border-radius">$time</div>
				</div>
				<div class="subject">
					<b>Assunto:</b>
					$subject
				</div>
				<br />
				$message
			</div>
HTML;
	}
?>