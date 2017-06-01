<?php
	$html = '';
	
	
	if(preg_match('/^(vu-get-event-report|vu-get-event-report-subcontent){1}$/', $_POST['method'])){
		// EVENT
			$eventId = $event->getId();
			$eventName = $event->getName();
			$html_OptionsSelect = $reportDataTicket->generateSelectDataByEvent();
			
		// TICKETS SOLD
			// LINE CHART
				$charLineTickesSell = new Report();
				$charLineTickesSell->setTitle('Evento: '.$event->getName());
				$charLineTickesSell->setSubTitle($reportDataTicket->getName().' - '.$reportDataTicket->getMonthLabel().' - '.$reportDataTicket->getYear());
				$charLineTickesSell->setTitleXAxis('Dia do mês');
				$charLineTickesSell->setTitleYAxis('Quantidade');
				$charLineTickesSell->setLabelData($reportDataTicket->getName());
				$charLineTickesSell->setReportData($reportDataTicket);
				$charLineTickesSell->generateXAxisLabels();
				// (POSSIBLE) MORE THAN ONE LINE IN CHART
					$charLineTickesSell->setArrayReportData($arrayReportDataTickets);
					$auxArrayReportDataTickets = $charLineTickesSell->getArrayReportTicketByType();
					if(count($auxArrayReportDataTickets) > 0){
						for($i = 0, $tamI = count($auxArrayReportDataTickets); $i < $tamI; $i++){
							$title = $auxArrayReportDataTickets[$i][0]->getTicket()->getName().' (';
							$title .= $auxArrayReportDataTickets[$i][0]->getTicketDay()->getDayPage(false).', '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getDaySeccondsToBrazilDate();
							$title .= ' às '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getTimeSeccondsToBrazilDate().')';
							
							$charLineTickesSell->setArrayReportData($auxArrayReportDataTickets[$i]);
							$charLineTickesSell->generateData(1, $title);
						}
					}
					else{
						$charLineTickesSell->generateData(1);
					}
			
			// BAR CHART
				$charBarTickesSell = new Report();
				$charBarTickesSell->setTitle('Evento: '.$event->getName());
				$charBarTickesSell->setSubTitle($reportDataTicket->getName().' - '.$reportDataTicket->getMonthLabel().' - '.$reportDataTicket->getYear());
				$charBarTickesSell->setTitleXAxis('Dia do mês');
				$charBarTickesSell->setTitleYAxis('Quantidade');
				$charBarTickesSell->setLabelData($reportDataTicket->getName());
				$charBarTickesSell->setReportData($reportDataTicket);
				$charBarTickesSell->generateXAxisLabels();
				// (POSSIBLE) MORE THAN ONE LINE IN CHART
					$charBarTickesSell->setArrayReportData($arrayReportDataTickets);
					$auxArrayReportDataTickets = $charBarTickesSell->getArrayReportTicketByType();
					if(count($auxArrayReportDataTickets) > 0){
						for($i = 0, $tamI = count($auxArrayReportDataTickets); $i < $tamI; $i++){
							$title = $auxArrayReportDataTickets[$i][0]->getTicket()->getName().' (';
							$title .= $auxArrayReportDataTickets[$i][0]->getTicketDay()->getDayPage(false).', '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getDaySeccondsToBrazilDate();
							$title .= ' às '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getTimeSeccondsToBrazilDate().')';
							
							$charBarTickesSell->setArrayReportData($auxArrayReportDataTickets[$i]);
							$charBarTickesSell->generateData(2, $title);
						}
					}
					else{
						$charBarTickesSell->generateData(2);
					}
					
			// PIE CHART
				$charPieTickesSell = new Report();
				$charPieTickesSell->setTitle('Evento: '.$event->getName().' ('.$reportDataTicket->getName().', '.$reportDataTicket->getMonthLabel().' - '.$reportDataTicket->getYear().')');
				$charPieTickesSell->setSubTitle('');
				$charPieTickesSell->setTitleXAxis('Dia do mês');
				$charPieTickesSell->setTitleYAxis('');
				$charPieTickesSell->setLabelData('Quantidade (porcentagem)');
				$charPieTickesSell->setXAxisLabels(array());
				$charPieTickesSell->setYAxisLabels(array());
				$charPieTickesSell->setReportData($reportDataTicket);
				$charPieTickesSell->setArrayReportData($arrayReportDataTickets);
				$charPieTickesSell->generateDataPie();
					
		// VIEWS
			// LINE CHART
				$charLineViews = new Report();
				$charLineViews->setTitle('Evento: '.$event->getName());
				$charLineViews->setSubTitle($reportDataView->getName().' - '.$reportDataView->getMonthLabel().' - '.$reportDataView->getYear());
				$charLineViews->setTitleXAxis('Dia do mês');
				$charLineViews->setTitleYAxis('Quantidade');
				$charLineViews->setLabelData($reportDataView->getName());
				$charLineViews->setReportData($reportDataView);
				$charLineViews->setArrayReportData($arrayReportDataViews);
				$charLineViews->generateXAxisLabels();
				$charLineViews->generateData(1);
			
			// BAR CHART
				$charBarViews = new Report();
				$charBarViews->setTitle('Evento: '.$event->getName());
				$charBarViews->setSubTitle($reportDataView->getName().' - '.$reportDataView->getMonthLabel().' - '.$reportDataView->getYear());
				$charBarViews->setTitleXAxis('Dia do mês');
				$charBarViews->setTitleYAxis('Quantidade');
				$charBarViews->setLabelData($reportDataView->getName());
				$charBarViews->setReportData($reportDataView);
				$charBarViews->setArrayReportData($arrayReportDataViews);
				$charBarViews->generateXAxisLabels();
				$charBarViews->generateData(2);
		
		$html = <<<HTML
			<div class="box-chart br-3">
				<h2>
					<i class="fa fa-ticket"></i>
					Ingressos vendidos
					<div class="box-data-filter br-3">
						<div class="data-filter">
							<label>
								<input type="radio" name="fct-tickest-sell-lb" value="1" checked="checked" />
								<i class="fa fa-line-chart"></i>
								Gráfico de linhas
							</label>
							&nbsp;&nbsp;
							<label>
								<input type="radio" name="fct-tickest-sell-lb" value="2" />
								<i class="fa fa-bar-chart-o"></i>
								Gráfico de barras
							</label>
						</div>
						<div class="data-filter">
							<select name="fct-filter-month" class="br-3">
								$html_OptionsSelect
							</select>
						</div>
						<div class="cl"></div>
						<input type="hidden" name="fct-chart-type" value="1" />
						<input type="hidden" name="fct-method" value="vu-get-event-report-filter" />
					</div>
					<div class="cl"></div>
				</h2>
				<div id="chart-line-tickets-sell" style="width: 780px; height: 400px; margin: 0 auto;"></div>
				<div id="chart-bar-tickets-sell" style="width: 780px; height: 400px; margin: 0 auto;"></div>
				<div id="chart-pie-tickets-sell" style="width: 780px; height: 400px; margin: 0 auto;"></div>
			</div>
			
			<div class="box-chart br-3">
				<h2>
					<i class="fa fa-fire"></i>
					Visualizações
					<div class="box-data-filter br-3">
						<div class="data-filter">
							<label>
								<input type="radio" name="fct-views-lb" value="1" checked="checked" />
								<i class="fa fa-line-chart"></i>
								Gráfico de linhas
							</label>
							&nbsp;&nbsp;
							<label>
								<input type="radio" name="fct-views-lb" value="2" />
								<i class="fa fa-bar-chart-o"></i>
								Gráfico de barras
							</label>
						</div>
						<div class="data-filter">
							<select name="fct-filter-month" class="br-3">
								$html_OptionsSelect
							</select>
						</div>
						<div class="cl"></div>
						<input type="hidden" name="fct-chart-type" value="3" />
						<input type="hidden" name="fct-method" value="vu-get-event-report-filter" />
					</div>
					<div class="cl"></div>
				</h2>
				<div id="chart-line-views" style="width: 780px; height: 400px; margin: 0 auto;"></div>
				<div id="chart-bar-views" style="width: 780px; height: 400px; margin: 0 auto;"></div>
			</div>
HTML;

		if(preg_match('/^(vu-get-event-report){1}$/', $_POST['method'])){
			$html = <<<HTML
				<h2>
					<i class="fa fa-bar-chart-o"></i>
					Relatórios <b>$eventName</b>
					<a href="package/ctrl/CtrlEvent.php|vu-get-event-list" class=" br-3 bt bt-come-back" title="Voltar">
						<i class="fa fa-reply"></i>
						Voltar
					</a>
					<input type="hidden" id="fct-id" value="$eventId" />
				</h2>
				<a href="package/ctrl/CtrlEvent.php|vu-get-event-report-subcontent" class="selected br-3 bt bt-submenu" title="Geral">
					<i class="fa fa-bar-chart-o"></i>
					Geral
				</a>
				<!-- a href="package/ctrl/CtrlEvent.php|vu-get-event-promoters-report-subcontent" class="br-3 bt bt-submenu" title="Promoters">
					<i class="fa fa-users"></i>
					Promoters
				</a -->
				<div class="cl"></div>
				<div class="sub-sub-content">
					$html
				</div>
HTML;
		}
		
		echo json_encode(array('hasReport'=>true,
			'charLineTickesSell'=>$charLineTickesSell->getDataJSON(),
			'charBarTickesSell'=>$charBarTickesSell->getDataJSON(),
			'charPieTickesSell'=>$charPieTickesSell->getDataJSON(),
			'charLineViews'=>$charLineViews->getDataJSON(),
			'charBarViews'=>$charBarViews->getDataJSON(),
			'html'=>$html));
	}
	else if(preg_match('/^(vu-get-event-report-filter){1}$/', $_POST['method'])){
		// EVENT
			$eventId = $event->getId();
			$eventName = $event->getName();
			//exit(var_dump($arrayReportData));

		// LINE CHART
			$charLine = new Report();
			$charLine->setTitle('Evento: '.$event->getName());
			$charLine->setSubTitle($reportData->getName().' - '.$reportData->getMonthLabel().' - '.$reportData->getYear());
			$charLine->setTitleXAxis('Dia do mês');
			$charLine->setTitleYAxis('Quantidade');
			$charLine->setLabelData($reportData->getName());
			$charLine->setReportData($reportData);
			$charLine->setArrayReportData($arrayReportData);
			$charLine->generateXAxisLabels();
			if($_POST['type'] == 3){
				$charLine->generateData(1);
			}
			else{
				// (POSSIBLE) MORE THAN ONE LINE IN CHART
					$charLine->setArrayReportData($arrayReportData);
					$auxArrayReportDataTickets = $charLine->getArrayReportTicketByType();
					if(count($auxArrayReportDataTickets) > 0){
						for($i = 0, $tamI = count($auxArrayReportDataTickets); $i < $tamI; $i++){
							$title = $auxArrayReportDataTickets[$i][0]->getTicket()->getName().' (';
							$title .= $auxArrayReportDataTickets[$i][0]->getTicketDay()->getDayPage(false).', '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getDaySeccondsToBrazilDate();
							$title .= ' às '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getTimeSeccondsToBrazilDate().')';
							
							$charLine->setArrayReportData($auxArrayReportDataTickets[$i]);
							$charLine->generateData(1, $title);
						}
					}
					else{
						$charLine->generateData(1);
					}
			}
			
		// BAR CHART
			$charBar = new Report();
			$charBar->setTitle('Evento: '.$event->getName());
			$charBar->setSubTitle($reportData->getName().' - '.$reportData->getMonthLabel().' - '.$reportData->getYear());
			$charBar->setTitleXAxis('Dia do mês');
			$charBar->setTitleYAxis('Quantidade');
			$charBar->setLabelData($reportData->getName());
			$charBar->setReportData($reportData);
			$charBar->setArrayReportData($arrayReportData);
			$charBar->generateXAxisLabels();
			if($_POST['type'] == 3){
				$charBar->generateData(2);
			}
			else{
				// (POSSIBLE) MORE THAN ONE LINE IN CHART
					$charBar->setArrayReportData($arrayReportData);
					$auxArrayReportDataTickets = $charBar->getArrayReportTicketByType();
					if(count($auxArrayReportDataTickets) > 0){
						for($i = 0, $tamI = count($auxArrayReportDataTickets); $i < $tamI; $i++){
							$title = $auxArrayReportDataTickets[$i][0]->getTicket()->getName().' (';
							$title .= $auxArrayReportDataTickets[$i][0]->getTicketDay()->getDayPage(false).', '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getDaySeccondsToBrazilDate();
							$title .= ' às '.$auxArrayReportDataTickets[$i][0]->getTicketDay()->getTimeSeccondsToBrazilDate().')';
							
							$charBar->setArrayReportData($auxArrayReportDataTickets[$i]);
							$charBar->generateData(2, $title);
						}
					}
					else{
						$charBar->generateData(2);
					}
			}
			
		// PIE CHART
			$charPieTickesSell = new Report();
			if($_POST['type'] == 1){ // TICKET REPORT
				$charPieTickesSell->setTitle('Evento: '.$event->getName().' ('.$reportData->getName().', '.$reportData->getMonthLabel().' - '.$reportData->getYear().')');
				$charPieTickesSell->setSubTitle('');
				$charPieTickesSell->setTitleXAxis('Dia do mês');
				$charPieTickesSell->setTitleYAxis('');
				$charPieTickesSell->setLabelData('Quantidade (porcentagem)');
				$charPieTickesSell->setXAxisLabels(array());
				$charPieTickesSell->setYAxisLabels(array());
				$charPieTickesSell->setReportData($reportData);
				$charPieTickesSell->setArrayReportData($arrayReportData);
				$charPieTickesSell->generateDataPie();
			}
			
		echo json_encode(array('hasReport'=>true,
			'charLine'=>$charLine->getDataJSON(),
			'charBar'=>$charBar->getDataJSON(),
			'charPie'=>$charPieTickesSell->getDataJSON()));
	}
	else if(preg_match('/^(vu-get-event-promoters-report-subcontent){1}$/', $_POST['method'])){
		$html = <<<HTML
			<div class="box-promoters">
				<div id="pr-1" class="promoter br-3">
					<div class="wrap-info br-3">
						<img src="img/user/100-100/event-01.jpg" width="100" height="100" />
						<div class="info br-3">
							<a href="#" class="title" target="_blank" title="Name promoter">
								<i class="fa fa-user"></i>
								Name promoter
							</a>
							<a href="#" class="title" target="_blank" title="Página vendas">
								<i class="fa fa-external-link"></i>
								Página vendas
							</a>
							<a href="package/ctrl/CtrlUser.php|vu-get-form-promoter-message|2" class="link-contact bt-call-popup" title="Enviar mensagem">
								<i class="fa fa-envelope"></i>
								Enviar mensagem
							</a>
							<div>
								<i class="fa fa-ticket"></i>
								15 vendas
							</div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="box-chart br-3">
						<h2>
							<div class="box-data-filter br-3">
								<div class="data-filter">
									<label>
										<input type="radio" name="fct-tickest-sell-lb-1" value="1" checked="checked" />
										Gráfico de linhas
									</label>
									&nbsp;&nbsp;
									<label>
										<input type="radio" name="fct-tickest-sell-lb-1" value="2" />
										Gráfico de barras
									</label>
								</div>
								<div class="data-filter">
									<select name="fct-filter-month" class="br-3">
										<option value="1">Janeiro - 2014</option>
										<option value="2">Fevereiro - 2014</option>
										<option value="3">Março - 2014</option>
									</select>
								</div>
								<div class="cl"></div>
								<input type="hidden" name="fct-chart-type" value="1" />
								<input type="hidden" name="fct-method" value="vu-get-event-promoters-report-subcontent-filter" />
							</div>
							<div class="cl"></div>
						</h2>
						<div id="chart-line-tickets-sell-1" style="width: 515px; height: 300px; margin: 0 auto;"></div>
						<div id="chart-bar-tickets-sell-1" style="width: 515px; height: 300px; margin: 0 auto;"></div>
					</div>
					<div class="cl"></div>
				</div>
				
				<div id="pr-2" class="promoter br-3">
					<div class="wrap-info br-3">
						<img src="img/user/100-100/event-01.jpg" width="100" height="100" />
						<div class="info br-3">
							<a href="#" class="title" target="_blank" title="Name promoter">
								<i class="fa fa-user"></i>
								Name promoter
							</a>
							<a href="#" class="title" target="_blank" title="Página vendas">
								<i class="fa fa-external-link"></i>
								Página vendas
							</a>
							<a href="package/ctrl/CtrlUser.php|vu-get-form-promoter-message|2" class="link-contact bt-call-popup" title="Enviar mensagem">
								<i class="fa fa-envelope"></i>
								Enviar mensagem
							</a>
							<div>
								<i class="fa fa-ticket"></i>
								15 vendas
							</div>
						</div>
						<div class="cl"></div>
					</div>
					<div class="box-chart br-3">
						<h2>
							<div class="box-data-filter br-3">
								<div class="data-filter">
									<label>
										<input type="radio" name="fct-tickest-sell-lb-2" value="1" checked="checked" />
										Gráfico de linhas
									</label>
									&nbsp;&nbsp;
									<label>
										<input type="radio" name="fct-tickest-sell-lb-2" value="2" />
										Gráfico de barras
									</label>
								</div>
								<div class="data-filter">
									<select name="fct-filter-month" class="br-3">
										<option value="1">Janeiro - 2014</option>
										<option value="2">Fevereiro - 2014</option>
										<option value="3">Março - 2014</option>
									</select>
								</div>
								<div class="cl"></div>
								<input type="hidden" name="fct-chart-type" value="1" />
								<input type="hidden" name="fct-method" value="vu-get-event-promoters-report-subcontent-filter" />
							</div>
							<div class="cl"></div>
						</h2>
						<div id="chart-line-tickets-sell-1" style="width: 515px; height: 300px; margin: 0 auto;"></div>
						<div id="chart-bar-tickets-sell-1" style="width: 515px; height: 300px; margin: 0 auto;"></div>
					</div>
					<div class="cl"></div>
				</div>
			</div>
HTML;
		
		$charLineTickesSell->setSubTitle('Ingressos vendidos por João Almeida - Janeiro - 2014');
		
		echo json_encode(array('hasReport'=>true,
			'hasReportPromoter'=>true,
			'usersData'=>array($charLineTickesSell->getDataJSON(), $charLineTickesSell->getDataJSON()),
			'html'=>$html));
	}
	/*else if(preg_match('/^(vu-get-event-promoters-report-subcontent-filter){1}$/', $_POST['method'])){
		$charLineTickesSell->setSubTitle('Ingressos vendidos por João Almeida - Janeiro - 2014');
		$charBarTickesSell->setSubTitle('Ingressos vendidos por João Almeida - Janeiro - 2014');
		
		echo json_encode(array('hasReport'=>true,
			'charLine'=>$charLineTickesSell->getDataJSON(),
			'charBar'=>$charBarTickesSell->getDataJSON()));
	}*/
	
	
?>