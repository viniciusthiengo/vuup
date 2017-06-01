<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Map extends Common {
		private $latitude;
		private $longitude;
		private $zoom;
		private $isEdit;
		
		
		public function __construct($latitude=0, $longitude=0, $zoom=13, $isEdit=false){
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->zoom = $zoom;
			$this->isEdit = $isEdit;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			$this->latitude = $post['latitude'];
			$this->longitude = $post['longitude'];
			$this->zoom = $post['zoom'];
		}
		
		
		public function getLatitude(){
			return($this->latitude);
		}
		public function setLatitude($latitude){
			$this->latitude = $latitude;
		}
		
		
		public function getLongitude(){
			return($this->longitude);
		}
		public function setLongitude($longitude){
			$this->longitude = $longitude;
		}
		
		
		public function getZoom(){
			return($this->zoom);
		}
		public function setZoom($zoom){
			$this->zoom = $zoom;
		}
		
		
		public function getIsEdit(){
			return($this->isEdit);
		}
		public function setIsEdit($isEdit){
			$this->isEdit = $isEdit;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'latitude'=>	$this->getLatitude(),
					'longitude'=>	$this->getLongitude(),
					'zoom'=>		$this->getZoom(),
					'isEdit'=>		$this->getIsEdit());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>