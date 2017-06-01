<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/ErrorBlock.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	class Error extends Common {
		private $hasError;
		private $codeError;
		private $genericError;
		private $emailError;
		private $urlSufixError;
		private $passwordError;
		private $nameError;
		private $paymentError;
		
		public function __construct($hasError=false, $codeError=0, $genericError=NULL, $emailError=NULL, $urlSufixError=NULL, $passwordError=NULL, $nameError=NULL, $paymentError=NULL){
			$this->hasError = $hasError;
			$this->codeError = $codeError;
			$this->genericError = $genericError;
			$this->emailError = $emailError;
			$this->urlSufixError = $urlSufixError;
			$this->passwordError = $passwordError;
			$this->nameError = $nameError;
			$this->paymentError = $paymentError;
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function hasError(){
			return($this->hasError);
		}
		public function setHasError($hasError){
			$this->hasError = $hasError;
		}
		
		
		public function getCodeError(){
			return($this->codeError);
		}
		public function setCodeError($codeError){
			$this->codeError = $codeError;
		}
		
		
		public function getGenericError(){
			return($this->genericError);
		}
		public function setGenericError($genericError){
			$this->genericError = $genericError;
		}
		
		
		public function getEmailError(){
			return($this->emailError);
		}
		public function setEmailError($emailError){
			$this->emailError = $emailError;
		}
		
		
		public function getUrlSufixError(){
			return($this->urlSufixError);
		}
		public function setUrlSufixError($urlSufixError){
			$this->urlSufixError = $urlSufixError;
		}
		
		
		public function getPasswordError(){
			return($this->passwordError);
		}
		public function setPasswordError($passwordError){
			$this->passwordError = $passwordError;
		}
		
		
		public function getNameError(){
			return($this->nameError);
		}
		public function setNameError($nameError){
			$this->nameError = $nameError;
		}
		
		
		public function getPaymentError(){
			return($this->paymentError);
		}
		public function setPaymentError($paymentError){
			$this->paymentError = $paymentError;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'hasError'=>		$this->hasError(),
					'codeError'=>		$this->getCodeError(),
					'genericError'=>	is_object($this->getGenericError()) ? $this->getGenericError()->getDataJSON() : NULL,
					'emailError'=>		is_object($this->getEmailError()) ? $this->getEmailError()->getDataJSON() : NULL,
					'urlSufixError'=>	is_object($this->getUrlSufixError()) ? $this->getUrlSufixError()->getDataJSON() : NULL,
					'passwordError'=>	is_object($this->getPasswordError()) ? $this->getPasswordError()->getDataJSON() : NULL,
					'nameError'=>		is_object($this->getNameError()) ? $this->getNameError()->getDataJSON() : NULL,
					'paymentError'=>	is_object($this->getPaymentError()) ? $this->getPaymentError()->getDataJSON() : NULL);
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>