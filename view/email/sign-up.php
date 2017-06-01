<?php
	$email = $user->getEmail();
	$hash = $user->makeHashEmail();
	$urlConfirm = __PATH_FULL_PREFIX__.'confirmar/'.$hash;
	
	$subject = 'Confirmação de cadastro vuup';
	
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
					Olá <b>$name</b>
					<br /><br />
					
					Para confirmar o cadastro em vuup.com.br e liberar o acesso clique no link a seguir ou copie e cole na barra de navegação
					de seu navegador:
					<br /><br />
					
					<a href="$urlConfirm" title="Confirmar minha inscrição">
						$urlConfirm
					</a>
					<br /><br />
					
					Se não foi você o solicitante do cadastro apenas ignore esse email, pois sem a confirmação o acesso não é permitido.
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