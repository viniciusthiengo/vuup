<?php
	$html = '';
	$html_LoadMore = '';
	$hasMap = false;
	$hasDate = false;
	$tamI = count($arrayObj);
	
	if(preg_match('/^(vu-get-ticket-active-dashboard|vu-get-ticket-active-list|vu-get-ticket-active-list-load-more|vu-get-ticket-inactive-list|vu-get-ticket-inactive-list-load-more){1}$/', $_POST['method'])
		|| $isDashboard){
		
		// LOAD MORE
			if($tamI == __LIMIT_TICKETS__){
				$html_LoadMore = <<<HTML
					<a class="link-more br-3" title="Carregar mais" href="package/ctrl/CtrlEvent.php|vu-get-ticket-active-list-load-more">
						Carregar mais
						<i class="fa fa-angle-down"></i>
					</a>
HTML;
				$tamI--;
			}
		
		for($i = 0; $i < $tamI; $i++){
			$idTicketPayment = $arrayObj[$i]->getIdTicketPayment();
			$eventId = $arrayObj[$i]->getEvent()->getId();
			$eventUrl = $arrayObj[$i]->getEvent()->getFullUrl();
			$eventName = $arrayObj[$i]->getEvent()->getName();
			$eventImg = $arrayObj[$i]->getEvent()->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/75-90/');
			$eventAddress = $arrayObj[$i]->getEvent()->getAddress()->getCity().', '.$arrayObj[$i]->getEvent()->getAddress()->getState()->getLabelCodeItem();
			
			$paymentTime = date('d\/m\/Y \à\s H\hi', $arrayObj[$i]->getPayment()->getTime());
			
			$ticketDayLabel = $arrayObj[$i]->getTicketValidDaysHumanFormat().' a partir de:';
			$ticketDayDay = $arrayObj[$i]->getTicketDay()->getDayPage(false).', '.$arrayObj[$i]->getTicketDay()->getDaySeccondsToBrazilDate();
			$ticketDayTime = $arrayObj[$i]->getTicketDay()->getTimeSeccondsToBrazilDate();
			
			$ticketPaymentIdAsCode = $arrayObj[$i]->getIdTicketPaymentAsCode();
			$ticketName = $arrayObj[$i]->getName();
			$ticketPrice = $arrayObj[$i]->getEvent()->getTicketTypeCharge() == 1 ? '' : '(R$ '.$arrayObj[$i]->getPriceHumanFormated($arrayObj[$i]->getEvent()->getTicketTypeTaxes(), false, false, true).')';
			$ticketQRCodeImg = $arrayObj[$i]->getQRCodeImg();
			$ticketQRCodePrintUrl = $arrayObj[$i]->getQRCodePrintUrl();
			
			// STATUS
				$statusClass = $arrayObj[$i]->getStatusClass();
				$statusLabel = $arrayObj[$i]->getStatusLabel();
				
			// BUTTON PASS TICKET
				$html_PassTicketButton = '';
				if($arrayObj[$i]->getStatusForButton() == 1 && $arrayObj[$i]->getUserRepass()->getId() == 0){
					$html_PassTicketButton = <<<HTML
						<a href="package/ctrl/CtrlUser.php|vu-get-gift-ticket-form|$idTicketPayment" class="bt br-3 bt-call-popup" title="Repassar ingresso">
							<i class="fa fa-gift"></i>
							Repassar ingresso
						</a>
HTML;
				}
				
			// USER REPASS
				$html_UserRepass = '';
				if($arrayObj[$i]->getUserRepass()->getId() > 0){
					$userRepassId = $arrayObj[$i]->getUserRepass()->getId();
					$userRepassName = $arrayObj[$i]->getUserRepass()->getName();
					$userRepassUrl = __PATH_FOR_LONG_URL__.$arrayObj[$i]->getUserRepass()->getUrlSufix();
					$userRepassImg = $arrayObj[$i]->getUserRepass()->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/30-30/');					
					$userRepassTimeRepass = $arrayObj[$i]->getUserRepass()->getTimeHumanFormatWithHour();					
					$html_UserRepass = <<<HTML
						<a href="$userRepassUrl" target="_blank" class="user-repass" title="Ingreso enviado por $userRepassName em $userRepassTimeRepass">
							<img src="$userRepassImg" width="30" height="30" />
						</a>
HTML;
				}
				
			
			$html .= <<<HTML
				<div class="event" id="tc-$idTicketPayment">
					<img src="$eventImg" class="banner" width="75" height="90" />
					<div class="info">
						<a href="$eventUrl" target="_blank" class="title" title="$eventName">$eventName</a>
						<div class="status $statusClass">
							<i class="fa fa-circle"></i>
							$statusLabel
						</div>
						<div class="cl normal-info">
							<i class="fa fa-map-marker"></i>
							$eventAddress
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="package/ctrl/CtrlEvent.php|vu-get-map|$eventId" class="bt-map bt-call-popup" title="abrir mapa">
								<i class="fa fa-external-link-square"></i>
								abrir mapa
							</a>
						</div>
						<div class="normal-info">
							<i class="fa fa-caret-square-o-right"></i>
							Comprado em: $paymentTime
						</div>
						<div class="normal-info">
							<i class="fa fa-calendar"></i>
							$ticketDayLabel $ticketDayDay
							&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="fa fa-clock-o"></i>
							$ticketDayTime
						</div>
						<div class="normal-info">
							<i class="fa fa-ticket"></i>
							$ticketName $ticketPrice
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="package/ctrl/CtrlUser.php|vu-get-form-organizer-event-message|$eventId" class="bt-map bt-call-popup" title="contato organização">
								<i class="fa fa-envelope"></i>
								contato organização
							</a>
						</div>
					</div>
					<div class="box-buttons">
						<a href="#" class="bt br-3 bt-open-img" title="Ampliar">
							<i class="fa fa-qrcode"></i>
							Ampliar
						</a>
						<a href="$ticketQRCodePrintUrl" class="bt br-3 bt-print" target="_blank" title="Imprimir ingresso">
							<i class="fa fa-print"></i>
							Imprimir
						</a>
						<div class="cl"></div>
						$html_PassTicketButton
					</div>
					<div class="box-qrcode">
						<img src="$ticketQRCodeImg" class="img-qrcode" width="74" height="74" />
						$ticketPaymentIdAsCode
					</div>
					$html_UserRepass
					<div class="cl"></div>
				</div>
HTML;
		}
		$html .= $html_LoadMore;
		
		
		// EMPTY
			if(empty($html)){
				$html = <<<HTML
					<p class="no-content">
						<i class="fa fa-frown-o"></i>
						Nenhum ingresso ainda adquirido.
					</p>
HTML;
			}
		
	
		// WRAP
			if(preg_match('/^(vu-get-ticket-active-dashboard|vu-get-ticket-active-list|vu-get-ticket-inactive-list){1}$/', $_POST['method']) || $isDashboard){
				$html = <<<HTML
					<div class="box-events">
						$html
					</div>
HTML;
			}
		
		// DASHBOARD
			if(preg_match('/^(vu-get-ticket-active-dashboard){1}$/', $_POST['method']) || $isDashboard){
				$html = <<<HTML
					<nav>
						<ul class="box-header-buttons">
							<li>
								<a href="package/ctrl/CtrlEvent.php|vu-get-ticket-active-list" class="selected" title="Ingressos ativos">
									<i class="fa fa-chevron-down"></i>
									Ingressos ativos
								</a>
							</li>
							<!-- li class="vl"></li>
							<li>
								<a href="package/ctrl/CtrlEvent.php|vu-get-ticket-inactive-list" title="Ingressos inativos">
									<i class="fa fa-chevron-right"></i>
									Ingressos inativos
								</a>
							</li -->
							<li class="cl"></li>
						</ul>
						<div class="cl"></div>
					</nav>
					<div class="sub-content">
						$html
					</div>
HTML;
			}
	}
	
	
	if($isDashboard){
		echo $html;
	}
	else{
		// MOBILE
			$arrayJson = array();
			if(preg_match('/^(vu-mob-get-ticket-active-list){1}$/', $_POST['method']) && is_array($arrayObj)){
				$tamI = count($arrayObj);
				for($i = 0; $i < $tamI; $i++){
					$arrayJson[] = $arrayObj[$i]->getDataJSON();
				}
			}
		//$obj = new Obj();
		//$html = !$obj->detectUTF8($html) ? $html : utf8_encode($html);
		echo json_encode(array('html'=>$html,
								'tickets'=>$arrayJson,
								'synchronizedData'=>$synchronizedData));
	}
?>