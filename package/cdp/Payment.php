<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/User.php');
	require_once(__PATH__.'/package/cdp/Event.php');
	require_once(__PATH__.'/package/cdp/CardVencMonth.php');
	require_once(__PATH__.'/package/cdp/CardVencYear.php');
	require_once(__PATH__.'/package/cdp/BankBrand.php');
	require_once(__PATH__.'/package/cdp/PaymentIugu.php');
	
	
	class Payment extends Common {
		private $user;
		private $event;
		private $cardBrand;
		private $cardNumber;
		private $cardPersonName;
		private $parcels;
		private $cardVencMonth;
		private $cardVencYear;
		private $cardSafeCode;
		private $fullPrice;
		private $priceToPay;
		private $token;
		private $paymentIugu;
		
		public function __construct($id=0, $status=0, $time=0, $user=NULL, $event=NULL, $cardBrand=NULL, $cardNumber='', $cardPersonName='', $parcels=NULL, $cardVencMonth=NULL, $cardVencYear=NULL, $cardSafeCode='', $fullPrice=0, $priceToPay=0, $token='', $paymentIugu=NULL){
			parent::__construct($id, '', NULL, $status, $time);
			$this->user = $user;
			$this->event = $event;
			$this->cardBrand = $cardBrand;
			$this->cardNumber = $cardNumber;
			$this->cardPersonName = $cardPersonName;
			$this->parcels = $parcels;
			$this->cardVencMonth = $cardVencMonth;
			$this->cardVencYear = $cardVencYear;
			$this->cardSafeCode = $cardSafeCode;
			$this->fullPrice = $fullPrice;
			$this->priceToPay = $priceToPay;
			$this->token = $token;
			$this->paymentIugu = $paymentIugu;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, '', NULL, 0, time());
			
			$this->cardBrand = new BankBrand($post['card-brand']);
			$this->cardNumber = $post['card-number'];
			$this->cardPersonName = $post['card-person-name'];
			$this->parcels = new TicketParcel($post['parcels']);
			$this->cardVencMonth = new CardVencMonth($post['card-venc-month']);
			$this->cardVencYear = new CardVencYear($post['card-venc-year']);
			$this->cardSafeCode = $post['card-safe-code'];
			$this->fullPrice = $post['full-price'];
			$this->token = $post['token'];
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
		
		
		public function getCardBrand(){
			return($this->cardBrand);
		}
		public function setCardBrand($cardBrand){
			$this->cardBrand = $cardBrand;
		}
		
		
		public function getCardNumber(){
			return($this->cardNumber);
		}
		public function setCardNumber($cardNumber){
			$this->cardNumber = $cardNumber;
		}
		
		
		public function getCardPersonName(){
			return($this->cardPersonName);
		}
		public function setCardPersonName($cardPersonName){
			$this->cardPersonName = $cardPersonName;
		}
		
		
		public function getParcels(){
			return($this->parcels);
		}
		public function setParcels($parcels){
			$this->parcels = $parcels;
		}
		
		
		public function getCardVencMonth(){
			return($this->cardVencMonth);
		}
		public function setCardVencMonth($cardVencMonth){
			$this->cardVencMonth = $cardVencMonth;
		}
		
		
		public function getCardVencYear(){
			return($this->cardVencYear);
		}
		public function setCardVencYear($cardVencYear){
			$this->cardVencYear = $cardVencYear;
		}
		
		
		public function getCardSafeCode(){
			return($this->cardSafeCode);
		}
		public function setCardSafeCode($cardSafeCode){
			$this->cardSafeCode = $cardSafeCode;
		}
		
		
		public function getFullPrice(){
			return($this->fullPrice);
		}
		public function setFullPrice($fullPrice){
			$this->fullPrice = $fullPrice;
		}
		public function getFullPriceEventParcel($inCents=false, $applyTaxes=false){
			// SAVE REAL TAX
				//$auxTax = $this->getEvent()->getTicketTypeTaxes();
			
			// GET PRICE WITHOUT TAXES
				//$this->getEvent()->setTicketTypeTaxes(0);
				if($applyTaxes && $this->getEvent()->getTicketTypeTaxes() == 1){
					$auxTax = $this->getEvent()->getTicketTypeTaxes();
					$this->getEvent()->setTicketTypeTaxes(0);
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice();
					$this->getEvent()->setTicketTypeTaxes($auxTax);
				}
				else if($applyTaxes && $this->getEvent()->getTicketTypeTaxes() == 2){
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice(false, true);
				}
				else{
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice();
				}
				//$auxPriceWithoutTax = $this->getEvent()->getFullPrice(false, $lessTaxes);
				
			// BACKUP TAX
				//$this->getEvent()->setTicketTypeTaxes($auxTax);
				//$auxTax = $auxTax == 1 ? 0.1 : 0;
			
			//$auxPriceEvent = $auxPriceWithoutTax; //$this->getEvent()->getFullPrice();
			//exit(($auxTax + ($this->getParcels()->getItem(2) / 100)).' - '.$this->getParcels()->getItem(2));
			//$auxPriceEvent = $auxPriceWithoutTax + ($auxPriceWithoutTax * ($auxTax + ($this->getParcels()->getItem(2) / 100)));
			//$auxPriceEvent = $auxPriceWithoutTax + ($auxPriceWithoutTax * $auxTax);
			$auxPriceEvent = $auxPriceWithoutTax;
			
			if($inCents){
				return($auxPriceEvent * 100);
			}
			else{
				return(sprintf('%.2f', $auxPriceEvent));
			}
		}
		
		
		public function getPriceToPay(){
			return($this->priceToPay);
		}
		public function setPriceToPay($priceToPay){
			$this->priceToPay = $priceToPay;
		}
		public function getFullPriceToPayEventParcel($inCents=false, $applyTaxes=false){
			// SAVE REAL TAX
				//$auxTax = $this->getEvent()->getTicketTypeTaxes();
			
			// GET PRICE WITHOUT TAXES
				if($applyTaxes && $this->getEvent()->getTicketTypeTaxes() == 1){
					$auxTax = $this->getEvent()->getTicketTypeTaxes();
					$this->getEvent()->setTicketTypeTaxes(0);
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice();
					$this->getEvent()->setTicketTypeTaxes($auxTax);
				}
				else if($applyTaxes && $this->getEvent()->getTicketTypeTaxes() == 2){
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice(false, true);
				}
				else{
					$auxPriceWithoutTax = $this->getEvent()->getFullPrice();
				}
				
			// BACKUP TAX
				//$this->getEvent()->setTicketTypeTaxes($auxTax);
				//$auxTax = 0.1;
			
			//$auxPriceWithoutTax += ($this->getEvent()->getTicketTypeTaxes() == 1 ? 0 : -1)*($auxPriceWithoutTax * ($auxTax + ($this->getParcels()->getItem(3) / 100)));
			//$auxPriceEvent = $auxPriceWithoutTax + (($this->getEvent()->getTicketTypeTaxes() == 1 ? 0 : -1)*($auxPriceWithoutTax * $auxTax));
			$auxPriceEvent = $auxPriceWithoutTax;
			
			if($inCents){
				return($auxPriceEvent * 100);
			}
			else{
				return(sprintf('%.2f', $auxPriceEvent));
			}
		}
		
		
		public function getToken(){
			return($this->token);
		}
		public function setToken($token){
			$this->token = $token;
		}
		
		
		public function getPaymentIugu(){
			return($this->paymentIugu);
		}
		public function setPaymentIugu($paymentIugu){
			$this->paymentIugu = $paymentIugu;
		}
		
		
		public function getTotalTickets(){
			$numberTickestSold = 0;
			$arrayTicketsDay = $this->getEvent()->getTicketsDayArray();
			for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
				$arrayTicket = $arrayTicketsDay[$i]->getTicketArray();
				
				for($j = 0, $tamJ = count($arrayTicket); $j < $tamJ; $j++){
					$numberTickestSold += $arrayTicket[$j]->getQtdMax()->getItem();
				}
			}
			return($numberTickestSold);
		}
		
		
		public function getDescriptionBuy(){
			$numberTickestSold = $this->getTotalTickets();
			$desc = $numberTickestSold == 1 ? $numberTickestSold.' ingresso comprado' : $numberTickestSold.' ingressos comprados';
			$desc .= ' em vuup.com.br para o evento '.$this->getEvent()->getName();
			return($desc);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'user'=>				is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'event'=>				is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'cardBrand'=>			is_object($this->getCardBrand()) ? $this->getCardBrand()->getDataJSON() : NULL,
					'cardNumber'=>			$this->getCardNumber(),
					'cardPersonName'=>		$this->getCardPersonName(),
					'parcels'=>				is_object($this->getParcels()) ? $this->getParcels()->getDataJSON() : NULL,
					'cardVencMonth'=>		is_object($this->getCardVencMonth()) ? $this->getCardVencMonth()->getDataJSON() : NULL,
					'cardVencYear'=>		is_object($this->getCardVencYear()) ? $this->getCardVencYear()->getDataJSON() : NULL,
					'cardSafeCode'=>		$this->getCardSafeCode(),
					'fullPrice'=>			$this->getFullPrice(),
					'priceToPay'=>			$this->getPriceToPay(),
					'token'=>				$this->getToken(),
					'paymentIugu'=>			is_object($this->getPaymentIugu()) ? $this->getPaymentIugu()->getDataJSON() : NULL,
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>