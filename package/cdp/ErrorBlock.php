<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	class ErrorBlock extends Common {
		private $message;
		private $isError;
		
		public function __construct($message='', $isError=false){
			$this->message = $message;
			$this->isError = $isError;
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function getMessage(){
			return($this->message);
		}
		public function setMessage($message){
			$this->message = $message;
		}
		
		
		public function getIsError(){
			return($this->isError);
		}
		public function setIsError($isError){
			$this->isError = $isError;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'message'=>	$this->getMessage(),
					'isError'=>	$this->getIsError());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>