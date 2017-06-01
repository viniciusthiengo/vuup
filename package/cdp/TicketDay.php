<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/Ticket.php');
	require_once(__PATH__.'/package/cdp/Hour.php');
	require_once(__PATH__.'/package/cdp/Minute.php');
	require_once(__PATH__.'/package/cdp/Payment.php');
	
	
	class TicketDay extends Common {
		private $event;
		private $day;
		private $hour;
		private $minute;
		private $ticketArray;
		private $payment;
		private $idTicketDayPayment;
		
		
		public function __construct($id=0, $event=NULL, $day='', $hour=0, $minute=0, $ticketArray=array(), $payment=NULL, $idTicketDayPayment=0){
			parent::__construct($id, '', NULL, 0, 0);
			$this->event = $event;
			$this->day = $day;
			$this->hour = $hour;
			$this->minute = $minute;
			$this->ticketArray = $ticketArray;
			$this->payment = $payment;
			$this->idTicketDayPayment = $idTicketDayPayment;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getEvent(){
			return($this->event);
		}
		public function setEvent($event){
			$this->event = $event;
		}
		
		
		public function getDay($onlyDayTime=false){
			if($onlyDayTime){
				$time = mktime(0,0,0,date('m', $this->day),date('d', $this->day),date('Y', $this->day));
				return($time);
			}
			return($this->day);
		}
		public function getDayMilliseconds($onlyDayTime=false){
			return($this->day * 1000 + 1);
		}
		public function setDay($day){
			$this->day = $day;
		}
		public function setDayBrazilToSql($day){
			$this->day = explode('/', $day);
			$this->day = $this->day[2].'-'.$this->day[1].'-'.$this->day[0];
		}
		public function getDayPage($withNumber=true){
			$weekDay = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb');
			
			if($withNumber){
				return($weekDay[date('w', $this->day)].', '.date('d\/m', $this->day));
			}
			return($weekDay[date('w', $this->day)]);
		}
		public function getDateSql(){
			return($this->getDay().' '.$this->getHour()->getLabelItem().':'.$this->getMinute()->getLabelItem().':00');
		}
		public function getDateSqlInt(){
			$aux = $this->getDateSql();
			$aux = explode(' ', $aux);
			$aux[0] = explode('-', $aux[0]);
			$aux[1] = explode(':', $aux[1]);
			$aux = mktime($aux[1][0], $aux[1][1], $aux[1][2], $aux[0][1], $aux[0][2], $aux[0][0]);
			return($aux);
		}
		public function getDaySeccondsToBrazilDate(){
			return(date('d\/m\/Y', $this->day));
		}
		public function getTimeSeccondsToBrazilDate(){
			return(date('H\hi', $this->day));
		}
		
		
		public function getHour(){
			return($this->hour);
		}
		public function setHour($hour){
			$this->hour = $hour;
		}
		
		
		public function getMinute(){
			return($this->minute);
		}
		public function setMinute($minute){
			$this->minute = $minute;
		}
		
		
		public function getTicketArray(){
			return($this->ticketArray);
		}
		public function setTicketArray($ticketArray){
			$this->ticketArray = $ticketArray;
		}
		public function setTicketArrayCorrectly($data){
			$auxArray = explode(__SPLINE__, $data);
			$this->ticketArray = array();
			
			for($i = $j = 0, $tam = count($auxArray); $i < $tam; $i++){
				$auxLineArray = explode(__SPSUBDATA__, $auxArray[$i]);
				
				if(is_array($auxLineArray) && count($auxLineArray) > 0){
					$this->ticketArray[$j] = new Ticket($auxLineArray[0]);
					$this->ticketArray[$j]->setStatus($auxLineArray[1]);
					$this->ticketArray[$j]->setName($auxLineArray[2]);
					$this->ticketArray[$j]->setQtdMax(new TicketQtdMax($auxLineArray[3]));
					$this->ticketArray[$j]->setQtdMaxSell($auxLineArray[4]);
					$this->ticketArray[$j]->setTicketValidDays(new TicketValidDays($auxLineArray[5]));
					$this->ticketArray[$j]->setPrice($auxLineArray[6]);
					$j++;
				}
			}
		}
		public function getTicketArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->ticketArray); $i < $tam; $i++){
				$aux[] = $this->ticketArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getPayment(){
			return($this->payment);
		}
		public function setPayment($payment){
			$this->payment = $payment;
		}
		
		
		public function getIdTicketDayPayment(){
			return($this->idTicketDayPayment);
		}
		public function setIdTicketDayPayment($idTicketDayPayment){
			$this->idTicketDayPayment = $idTicketDayPayment;
		}
		
		
		// CACHE METHODS
			public function cacheVerifySameId($arrayTicketsDay){
				$status = false;
				if(is_array($arrayTicketsDay)){
					for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
						if($this->getId() == $arrayTicketsDay[$i]->getId()){
							$status = true;
							break;
						}
					}
				}
				return($status);
			}
			public function cacheGetTicketArrayBySameId($arrayTicketsDay){
				$aux = array();
				if(is_array($arrayTicketsDay)){
					for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
						if($this->getId() == $arrayTicketsDay[$i]->getId()){
							$aux = $arrayTicketsDay[$i]->getTicketArray();
							break;
						}
					}
				}
				return($aux);
			}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					//'event'=>				is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'day'=>					$this->getDayMilliseconds(),
					'hour'=>				is_object($this->getHour()) ? $this->getHour()->getDataJSON() : NULL,
					'minute'=>				is_object($this->getMinute()) ? $this->getMinute()->getDataJSON() : NULL,
					'payment'=>				is_object($this->getPayment()) ? $this->getPayment()->getDataJSON() : NULL,
					'idTicketDayPayment'=>	$this->getIdTicketDayPayment(),
					'tickets'=>				$this->getTicketArrayJSON());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>