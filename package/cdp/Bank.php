<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/BankTypeAccount.php');
	require_once(__PATH__.'/package/cdp/BankBrand.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	
	
	class Bank extends Common {
		private $user;
		private $bankTypeAccount;
		private $bankBrand;
		private $agency;
		private $number;
		private $digit;
		private $operation;
		private $document;
		
		public function __construct($id=0, $status=0, $time=0, $user=NULL, $bankTypeAccount=NULL, $bankBrand=NULL, $agency='', $number='', $digit='', $operation='', $document=NULL){
			parent::__construct($id, '', NULL, $status, $time);
			$this->user = $user;
			$this->bankTypeAccount = $bankTypeAccount;
			$this->bankBrand = $bankBrand;
			$this->agency = $agency;
			$this->number = $number;
			$this->digit = $digit;
			$this->operation = $operation;
			$this->document = $document;
			// STATUS ==> 0 = CONTA BANCÁRIA SUSPENSA | 1 = CONTA BANCÁRIA OK | 2 = CONTA BANCÁRIA VÁLIDA AINDA NÃO ATIVA
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, '', NULL, 2, time());
			
			$this->bankTypeAccount = new BankTypeAccount(empty($post['type-account']) ? 0 : $post['type-account']);
			$this->bankBrand = new BankBrand(empty($post['bank']) ? 0 : $post['bank']);
			$this->agency = $post['agency'];
			$this->number = $post['number'];
			$this->digit = $post['digit'];
			$this->operation = $post['operation'];
			
			$this->setDocument(new File());
			$this->getDocument()->setCorrectName($post['document']);
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getBankTypeAccount(){
			return($this->bankTypeAccount);
		}
		public function setBankTypeAccount($bankTypeAccount){
			$this->bankTypeAccount = $bankTypeAccount;
		}
		
		
		public function getBankBrand(){
			return($this->bankBrand);
		}
		public function setBankBrand($bankBrand){
			$this->bankBrand = $bankBrand;
		}
		
		
		public function getAgency(){
			return($this->agency);
		}
		public function setAgency($agency){
			$this->agency = $agency;
		}
		
		
		public function getNumber(){
			return($this->number);
		}
		public function setNumber($number){
			$this->number = $number;
		}
		
		
		public function getDigit(){
			return($this->digit);
		}
		public function setDigit($digit){
			$this->digit = $digit;
		}
		
		
		public function getOperation(){
			return($this->operation);
		}
		public function setOperation($operation){
			$this->operation = $operation;
		}
		
		
		public function getDocument(){
			return($this->document);
		}
		public function setDocument($document){
			$this->document = $document;
		}
		public function getDocumentUrl($path=''){
			if(is_object($this->getDocument()) && strlen($this->getDocument()->getName()) > 0){
				return($path.$this->getDocument()->getName());
			}
			return('');
		}
		
		
		public function getClassStatus(){
			switch($this->getStatus()){
				case 1:
					return('open');
				case 2:
					return('analysis');
				default:
					return('cancel');
			}
		}
		public function getLabelStatus(){
			switch($this->getStatus()){
				case 1:
					return('Conta bancária aprovada');
				case 2:
					return('Conta bancária em análise');
				default:
					return('Não há conta bancária válida aceita');
			}
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'user'=>				is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'bankTypeAccount'=>		is_object($this->getBankTypeAccount()) ? $this->getBankTypeAccount()->getDataJSON() : NULL,
					'bankBrand'=>			is_object($this->getBankBrand()) ? $this->getBankBrand()->getDataJSON() : NULL,
					'agency'=>				$this->getAgency(),
					'number'=>				$this->getNumber(),
					'digit'=>				$this->getDigit(),
					'operation'=>			$this->getOperation(),
					'document'=>			is_object($this->getDocument()) ? 'http://www.vuup.com.br/file/user/'.$this->getDocument()->getName() : NULL,
					'status'=>				$this->getStatus(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>