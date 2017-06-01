<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	
	
	class Parameters {
		
		
		public function __construct(){
			// OBJ
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function setDataCorrectlyFromUrl($fullUrl){
			$aux = explode('?', $fullUrl);
			if(!empty($aux[1])){
				$aux = explode('&', $aux[1]);
				foreach($aux as $value){
					$value = explode('=', $value);
					$this->{$value[0]} = $value[1];
				}
			}
		}
		
		
		// JSON
			/*public function getDataJSON(){
				$aux = array();
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}*/
	}
?>