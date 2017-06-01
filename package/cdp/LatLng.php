<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Obj.php');
	
	
	class LatLng extends Obj {
		private $obj;
		private $latitude;
		private $longitude;
		
		
		public function __construct($id=0, $obj=NULL, $latitude='', $longitude=''){
			parent::__construct($id, 0, 0, 0, '');
			$this->obj = $obj;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, 0, 0, 0, '');
			$this->obj = new Obj($post['id-parent']);
			$this->latitude = $post['latitude'];
			$this->longitude = $post['longitude'];
		}
		
		
		public function getObj(){
			return($this->obj);
		}
		public function setObj($obj){
			$this->obj = $obj;
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
	}
?>