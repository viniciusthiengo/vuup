<?php
	$html = '';
	$html_LoadMore = '';
	$tam = count($arrayObj);
	
	if(is_object($ownerEvent) || $event->getIsIndex() || preg_match('/^(vu-get-event-favorite-dashboard|vu-get-event-favorite|vu-get-event-favorite-load-more){1}$/', $_POST['method'])){
		// LOAD MORE
			if($tam == __LIMIT_EVENTS__){
				$html_LoadMore = <<<HTML
					<a class="link-more br-3" title="Carregar mais" href="package/ctrl/CtrlEvent.php|vu-get-event-favorite-load-more">
						Carregar mais
						<i class="fa fa-angle-down"></i>
					</a>
HTML;
				$tam--;
			}
			
		for($i = 0; $i < $tam; $i++){
			$classInfo = '';
			$id = $arrayObj[$i]->getId();
			$url = $arrayObj[$i]->getFullUrl();
			$name = $arrayObj[$i]->getName();
			$img = $arrayObj[$i]->getImgBannerUrl(__PATH_FOR_LONG_URL__.'img/event/250-300/');
			$addressUrl = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlEvent.php|vu-get-map|'.$id;
			$addressCity = $arrayObj[$i]->getAddress()->getCity();
			$addressState = $arrayObj[$i]->getAddress()->getState()->getLabelCodeItem();
			$categoryLabel = $arrayObj[$i]->getCategory()->getLabelItem();
			$categoryUrl = __PATH_FOR_LONG_URL__.'busca?ec='.$arrayObj[$i]->getCategory()->getItem();
			$unfavoriteUrl = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlEvent.php|vu-event-favoriting|'.$id;
			
			// DATE
				$html_Date = __PATH_FOR_LONG_URL__.'package/ctrl/CtrlEvent.php|vu-get-days-prices|'.$id;
				$html_Date = <<<HTML
					<a class="normal bt-call-popup" title="Dias de evento" href="$html_Date">
						<i class="fa fa-calendar"></i>
						Dias de evento
					</a>
HTML;
				$html_UnlockEvent = '<i class="fa fa-lock"></i>';
				if(is_object($arrayObj[$i]->getTicketDayNext())){
					$html_UnlockEvent = '';
					$dateDay = $arrayObj[$i]->getTicketDayNext()->getDayPage();
					$dateTime = $arrayObj[$i]->getTicketDayNext()->getTimeSeccondsToBrazilDate();
					$html_Date = <<<HTML
						$html_Date
						<span class="date">
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span title="Próximo dia de evento">
							<i class="fa fa-caret-right"></i>
							$dateDay
							&nbsp;&nbsp;
							<i class="fa fa-clock-o"></i>
							$dateTime
						</span>
						</span>
HTML;
				}
			
			// PARCELS
				$html_Parcels = '';
				if(is_object($arrayObj[$i]->getTicketDayNext()) && $arrayObj[$i]->getTicketTypeCharge() == 2 && $arrayObj[$i]->getTicketParcels()->getItem() > 1){
					$html_Parcels = $arrayObj[$i]->getTicketParcels()->getItem().'x';
					$html_Parcels = <<<HTML
						&nbsp;&nbsp;&nbsp;&nbsp;
						<span class="payment">
							<i class="fa fa-credit-card"></i>
							Parcelado em até $html_Parcels
						</span>
HTML;
				}
				
			// PHOTOS
				$html_Photos = '';
				$arrayPhotos = $arrayObj[$i]->getPhotosArray();
				if(count($arrayPhotos) > 0){
					for($j = 0, $tamJ = 6; $j < $tamJ; $j++){
						if($j < count($arrayPhotos)){
							$photoNormal = __PATH_FOR_LONG_URL__.'img/event/photo/normal/'.$arrayPhotos[$j]->getName();
							$photo = __PATH_FOR_LONG_URL__.'img/event/photo/25-25/'.$arrayPhotos[$j]->getName();
							$html_Photos .= ' <a href="'.$photoNormal.'" title="'.$arrayObj[$i]->getName().'" class="photos-'.$id.'"> <img src="'.$photo.'" width="25" height="25" /> </a> ';
						}
						else{
							$photo = __PATH_FOR_LONG_URL__.'img/event/photo/25-25/default.jpg';
							$html_Photos .= ' <span> <img src="'.$photo.'" width="25" height="25" /> </span> ';
						}
					}
					$html_Photos = <<<HTML
						<div class="box-intern-photos box-photos-$id br-3">
							<div class="title">
								<i class="fa fa-camera-retro"></i>
								Fotos
							</div>
							$html_Photos
						</div>
HTML;
				}
				else{
					$classInfo = empty($classInfo) ? 'without-one-box' : 'without-two-box';
				}
				
			// USERS CONFIRMED
				$html_UsersConfirmed = '';
				$arrayUsersConfirmed = $arrayObj[$i]->getUsersConfirmedArray();
				if(count($arrayUsersConfirmed) > 0 && $arrayObj[$i]->getShowUserConfirmed() == 1){
					for($j = 0, $tamJ = 6; $j < $tamJ; $j++){
						if($j < count($arrayUsersConfirmed)){
							$userName = $arrayUsersConfirmed[$j]->getName();
							$userUrl = __PATH_FOR_LONG_URL__.$arrayUsersConfirmed[$j]->getUrlSufix();
							$userImage = $arrayUsersConfirmed[$j]->getImageUrl(__PATH_FOR_LONG_URL__.'img/user/25-25/');
							$html_UsersConfirmed .= ' <a href="'.$userUrl.'" title="'.$userName.'"> <img src="'.$userImage.'" width="25" height="25" /> </a> ';
						}
						else{
							$userImage = __PATH_FOR_LONG_URL__.'img/event/photo/25-25/default.jpg';
							$html_UsersConfirmed .= ' <span> <img src="'.$userImage.'" width="25" height="25" /> </span> ';
						}
					}
					$html_UsersConfirmed = <<<HTML
						<div class="box-intern-confirmed br-3">
							<div class="title">
								<i class="fa fa-users"></i>
								Confirmaram
							</div>
							$html_UsersConfirmed
						</div>
HTML;
				}
				else{
					$classInfo = empty($classInfo) ? 'without-one-box' : 'without-two-box';
				}
				
			
			$html .= <<<HTML
				<div id="ev-$id" class="event-intern">
					<a href="$url" class="banner" title="$name">
						<img src="$img" class="br-3" width="67" height="80" />
					</a>
					<div class="info $classInfo">
						<a href="$url" class="title" title="$name">$name $html_UnlockEvent</a>
						$html_Date
						$html_Parcels
						<br />
						<a href="$addressUrl" class="normal bt-call-popup" title="Local">
							<i class="fa fa-map-marker"></i>
							$addressCity, $addressState
						</a>
						<br />
						<a href="$categoryUrl" class="normal" title="Categoria">
							<i class="fa fa-tag"></i>
							$categoryLabel
						</a>
						
						<a href="$unfavoriteUrl" class="bt-remove-favorites br-3" title="Remover de favoritos">
							Remover de favoritos 
							<i class="fa fa-trash-o"></i>
						</a>
					</div>
					$html_Photos
					$html_UsersConfirmed
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
						Nenhum evento ainda marcado como favorito por você.
					</p>
HTML;
			}
		
		// WRAP
			if(preg_match('/^(vu-get-event-favorite-dashboard|vu-get-event-favorite){1}$/', $_POST['method'])){
				$html = <<<HTML
					<div class="box-events">
						$html
					</div>
HTML;
			}
		
	
		// DASHBOARD
			if(preg_match('/^(vu-get-event-favorite-dashboard){1}$/', $_POST['method'])){
				$html = <<<HTML
					<nav>
						<ul class="box-header-buttons">
							<li>
								<a href="package/ctrl/CtrlEvent.php|vu-get-event-favorite" class="selected" title="Eventos favoritos">
									<i class="fa fa-chevron-down"></i>
									Eventos favoritos
								</a>
							</li>
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
?>
