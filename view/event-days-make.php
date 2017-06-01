<?php
	$html = '';
	$html_TicketDay = '';
	$arrayTicketsDay = $event->getTicketsDayArray();
	$daySeconds = 0;
	
	for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
		// BEGIN DAY PART
			$daySeconds = $arrayTicketsDay[$i]->getDay();
			$day = $arrayTicketsDay[$i]->getDayPage(false).', '.$arrayTicketsDay[$i]->getDaySeccondsToBrazilDate();
			$time = $arrayTicketsDay[$i]->getTimeSeccondsToBrazilDate();
			$price = $event->getTicketTypeCharge() == 1 ? '' : '<th> Preço (R$) </th>';			
			$html_TicketDay = <<<HTML
				<div class="day br-3">
					<div class="date br-3">
						<i class="fa fa-calendar"></i>
						$day
						<i class="fa fa-clock-o"></i>
						$time
					</div>
					<div class="prices br-3">
						<table>
							<tr class="title">
								<th> <i class="fa fa-ticket"></i> Ingresso </th>
								$price
							</tr>
HTML;
		
		// TICKETS
			$html_Ticket = '';
			$arrayTickets = $arrayTicketsDay[$i]->getTicketArray();
			for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
				$name = $arrayTickets[$j]->getName();
				$price = $event->getTicketTypeCharge() == 1 ? '' : '<td>'.$arrayTickets[$j]->getPriceHumanFormated($event->getTicketTypeTaxes(), false, false, true).'</td>';
				if($arrayTickets[$j]->getStatus() == 1){
					$html_Ticket .= <<<HTML
						<tr>
							<td>$name</td>
							$price
						</tr>
HTML;
				}
			}
			
			if(empty($html_Ticket)){
				continue;
			}
			$html_TicketDay .= $html_Ticket;
		
		// BOTTOM
			$html_TicketDay .= <<<HTML
						</table>
					</div>
					<div class="cl"></div>
				</div>
				<div class="vl"></div>
HTML;
		
		$html .= $html_TicketDay;
	}
	
	// EMPTY
		if(empty($html)){
			$html = <<<HTML
				<p class="no-content">
					<i class="fa fa-frown-o"></i>
					Nenhum ingresso / dia disponível para esse evento.
				</p>
HTML;
		}
	
	$html = <<<HTML
		<div class="modal-main-content br-3">
			<h2>
				<i class="fa fa-calendar"></i>
				Dias de evento
				<a href="#" title="Fechar" class="link-close">
					<i class="fa fa-times-circle"></i>
				</a>
			</h2>
			<div class="wrap-content">
				<div class="days-box">
					$html
				</div>
			</div>
		</div>
HTML;
	
	echo json_encode(array('isMap'=>false, 'html'=>$html));
?>