<?php
	$html = '';
	$latitude = is_object($event) ? $event->getAddress()->getMap()->getLatitude() : '-22.912213';
	$longitude = is_object($event) ? $event->getAddress()->getMap()->getLongitude() : '-43.188778';
	
	$inputMap = 'style="display: block;"';
	$linkGoogleMaps = '';
	if(preg_match('/^(vu-get-map){1}$/', $_POST['method'])){
		$inputMap = 'style="display: none;"';
		$linkGoogleMaps = <<<HTML
			<a title="Visualizar no Google Maps" class="bt-other-page" target="_blank" href="http://maps.google.com?q=($latitude, $longitude)">
				visualizar no Google Maps
				<i class="fa fa-external-link"></i>
			</a>
HTML;
	}
	
	$map = new Map();
	$map->setLatitude($latitude);
	$map->setLongitude($longitude);
	$map->setZoom(13);
	$map->setIsEdit(preg_match('/^(vu-get-map){1}$/', $_POST['method']) ? false : true);
	
	if(preg_match('/^(vu-get-map-admin|vu-get-map){1}$/', $_POST['method'])){
		$html = <<<HTML
			<div class="modal-main-content br-3">
				<h2>
					<i class="fa fa-map-marker"></i>
					Mapa
					$linkGoogleMaps
					<a href="#" title="Fechar" class="link-close">
						<i class="fa fa-times-circle"></i>
					</a>
				</h2>
				<div class="wrap-content">
					<div class="map-box">
						<div $inputMap>
							<input id="fct-location" class="br-3" type="text" placeholder="Buscar local" autocomplete="off">
							<span class="info-text">
								Arraste e solte o
								<b>Pin</b>
								para colocar a posição exata do evento.
							</span>
						</div>
						<div id="fct-map"></div>
						
						<a href="#" class="bt bt-map-definid" title="Concluir" $inputMap>
							<i class="fa fa-map-marker"></i>
							Concluir
						</a>
					</div>
				</div>
			</div>
HTML;
	}
	
	echo json_encode(array('isMap'=>true, 'map'=>$map->getDataJSON(), 'html'=>$html));
?>