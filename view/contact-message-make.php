<?php
	$html = '';
	
	if(preg_match('/^(vu-get-send-organizer-event-message-in-page){1}$/', $_POST['method'])){
		if($return == 1){
			$userToName = $contactMessage->getUserTo()->getName();
			$userFromName = $contactMessage->getUserFrom()->getName();
			$html = <<<HTML
				<div class="modal-main-content br-3">
					<h2>
						<i class="fa fa-envelope"></i>
						Mensagem de contato enviada
						<a href="#" title="Fechar" class="link-close">
							<i class="fa fa-times-circle"></i>
						</a>
					</h2>
					<div class="wrap-content">
						<div class="login-box">
							<br />
							<br />
							Olá <b>$userFromName</b>,
							<br />
							Sua mensagem de contato foi enviada com sucesso ao email de <b>$userToName</b>.
							<br />
							Agora é somente aguardar a resposta.
							<br />
							<br />
							<br />
						</div>
					</div>
				</div>
HTML;
		}
	}
	
	
	echo json_encode(array('feedback'=>$return, 'html'=>$html, 'error'=>(is_object($error) ? $error->getDataJSON() : '')));
?>