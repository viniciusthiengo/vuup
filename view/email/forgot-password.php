<?php
	$name = $forgotPassword->getUser()->getName();
	$email = $forgotPassword->getUser()->getEmail();
	
	$forgotPasswordUrl = $forgotPassword->getFullUrl();
	
	$subject = 'Solicitação de recuperação de senha em vuup';
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
						Olá $name, segue link para alteração de senha em vuup.
						<br />
						<br /><br />
						<div style="text-align: center;">
							<a href="$forgotPasswordUrl" style="display: block; width: 150px; padding: 10px; margin: 0 auto; color: #fff; background: #f4190b; text-decoration: none;" title="Alterar senha">
								Alterar senha
							</a>
						</div>
						<br /><br />
						<em>Se você não foi o solicitante dessa redefinição de senha apenas ignore esse e-mail.</em>
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