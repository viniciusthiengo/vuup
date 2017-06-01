<?php
	$html = '';
	$html_LoadMore = '';
	$tam = count($arrayObj);
	
	if(is_object($ownerEvent) || $event->getIsIndex() || preg_match('/^(vu-get-event-list-page-load-more|vu-get-events-page){1}$/', $_POST['method'])){
		// LOAD MORE
			if($tam == __LIMIT_EVENTS__){
				$classExtra = $event->getIsIndex() ? 'link-more-in-index' : '';
				$html_LoadMore = <<<HTML
					<div class="cl"></div>
					<a class="link-more br-3 $classExtra" title="Carregar mais" href="package/ctrl/CtrlEvent.php|vu-get-event-list-page-load-more">
						Carregar mais
						<i class="fa fa-angle-down"></i>
					</a>
HTML;
				$tam--;
			}
			else{
				$html_LoadMore = '<div class="cl"></div>';
			}
			
		for($i = 0; $i < $tam; $i++){
			$classInfo = '';
			$id = $arrayObj[$i]->getId();
			$url = $arrayObj[$i]->getFullUrl();
			$name = $arrayObj[$i]->getName();
			$img = $arrayObj[$i]->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/250-300/');
			$onwerEventName = $arrayObj[$i]->getUser()->getName();
			$onwerEventUrl = __PATH_FOR_LONG_URL__.$arrayObj[$i]->getUser()->getUrlSufix();
			$addressUrl = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlEvent.php|vu-get-map|'.$id;
			$addressCity = $arrayObj[$i]->getAddress()->getCity();
			$addressState = $arrayObj[$i]->getAddress()->getState()->getLabelCodeItem();
			$categoryLabel = $arrayObj[$i]->getCategory()->getLabelItem();
			$numberTicketSold = $arrayObj[$i]->getNumberTicketSold() > 0 && $arrayObj[$i]->getShowUserConfirmed() == 1 ? $arrayObj[$i]->getNumberTicketSold() : '';
			$categoryUrl = __PATH_FOR_LONG_URL__.'busca?ec='.$arrayObj[$i]->getCategory()->getItem();
			
			// FAVORITE
				$html_Favorite = '';
				if($user->getId() != $arrayObj[$i]->getUser()->getId()){
					$selectedClass = $arrayObj[$i]->getIsFavorite() ? 'selected' : '';
					$favoriteUrl = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlEvent.php|vu-event-favoriting|'.$id;
					$html_Favorite = <<<HTML
						<a href="$favoriteUrl" class="favorite $selectedClass" title="Favoritar">
							<i class="fa fa-star"></i>
						</a>
HTML;
				}
			
			// DATE
				$daysUrl = __PATH_FOR_LONG_URL__.'/package/ctrl/CtrlEvent.php|vu-get-days-prices|'.$id;
				$html_Day = '<i class="fa fa-lock"></i> Finalizado';
				if(is_object($arrayObj[$i]->getTicketDayNext())){
					$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
					$dateDay = $arrayObj[$i]->getTicketDayNext()->getDayPage();
					$dateTime = $arrayObj[$i]->getTicketDayNext()->getTimeSeccondsToBrazilDate();
					$html_Day = '<i class="fa fa-calendar"></i> '.$dateDay.' - '.$dateTime;
					if($arrayObj[$i]->getTicketDayNext()->getDay(true) == $time){
						$html_Day = '<i class="fa fa-calendar"></i> Hoje - '.$dateTime;
					}
				}
				$html_Day = '<b>'.$html_Day.'</b>';
				
			
			// PARCELS
				$html_Parcels = '';
				if($arrayObj[$i]->getTicketTypeCharge() == 2 && $arrayObj[$i]->getTicketParcels()->getItem() > 1){
					$html_Parcels = $arrayObj[$i]->getTicketParcels()->getItem().'x';
					$html_Parcels = <<<HTML
						<div class="box-payment" title="Forma de pagamento">
							<i class="fa fa-credit-card"></i>
							Parcelado em até $html_Parcels
						</div>
HTML;
				}
				
			// TAGS
				$html_Tags = $arrayObj[$i]->getTagsPage(false, false, '#');
				if(!empty($html_Tags)){
					$html_Tags = <<<HTML
						<div class="box-hashtag">
							$html_Tags
						</div>
HTML;
				}
				
			// BUY BUTTON
				$html_ButtonBuy = '';
				if(is_object($arrayObj[$i]->getTicketDayNext()) && $arrayObj[$i]->getNumberTicketSold() >= $arrayObj[$i]->getTicketMaximum()){
					$html_ButtonBuy = <<<HTML
						<a href="$url" title="$html_ButtonBuy">
							<i class="fa fa-bolt"></i>
							Esgotado
						</a>
HTML;
				}
				else if(is_object($arrayObj[$i]->getTicketDayNext())){
					$html_ButtonBuy = $arrayObj[$i]->getTicketTypeCharge() == 2 ? 'Comprar' : 'Obter ingresso';
					$html_ButtonBuy = <<<HTML
						<a href="$url" title="$html_ButtonBuy">
							<i class="fa fa-ticket"></i>
							$html_ButtonBuy
						</a>
HTML;
				}
				else{
					$html_ButtonBuy = <<<HTML
						<a href="$url" title="Acessar evento">
							<i class="fa fa-send"></i>
							Acessar evento
						</a>
HTML;
				}
			
			$styleMarginLeft = $i % 3 == 0 || $i == 0 ? ' style="margin-left: 0;"' : '';
			$styleMarginRight = ($i+1) % 3 == 0 && $i > 0 ? ' style="margin-right: 0;"' : '';
			$html .= <<<HTML
				<div id="evg-$id" class="event" $styleMarginLeft $styleMarginRight>
					<div class="top">
						<div class="left">
							$html_Day
							<a href="$addressUrl" class="bt-call-popup" title="Visualizar local no mapa">
								<i class="fa fa-map-marker"></i> $addressCity, $addressState
							</a>
						</div>
						$html_Favorite
						<div class="cl"></div>
					</div>
					<div class="center" style="background: url($img) no-repeat center center;" title="Página evento">
						<div class="info">
							<a href="$url" class="title" title="$name">
								$name
							</a>
							<a href="$onwerEventUrl" class="builder" title="Produzido por: $onwerEventName">
								<i class="fa fa-building"></i>
								$onwerEventName
							</a>
							<a href="$categoryUrl" class="builder" title="Categoria: $categoryLabel">
								<i class="fa fa-tag"></i>
								$categoryLabel
							</a>
							<a href="$daysUrl" class="builder bt-call-popup" title="Dias de evento">
								<i class="fa fa-calendar"></i>
								Dias de evento
							</a>
							$html_Parcels
							$html_Tags
						</div>
					</div>
					<div class="bottom">
						$html_ButtonBuy
						<div class="confirm">
							$numberTicketSold <i class="fa fa-users"></i>
						</div>
						<div class="cl"></div>
					</div>
				</div>
HTML;
			$html = ($i+1) % 3 == 0 && count($arrayObj) < __LIMIT_EVENTS__ ? $html.'<div class="cl"></div>' : $html;
		}
		$html .= $html_LoadMore;
		
		// WRAP
			if(((is_object($ownerEvent) || $event->getIsIndex()) && !preg_match('/^(vu-get-event-list-page-load-more){1}$/', $_POST['method']))
				|| preg_match('/^(vu-get-events-page){1}$/', $_POST['method'])){
				$classExtra = $event->getIsIndex() ? 'box-grade-in-index' : '';
				$html = <<<HTML
					<div class="box-grade box-events box-for-load-more $classExtra">
						<!-- div class="box-grade-index" -->
							$html
							<div class="cl"></div>
						<!-- /div -->
					</div>
HTML;
			}
	}
	$htmlGrade = $html;
?>