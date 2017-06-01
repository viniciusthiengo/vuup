<?php
	$name = $payment->getUser()->getName();
	$email = $payment->getUser()->getEmail();
	
	$eventName = $payment->getEvent()->getName();
	$eventUrl = $payment->getEvent()->getFullUrl();
	
	$billUrl = $payment->getPaymentIugu()->getUrl();
	$billPdf = $payment->getPaymentIugu()->getPdf();
	
	$subject = 'Link da fatura de compra - vuup';
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
						Olá $name,
						<br />
						Seguem links de acesso a fatura de sua compra no vuup.com.br para o evento
						<a href="$eventUrl" title="$eventName">$eventName</a>
						<br /><br />
						<div>
							Página: $billUrl
							<br /><br />
							PDF: $billPdf
						</div>
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