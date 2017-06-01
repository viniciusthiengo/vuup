<?php
	$ownerUserName = $ticket->getUser()->getName();
	$ownerUserUrl = __PATH_FULL_PREFIX__.$ticket->getUser()->getUrlSufix();
	
	$userRepassName = $name = $userRepass->getName();
	$email = $userRepass->getEmail();
	
	$eventName = $ticket->getEvent()->getName();
	$eventUrl = $ticket->getEvent()->getFullUrl();
	
	$paymentTime = date('d\/m\/Y \à\s H\hi', $ticket->getPayment()->getTime());
	
	$ticketDayLabel = $ticket->getTicketValidDaysHumanFormat().' a partir:';
	$ticketDayDay = $ticket->getTicketDay()->getDayPage(false).', '.$ticket->getTicketDay()->getDaySeccondsToBrazilDate();
	$ticketDayTime = $ticket->getTicketDay()->getTimeSeccondsToBrazilDate();
	
	$ticketPaymentIdAsCode = $ticket->getIdTicketPaymentAsCode();
	$ticketName = $ticket->getName();
	$ticketPrice = $ticket->getEvent()->getTicketTypeCharge() == 1 ? '' : '(R$ '.$ticket->getPriceHumanFormated($ticket->getEvent()->getTicketTypeTaxes(), false, false, true).')';
	$ticketQRCodeImg = $ticket->getQRCodeImg();
	
	$subject = $ownerUserName.' enviou um ingresso a você - vuup';
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
						Olá $userRepassName, <a href="$ownerUserUrl" title="$ownerUserName">$ownerUserName</a> enviou para você um ingresso para o evento <a href="$eventUrl" title="$eventName">$eventName</a>
						<br /><br />
						
						<div style="padding: 5px; border: 1px solid #ddd; border-radius: 3px;">
							<div style="float: left;">
								<b>Info ingresso:</b>
								<div style="margin-left: 10px;">
									<div>
										Código: <b>$ticketPaymentIdAsCode</b>
									</div>
									<div>
										Comprado em: $paymentTime
									</div>
									<div>
										$ticketDayLabel $ticketDayDay   
										às
										$ticketDayTime
									</div>
									<div class="normal-info">
										$ticketName $ticketPrice
									</div>
								</div>
							</div>
							<img src="$ticketQRCodeImg" style="float: right; display: block;" width="90" height="90" />
							<div class="clear: both;"></div>
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