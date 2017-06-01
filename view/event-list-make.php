<?php
	$html = '';
	$html_LoadMore = '';
	$tam = count($arrayObj);
	
	if(preg_match('/^(vu-get-event-list|vu-get-event-list-load-more){1}$/', $_POST['method'])){
		// LOAD MORE
			if($tam == __LIMIT_EVENTS__){
				$html_LoadMore = <<<HTML
					<a class="link-more br-3" title="Carregar mais" href="package/ctrl/CtrlEvent.php|vu-get-event-list-load-more">
						Carregar mais
						<i class="fa fa-angle-down"></i>
					</a>
HTML;
				$tam--;
			}
			
		for($i = 0; $i < $tam; $i++){
			$id = $arrayObj[$i]->getId();
			$name = $arrayObj[$i]->getName();
			$url = $arrayObj[$i]->getFullUrl();
			$imgBanner = $arrayObj[$i]->getImgBannerUrl('img/event/75-90/');
			$statusClass = $arrayObj[$i]->getStatusClass();
			$statusLabel = $arrayObj[$i]->getStatusLabel();
			$address = $arrayObj[$i]->getAddress()->getCity().', '.$arrayObj[$i]->getAddress()->getState()->getLabelCodeItem();
			$createDay = $arrayObj[$i]->getTimeHumanFormat();
			$createHourMinute = $arrayObj[$i]->getTimeHour().'h'.$arrayObj[$i]->getTimeMinute();
			
			$numberTicketSoldLabel = $arrayObj[$i]->getNumberTicketSoldLabel();
			$numberCommentLabel = $arrayObj[$i]->getNumberCommentLabel();
			$numberViewLabel = $arrayObj[$i]->getNumberViewLabel();
			$numberFavoriteLabel = $arrayObj[$i]->getNumberFavoriteLabel();
			
			$html .= <<<HTML
				<div class="event" id="ev-$id">
					<img src="$imgBanner" class="banner" width="75" height="90" />
					<div class="info">
						<a href="$url" target="_blank" class="title" title="$name">$name</a>
						<div class="status $statusClass">
							<i class="fa fa-circle"></i>
							$statusLabel
						</div>
						<div class="cl normal-info">
							<i class="fa fa-map-marker"></i>
							$address
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="package/ctrl/CtrlEvent.php|vu-get-map|$id" class="bt-map bt-call-popup" title="abrir mapa">
								<i class="fa fa-external-link-square"></i>
								abrir mapa
							</a>
						</div>
						<div class="normal-info">
							<i class="fa fa-send"></i>
							Criado em: $createDay
							&nbsp;&nbsp;&nbsp;&nbsp;
							<i class="fa fa-clock-o"></i>
							$createHourMinute
						</div>
						<a href="package/ctrl/CtrlEvent.php|vu-get-days-prices|$id" class="bt-days-price bt-call-popup" title="Dias de evento">
							<i class="fa fa-calendar"></i>
							Dias de evento
						</a>
						<div class="normal-info">
							$numberTicketSoldLabel
							&nbsp;
							$numberCommentLabel
							&nbsp;
							$numberViewLabel
							&nbsp;
							$numberFavoriteLabel
						</div>
					</div>
					<div class="box-buttons">
						<a href="package/ctrl/CtrlEvent.php|vu-get-event-report|$id" class="bt br-3 bt-subcontent" title="Relatórios">
							<i class="fa fa-bar-chart-o"></i>
							Relatórios
						</a>
						<a href="package/ctrl/CtrlEvent.php|vu-get-event-update-form|$id" class="bt br-3 bt-subcontent" title="Editar">
							<i class="fa fa-edit"></i>
							Editar
						</a>
					</div>
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
						Nenhum evento ainda criado.
					</p>
HTML;
			}
		
		
		if(preg_match('/^(vu-get-event-list){1}$/', $_POST['method'])){
			$html = <<<HTML
				<div class="box-events">
					$html
				</div>
HTML;
		}
	}
	
	
	else if(is_object($ownerEvent) || (is_object($event) && $event->getIsIndex()) || preg_match('/^(vu-get-events-page|vu-get-event-list-page-load-more){1}$/', $_POST['method'])){
		require_once(__PATH__.'/view/event-grade-page-make.php');
		require_once(__PATH__.'/view/event-list-page-make.php');
	}
?>