<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/TicketQtdMax.php');
	require_once(__PATH__.'/package/cdp/TicketValidDays.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	
	
	class Ticket extends Common {
		private $user;
		private $event;
		private $ticketDay;
		private $payment;
		private $qtdMax;
		private $qtdMaxSell;
		private $ticketValidDays;
		private $ticketValidDaysUsed;
		private $price;
		private $numberTicketSold;
		private $code;
		private $idTicketPayment;
		private $userRepass;
		
		
		public function __construct($id=0, $name='', $status=0, $user=NULL, $ticketDay=NULL, $qtdMax=NULL, $qtdMaxSell=0, $ticketValidDays=NULL, $ticketValidDaysUsed=NULL, $price=0, $numberTicketSold=0, $idTicketPayment=0){
			parent::__construct($id, $name, NULL, $status, 0);
			$this->user = $user;
			$this->ticketDay = $ticketDay;
			$this->qtdMax = $qtdMax;
			$this->qtdMaxSell = $qtdMaxSell;
			$this->ticketValidDays = $ticketValidDays;
			$this->ticketValidDaysUsed = $ticketValidDaysUsed;
			$this->price = $price;
			$this->numberTicketSold = $numberTicketSold;
			$this->idTicketPayment = $idTicketPayment;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getEvent(){
			return($this->event);
		}
		public function setEvent($event){
			$this->event = $event;
		}
		
		
		public function getPayment(){
			return($this->payment);
		}
		public function setPayment($payment){
			$this->payment = $payment;
		}
		
		
		public function getTicketDay(){
			return($this->ticketDay);
		}
		public function setTicketDay($ticketDay){
			$this->ticketDay = $ticketDay;
		}
		
		
		public function getQtdMax(){
			return($this->qtdMax);
		}
		public function setQtdMax($qtdMax){
			$this->qtdMax = $qtdMax;
		}
		
		
		public function getQtdMaxSell(){
			return($this->qtdMaxSell);
		}
		public function setQtdMaxSell($qtdMaxSell){
			$this->qtdMaxSell = $qtdMaxSell;
		}
		
		
		public function getTicketValidDays(){
			return($this->ticketValidDays);
		}
		public function setTicketValidDays($ticketValidDays){
			$this->ticketValidDays = $ticketValidDays;
		}
		public function getTicketValidDaysHumanFormat(){
			switch($this->ticketValidDays->getItem()){
				case 1:
					return('Válido por 1 dia de evento');
				default:
					return('Válido por '.$this->ticketValidDays->getItem().' dias de evento');
			}
		}
		
		
		public function getTicketValidDaysUsed(){
			return($this->ticketValidDaysUsed);
		}
		public function setTicketValidDaysUsed($ticketValidDaysUsed){
			$this->ticketValidDaysUsed = $ticketValidDaysUsed;
		}
		
		
		public function getPrice($withTax=2, $withQtdMax=false, $inCents=false, $lessTaxes=false){
			$auxPrice = $this->price;
			$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
			
			if($withTax == 1){
				$auxPrice = $this->price < __MIN_PRICE__ ? $this->price + __TAX_MIN__ : $this->price;
				$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
				$percent = $this->price < __MIN_PRICE__ ? 0 : __TAX_PERCENT__;
				$percent = (float)sprintf('%.2f', $auxPrice * $percent);
				$auxPrice += $percent;
			}
			else if($lessTaxes){
				$auxPrice = $this->price < __MIN_PRICE__ ? $this->price - __TAX_MIN__ : $this->price;
				$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
				$percent = $this->price < __MIN_PRICE__ ? 0 : __TAX_PERCENT__;
				$percent = (float)sprintf('%.2f', $auxPrice * $percent);
				$auxPrice -= $percent;
			}
			$auxPrice = $inCents ? $auxPrice * 100 : $auxPrice;
			return($auxPrice);
		}
		public function getPriceHumanFormated($withTax=2, $withQtdMax=false, $lessTaxes=false, $showTaxes=false){
			$percent = 0;
			$auxPrice = $this->price;
			$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
			
			if($withTax == 1){
				$auxPrice = $this->price < __MIN_PRICE__  && !$showTaxes ? $this->price + __TAX_MIN__ : $this->price;
				$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
				$percent = $this->price < __MIN_PRICE__ ? 0 : __TAX_PERCENT__;
				$percent = (float)sprintf('%.2f', $auxPrice * $percent);
				$auxPrice += !$showTaxes ? $percent : 0;
			}
			else if($lessTaxes){
				$auxPrice = $this->price < __MIN_PRICE__ ? $this->price - __TAX_MIN__ : $this->price;
				$auxPrice = $withQtdMax ? $auxPrice * $this->getQtdMax()->getItem() : $auxPrice;
				$percent = $this->price < __MIN_PRICE__ ? 0 : __TAX_PERCENT__;
				$percent = (float)sprintf('%.2f', $auxPrice * $percent);
				$auxPrice -= $percent;
			}
			
			if($showTaxes && $withTax == 1){
				$aux = 'R$ '.str_replace('.', ',', sprintf('%.2f', $auxPrice)).' + ';
				$aux .= $this->price <= __MIN_PRICE__ ? str_replace('.', ',', sprintf('R$ %.2f', __TAX_MIN__)) : (__TAX_PERCENT__ * 100).'%';
				$aux .= ' vuup';
				return($aux);
			}
			else{
				return('R$ '.str_replace('.', ',', sprintf('%.2f', $auxPrice)));
			}
		}
		public function setPrice($price){
			$this->price = $price;
		}
		
		
		
		public function getTaxHumanFormat(){
			if($this->price < __MIN_PRICE__){
				return('R$ 3,00 por cada ingresso');
			}
			return('10%');
		}
		
		
		public function getNumberTicketSold(){
			return($this->numberTicketSold);
		}
		public function setNumberTicketSold($numberTicketSold){
			$this->numberTicketSold = $numberTicketSold;
		}
		
		
		public function getCode(){
			return($this->code);
		}
		public function setCode($code){
			$this->code = $code;
		}
		public function generateCode(){
			$aux = sha1(microtime(true).''.time().''.rand(0,1000).''.$this->getId().''.round(microtime(true) * 1000));
			return($aux);
		}
		public function getQRCodeImg(){
			return(__PATH_FULL_PREFIX__.'img/ticket/qrcode/300-300/'.$this->code.'.png');
		}
		public function getQRCodePrintUrl(){
			return(__PATH_FULL_PREFIX__.'ingresso/'.$this->code);
		}
		
		
		public function getIdTicketPayment(){
			return($this->idTicketPayment);
		}
		public function setIdTicketPayment($idTicketPayment){
			$this->idTicketPayment = $idTicketPayment;
		}
		public function getIdTicketPaymentAsCode(){
			$aux = substr($this->code, 39, 1);
			$aux .= substr($this->code, 27, 1);
			$aux .= substr($this->code, 17, 1);
			$aux .= substr($this->code, 2, 1);
			$aux .= str_pad($this->idTicketPayment.'', 3, '0', STR_PAD_LEFT);
			return(strtoupper($aux));
			//return('INV'.str_pad($this->idTicketPayment.'', 5, '0', STR_PAD_LEFT));
		}
		public function setIdTicketPaymentCorrectlyByCode($code){
			$this->setIdTicketPayment(ltrim(substr($code, 4), '0'));
			//$this->setIdTicketPayment(ltrim(preg_replace('/[^\d]/', '', $code), '0'));
		}
		public function setCodeTicketPaymentCorrectlyByCode($code){
			$this->code = substr($code, 0, 4);
		}
		
		
		public function getUserRepass(){
			return($this->userRepass);
		}
		public function setUserRepass($userRepass){
			$this->userRepass = $userRepass;
		}
		
		
		public function getStatusForButton(){
			if($this->getStatus() == 1){
				return(0);
			}
			else if($this->getStatus() > 1){
				return(0);
			}
			else if(is_null($this->getEvent()->getTicketDayNext())){
				return(0);
			}
			else if($this->getEvent()->getStatusBankAccount() != 1){
				return(1);
			}
			else if($this->getEvent()->getStatus() == 0){
				return(0);
			}
			else if($this->getStatus() == 0){
				return(1);
			}
		}
		public function getStatusClass(){
			if($this->getStatus() == 1
				|| (is_object($this->getTicketValidDaysUsed()) && $this->getTicketValidDaysUsed()->getItem() >= $this->getTicketValidDays()->getItem())){
				return('finished');
			}
			else if($this->getStatus() > 1){
				return('close');
			}
			else if(is_object($this->getTicketValidDays())
					&& $this->getTicketValidDays()->getItem() == 1
					&& !is_null($this->getTicketDay()) && ($this->getTicketDay()->getDay() + __TIME_EXTRA_FOR_TICKET__) <= time()){
				return('finished');
			}
			else if(is_null($this->getEvent()->getTicketDayNext())){
				return('finished');
			}
			else if($this->getEvent()->getStatusBankAccount() != 1){
				return('analysis');
			}
			else if($this->getEvent()->getStatus() == 0){
				return('close');
			}
			else if($this->getStatus() == 0){
				return('open');
			}
		}
		public function getStatusLabel(){
			if($this->getStatus() == 1
				|| (is_object($this->getTicketValidDaysUsed()) && $this->getTicketValidDaysUsed()->getItem() >= $this->getTicketValidDays()->getItem())){
				return('Já utilizado');
			}
			else if($this->getStatus() > 1){
				return('Ticket desativado pelo vuup');
			}
			else if(is_object($this->getTicketValidDays())
					&& $this->getTicketValidDays()->getItem() == 1
					&& !is_null($this->getTicketDay()) && ($this->getTicketDay()->getDay() + __TIME_EXTRA_FOR_TICKET__) <= time()){
				return('Dia de evento já finalizado');
			}
			else if(is_null($this->getEvent()->getTicketDayNext())){
				return('Evento já finalizado');
			}
			else if($this->getEvent()->getStatusBankAccount() != 1){
				return('Evento em análise pelo vuup');
			}
			else if($this->getEvent()->getStatus() == 0){
				return('Evento desativado');
			}
			else if($this->getStatus() == 0){
				return('Livre');
			}
		}
		
		
		// CACHE METHODS
			public function cacheVerifySameId($arrayTickets){
				$status = false;
				if(is_array($arrayTickets)){
					for($i = 0, $tamI = count($arrayTickets); $i < $tamI; $i++){
						if($this->getId() == $arrayTickets[$i]->getId()){
							$status = true;
							break;
						}
					}
				}
				return($status);
			}
			public function cacheGetQtdMaxSameId($arrayTickets){
				$aux = NULL;
				if(is_array($arrayTickets)){
					for($i = 0, $tamI = count($arrayTickets); $i < $tamI; $i++){
						if($this->getId() == $arrayTickets[$i]->getId()){
							$aux = $arrayTickets[$i]->getQtdMax();
							break;
						}
					}
				}
				return($aux);
			}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>				$this->getId(),
					'user'=>			is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'event'=>			is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'ticketDay'=>		is_object($this->getTicketDay()) ? $this->getTicketDay()->getDataJSON() : NULL,
					'payment'=>			is_object($this->getPayment()) ? $this->getPayment()->getDataJSON() : NULL,
					'status'=>			$this->getStatus(),
					'name'=>			$this->getName(),
					'qtdMax'=>			is_object($this->getQtdMax()) ? $this->getQtdMax()->getDataJSON() : NULL,
					'qtdMaxSell'=>		$this->getQtdMaxSell(),
					'ticketValidDays'=>	is_object($this->getTicketValidDays()) ? $this->getTicketValidDays()->getDataJSON() : NULL,
					'ticketValidDaysUsed'=>	is_object($this->getTicketValidDaysUsed()) ? $this->getTicketValidDaysUsed()->getDataJSON() : NULL,
					'price'=>			$this->getPrice(),
					'numberTicketSold'=>$this->getNumberTicketSold(),
					'idTicketPayment'=>	$this->getIdTicketPayment(),
					'idTicketPaymentAsCode'=>	$this->getIdTicketPaymentAsCode(),
					'code'=>			$this->getCode(),
					'qRCodeImg'=>		$this->getQRCodeImg(),
					'userRepass'=>		is_object($this->getUserRepass()) ? $this->getUserRepass()->getDataJSON() : NULL);
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>