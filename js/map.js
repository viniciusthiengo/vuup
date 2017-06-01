// map.js

function map(idBox, latitude, longitude, zoom_map, map_type, lock_eventos, pin, paid, pazo, pavi, pahe, papi){
	var myLatlng = new google.maps.LatLng(latitude, longitude);
	var time_name = idBox.split('-');
	var mapOptions = {
		center: myLatlng,
		zoom: zoom_map,
		mapTypeId: map_type
	};
	
	var map = new google.maps.Map(document.getElementById(idBox), mapOptions);
	
	pin = (pin == undefined || pin.length == 0) ? 'img/system/icon/pin.png' : pin;
	var marker = new google.maps.Marker({
		map: map,
		position: myLatlng,
		icon: pin,
		draggable:true,
		animation: google.maps.Animation.DROP
	});
	
	var checkIcon = function() {
		var img = new Image();
		img.onload = function(){
			marker.setIcon(pin);
		}; 
		img.onerror = function(){
			pin = '../'+pin;
			checkIcon();
		};
		img.src = pin;
	}
	checkIcon();
	
	// STREET VIEW
	/*if(pavi == 1){
		var panoramaOptions = {
			pano: (pavi == 1 ? paid : ''),
			position: myLatlng,
			zoom: pazo,
			visible: (pavi == 1 ? true : false),
			enableCloseButton: true,
			scrollwheel: true,
			pov:{
				heading: pahe,
				pitch: papi
			}
		};
		var panorama = new google.maps.StreetViewPanorama(document.getElementById(idBox),panoramaOptions);
		map.setStreetView(panorama);
	}*/
	 
	
	if(lock_eventos){
		var input = document.getElementById('fct-location');
		var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo('bounds', map);

		google.maps.event.addListener(autocomplete, 'place_changed', function(){
			var place = autocomplete.getPlace();
			if(!place.geometry){
				return;
			}

			// If the place has a geometry, then present it on a map.
			if(place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			}
			else{
				map.setCenter(place.geometry.location);
			}
			marker.setPosition(place.geometry.location);
			map.setCenter(place.geometry.location);
			atualizaValorHiddenGeo(place.geometry.location);
		});

		// Sets a listener on a radio button to change the filter type on Places
		// Autocomplete.
		function setupClickListener(id, types) {
			var radioButton = document.getElementById(id);
			google.maps.event.addDomListener(radioButton, 'click', function(){
				autocomplete.setTypes(types);
			});
		}
		
		function addMarker(latLng) {
			marker.setPosition(latLng);
			atualizaValorHiddenGeo(latLng);
		}
		
		function toggleBounce(latLng) {
			atualizaValorHiddenGeo(latLng);
		}
		
		function atualizaValorHiddenGeo(latLng){
			document.getElementById('fct-latitude').value = latLng.lat();
			document.getElementById('fct-longitude').value = latLng.lng();
			/*document.getElementById('zoom-'+time_name[1]).value = map.getZoom();
			document.getElementById('mapt-'+time_name[1]).value = map.getMapTypeId();
			document.getElementById('paid-'+time_name[1]).value = map.getStreetView().getPano();
			document.getElementById('pazo-'+time_name[1]).value = map.getStreetView().getZoom();
			document.getElementById('pavi-'+time_name[1]).value = map.getStreetView().getVisible() ? 1 : 0;
			document.getElementById('pahe-'+time_name[1]).value = map.getStreetView().getPov().heading;
			document.getElementById('papi-'+time_name[1]).value = map.getStreetView().getPov().pitch;*/
		}
		
		// start EVENTS
			google.maps.event.addListener(marker, 'mouseout', function(event){
				toggleBounce(event.latLng);
			});
			google.maps.event.addListener(map, 'click', function(event) {
				addMarker(event.latLng);
			});
			/*google.maps.event.addListener(map, 'zoom_changed', function(event) {
				document.getElementById('zoom-' + time_name[1]).value = map.getZoom();
			});*/
			
			// PANORAMA
			/*google.maps.event.addListener(map.getStreetView(), 'pano_changed', function() {
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});
			google.maps.event.addListener(map.getStreetView(), 'position_changed', function() {
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});
			google.maps.event.addListener(map.getStreetView(), 'resize', function() {
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});
			google.maps.event.addListener(map.getStreetView(), 'visible_changed', function() {
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});
			google.maps.event.addListener(map.getStreetView(), 'zoom_changed', function() {
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});
			google.maps.event.addListener(map.getStreetView(), 'pov_changed', function(){
				if(map.getStreetView().getPosition() != undefined){
					addMarker(map.getStreetView().getPosition());
				}
			});*/
		// end EVENTS

		
		// tira e coloca o evento de atualização das configurações do map
		/*$(document).off('click', '#' + idBox + ' .gmnoprint');
		$(document).on('click', '#' + idBox + ' .gmnoprint', function(){
			document.getElementById('zoom-' + time_name[1]).value = map.getZoom();
			document.getElementById('mapt-' + time_name[1]).value = map.getMapTypeId();
		});*/
	}
	else{
		marker.setDraggable(false);
	}
}