<?php
	$html_TicketsDay = <<<HTML
		<div class="box-lote-ticket br-3">
			<a href="#" class="close-day" title="Remover dia">
				<i class="fa fa-trash-o"></i>
				Remover dia
			</a>
			<div class="box-day-ticket br-3">
				<input type="text" id="fct-ticket-date-day-1" class="br-3" placeholder="*Dia" />
				<b>às</b>
				<select id="fct-date-hour-1" class="br-3">
					$hourOptions
				</select>
				<b>:</b>
				<select id="fct-date-minute-1" class="br-3">
					$minuteOptions
				</select>
				<div class="cl"></div>
			</div>
			<div class="box-container-ticket">
				<div class="box-content-ticket br-3">
					<a href="#" class="close-ticket" title="Remover ingresso">
						<i class="fa fa-trash-o"></i>
						Remover ingresso
					</a>
					<div class="box-field left-wm">
						<input type="text" id="fct-ticket-name-1" class="br-3" placeholder="*Nome ingresso" />
						<div class="cl"></div>
					</div>
					<div class="box-field left">
						<select id="fct-ticket-max-1" class="br-3" disabled="disabled">
							$ticketQtdMaxOptions
						</select>
						<div class="cl"></div>
					</div>
					<div class="box-field left">
						<input type="text" id="fct-ticket-price-1" class="br-3" placeholder="*R$" disabled="disabled" />
						<div class="cl"></div>
					</div>
					<div class="cl"></div>
					<div class="box-field left-wm">
						<input type="text" id="fct-ticket-max-sell-1" class="br-3" placeholder="*Quantidade Máxima" />
						<div class="box-show-info hackcode-1">
							<i class="fa fa-question-circle"></i>
							<div class="info br-3" style="display: none;">
								<div class="arrow-top-right"></div>
								Quantidade máxima de ingressos desse tipo que podem ser obtidos / vendidos
								para o evento. Exemplo: <em>1000 ingressos masculinos podem ser vendidos
								para o evento</em>
							</div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="box-field left">
						<select id="fct-ticket-days-1" class="br-3">
							$ticketValidDaysOptions
						</select>
						<div class="box-show-info hackcode-1">
							<i class="fa fa-question-circle"></i>
							<div class="info br-3" style="display: none;">
								<div class="arrow-top-right"></div>
								A quantidade de dias que esse tipo de ingresso é válido. Exemplo: <em>se 2 for selecionado
								isso significa que o usuário que comprou esse ingresso poderá ir em 2 dias de evento.</em>
							</div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="cl"></div>
				</div>
				<a href="#" class="bt br-3 bt-ticket-add" title="Add ingresso">
					<i class="fa fa-plus-circle"></i>
					Add ingresso
				</a>
			</div>
			<div class="cl"></div>
		</div>
