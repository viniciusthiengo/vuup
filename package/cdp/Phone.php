<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Phone extends Common {
		private $code;
		private $number;
		
		
		public function __construct($code='', $number=''){
			$this->code = $code;
			$this->number = $number;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			$this->code = $post['phone-code'];
			$this->number = $post['phone-number'];
		}
		
		
		public function getCode(){
			return($this->code);
		}
		public function setCode($code){
			$this->code = $code;
		}
		
		
		public function getNumber(){
			return($this->number);
		}
		public function setNumber($number){
			$this->number = $number;
		}
		
		
		public function getPhoneHumanFormated(){
			return('('.$this->code.') '.$this->number);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'code'=>	$this->getCode(),
					'number'=>	$this->getNumber());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>