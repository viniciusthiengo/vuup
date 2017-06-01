<?php
	$user = $payment->getUser();
	$userName = $user->getName();
	$userImgUrl = $user->getImageUrl(__PATH_FULL_PREFIX__.'img/user/50-50/');
	$userUrl = __PATH_FULL_PREFIX__.$user->getUrlSufix();
	
	$event = $payment->getEvent();
	$eventName = $event->getName();
	$eventUrl = $event->getFullUrl();
	
	$ownerUser = $event->getUser();
	$email = $ownerUser->getEmail();
	$name = $ownerUser->getName();
	
	
	// HEAD TITLE
		if($event->getTicketTypeCharge() == 2){
			$headTitle = 'Olá '.$name.', mais uma venda para o evento <a href="'.$eventUrl.'" title="'.$eventName.'">'.$eventName.'</a>';
		}
		else{
			$headTitle = 'Olá '.$name.', mais ingressos adquiridos para o evento <a href="'.$eventUrl.'" title="'.$eventName.'">'.$eventName.'</a>';
		}
	
	// TICKETS
		$html_Tickets = '';
		$arrayTicketsDay = $event->getTicketsDayArray();
		for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
			$arrayTicket = $arrayTicketsDay[$i]->getTicketArray();
			
			for($j = 0, $tamJ = count($arrayTicket); $j < $tamJ; $j++){
				$html_Tickets .= $arrayTicket[$j]->getName();
				$html_Tickets .= ' ('.$arrayTicketsDay[$i]->getDayPage();
				$html_Tickets .= ' às '.$arrayTicketsDay[$i]->getTimeSeccondsToBrazilDate().')';
				$html_Tickets .= ': '.$arrayTicket[$j]->getQtdMax()->getItem();
				$html_Tickets .= $arrayTicket[$j]->getQtdMax()->getItem() == 1 ? ' ingresso' : ' ingressos';
				
				if($event->getTicketTypeCharge() == 2){
					$html_Tickets .= ' ('.$arrayTicket[$j]->getPriceHumanFormated(0, true);
					$html_Tickets .= $event->getTicketTypeTaxes() == 1 ? ' + '.$arrayTicket[$j]->getTaxHumanFormat().' (taxa vuup acrescentada) = '.$arrayTicket[$j]->getPriceHumanFormated(1, true).')' : ' - '.$arrayTicket[$j]->getTaxHumanFormat().' (taxa vuup incorporada) = '.$arrayTicket[$j]->getPriceHumanFormated(2, true, true).')';
				}
				$html_Tickets .= ($i < $tamI-1) || ($j < $tamJ-1) ? '<br />' : '';
			}
		}
		
	// PARCELS
		$html_Parcels = '';
		if($event->getTicketTypeCharge() == 2 && $payment->getParcels()->getItem() > 0){
			$html_Parcels .= '<div style="margin: 5px 0px; height: 1px; background: #ddd;"></div>';
			$html_Parcels .= 'Parcelado em '.$payment->getParcels()->getPosItem(0).'x';
			/*$html_Parcels .= 'Parcelado em '.$payment->getParcels()->getPosItem(0).'x (+ '.$payment->getParcels()->getPosItem(3).'% de taxa no valor total';
			//$html_Parcels .= $event->getTicketTypeTaxes() == 1 ? ' (+ '.$payment->getParcels()->getPosItem(2).'% no valor total sem taxas)' : '';
			$html_Parcels .= $event->getTicketTypeTaxes() == 1 ? ' sem taxas)' : ')';*/
		}
		
	// TOTAL
		$html_Total = '';
		if($event->getTicketTypeCharge() == 2){
			 // WITH TAXES
				$totalPrice = $payment->getFullPriceEventParcel();
				$totalPrice = str_replace('.', ',', sprintf('%.2f', $totalPrice));
			
			// REMOVING TAXES EXTRA
				$backupTaxes = $event->getTicketTypeTaxes();
				//$event->setTicketTypeTaxes(0);
				$totalPriceWithout10Percent = $payment->getFullPriceToPayEventParcel(false, true);
				//$totalPriceWithout10Percent = $event->getFullPrice();
				/*$totalPriceWithout10Percent = $totalPrice - ($totalPrice * (0.1 + ($payment->getParcels()->getPosItem(2) / 100)));*/
				//$totalPriceWithout10Percent += $backupTaxes == 2 ? ($totalPriceWithout10Percent * (0.1 + ($payment->getParcels()->getItem(3) / 100)))*-1 : 0;
				$totalPriceWithout10Percent = str_replace('.', ',', sprintf('%.2f', $totalPriceWithout10Percent));
			
			
			//$parcelCode = trim($payment->getParcels()->getLabelCodeItem(), 'x');
			//$parcelCode .= substr_count($parcelCode, '%') == 0 ? '%' : '';
			//$parcelCode = $payment->getParcels()->getPosItem(3).'%';
			$html_Total .= '<div style="margin: 5px 0px; height: 1px; background: #ddd;"></div>';
			//$html_Total .= 'Total: R$ '.$totalPrice.' - 10%  = <b>R$ '.$totalPriceWithout10Percent.' </b>';
			//$html_Total .= 'Total: R$ '.$totalPrice.' - (10%';
			$html_Total .= 'Total: R$ '.$totalPrice.' - (taxas vuup';
			//$html_Total .= (int)trim($payment->getParcels()->getLabelCodeItem()) > 1 ? ' + '.$parcelCode.' no total sem taxas' : '';
			//$html_Total .= $payment->getParcels()->getItem() > 0 ? ' + '.$parcelCode : '';
			//$html_Total .= $backupTaxes == 1 ? ' no total sem taxas' : '';
			$html_Total .= ') = <b>R$ '.$totalPriceWithout10Percent.' </b>';
		}
	
	$subject = 'Mais ingresso adquirido - vuup';
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
						$headTitle
						<br /><br />
						
						<div>
							<a href="$userUrl" title="$userName" style="border: 1px solid #eee; display: block; float: left; margin-right: 5px; border-radius: 3px;">
								<img src="$userImgUrl" width="50" height="50" style="display: block;" />
							</a>
							<div style="float: left;">
								<a href="$userUrl" title="$userName">
									$userName
								</a>
								adquiriu:
								<div style="padding: 5px; margin: 5px 0 0; border: 1px solid #ddd; border-radius: 3px; width: 410px;">
									$html_Tickets
									$html_Parcels
									$html_Total
									<!-- div style="margin: 5px 0px; height: 1px; background: #ddd;"></div>
									<div style="font: italic 11px Arial, sans-serif; color: #666;">
										Note que os valores acima são brutos, ou seja, não foi retirada ainda a taxa de 10% da plataforma vuup.
									</div -->
								</div>
							</div>
							<div style="clear: both;"></div>
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