HTML;
	//exit(htmlentities($html_TicketsDay));
	if(is_object($event)){
		$arrayObj = $event->getTicketsDayArray();
		$html_TicketsDay = '';
		
		for($i = 0, $tamI = count($arrayObj); $i < $tamI; $i++){
			$ticketDayId = $arrayObj[$i]->getId();
			$ticketDayDay = $arrayObj[$i]->getDaySeccondsToBrazilDate();
			$ticketDayHourOptions = $arrayObj[$i]->getHour()->getOptions();
			$ticketDayMinuteOptions = $arrayObj[$i]->getMinute()->getOptions();
			$html_aux = '';
			$arrayTickets = $arrayObj[$i]->getTicketArray();
			
			for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
				$ticketId = $arrayTickets[$j]->getId();
				$ticketName = $arrayTickets[$j]->getName();
				$ticketQtdMaxOptions = $arrayTickets[$j]->getQtdMax()->getOptions();
				$ticketValidDaysOptions = $arrayTickets[$j]->getTicketValidDays()->getOptions();
				$qtdMaxSell = $arrayTickets[$j]->getQtdMaxSell();
				$ticketPrice = $arrayTickets[$j]->getPrice() == 0 ? '' : $arrayTickets[$j]->getPrice();
				
				$ticketStatusArray = array();
				$ticketStatusArray[] = $arrayTickets[$j]->getStatus() == 1 ? 'checked="checked"' : '';
				$ticketStatusArray[] = $arrayTickets[$j]->getStatus() == 0 ? 'checked="checked"' : '';
				
				$html_aux .= <<<HTML
					<div class="box-content-ticket br-3" id="tc-$ticketId">
						<!-- a href="#" class="close-ticket" title="Remover ingresso">
							<i class="fa fa-trash-o"></i>
							Remover ingresso
						</a -->
						<div class="box-field left-wm">
							<input type="text" id="fct-ticket-name-$ticketId" class="br-3" value="$ticketName" placeholder="*Nome ingresso" />
							<div class="cl"></div>
						</div>
						<div class="box-field left">
							<select id="fct-ticket-max-$ticketId" class="br-3" $disabled>
								$ticketQtdMaxOptions
							</select>
							<div class="cl"></div>
						</div>
						<div class="box-field left">
							<input type="text" id="fct-ticket-price-$ticketId" class="br-3" placeholder="*R$" value="$ticketPrice" $disabled />
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
						<div class="box-field left-wm">
							<input type="text" id="fct-ticket-max-sell-1" class="br-3" value="$qtdMaxSell" placeholder="*Quantidade Máxima" />
							<div class="box-show-info hackcode-1">
								<i class="fa fa-question-circle"></i>
								<div class="info br-3" style="display: none;">
									<div class="arrow-top-right"></div>
									Quantidade máxima de ingressos desse tipo que podem ser obtidos / vendidos
									para o evento. Exemplo: <em>1000 ingressos masculinos podem ser vendidos
									para o evento</em>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="box-field left">
							<select id="fct-ticket-days-1" class="br-3">
								$ticketValidDaysOptions
							</select>
							<div class="box-show-info hackcode-1">
								<i class="fa fa-question-circle"></i>
								<div class="info br-3" style="display: none;">
									<div class="arrow-top-right"></div>
									A quantidade de dias que esse tipo de ingresso é válido. Exemplo: <em>se 2 for selecionado
									isso significa que o usuário que comprou esse ingresso poderá ir em 2 dias de evento.</em>
								</div>
							</div>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
						<div class="box-field right-wm">
							<label>
								<input type="radio" name="fct-ticket-status-$ticketId" value="1" $ticketStatusArray[0] />
								Ativo
							</label>
							&nbsp;
							<label>
								<input type="radio" name="fct-ticket-status-$ticketId" value="0" $ticketStatusArray[1] />
								Inativo
							</label>
							<div class="cl"></div>
						</div>
						<div class="cl"></div>
					</div>
HTML;
			}
			$html_TicketsDay .= <<<HTML
				<div class="box-lote-ticket br-3" id="td-$ticketDayId">
					<!-- a href="#" class="close-day" title="Remover dia">
						<i class="fa fa-trash-o"></i>
						Remover dia
					</a -->
					<div class="box-day-ticket br-3">
						<input type="text" id="fct-ticket-date-day-$ticketDayId" class="br-3" placeholder="*Dia" value="$ticketDayDay" />
						<b>às</b>
						<select id="fct-date-hour-$ticketDayId" class="br-3">
							$ticketDayHourOptions
						</select>
						<b>:</b>
						<select id="fct-date-minute-$ticketDayId" class="br-3">
							$ticketDayMinuteOptions
						</select>
						<div class="cl"></div>
					</div>
					<div class="box-container-ticket">
						$html_aux
						<a href="#" class="bt br-3 bt-ticket-add" title="Add ingresso">
							<i class="fa fa-plus-circle"></i>
							Add ingresso
						</a>
					</div>
					<div class="cl"></div>
				</div>
HTML;
		}
	}
?>