<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Event.php');
	require_once(__PATH__.'/package/cdp/TicketDay.php');
	require_once(__PATH__.'/package/cdp/Ticket.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class ReportData extends Common {
		const REPORT_DATA_TICKETS_SOLD = 1;
		//const REPORT_DATA_COMMENTS = 2;
		const REPORT_DATA_VIEWS = 3;
		//const REPORT_DATA_FAVORITES = 4;
	
		private $event;
		private $ticketDay;
		private $ticket;
		private $type;
		private $data;
		private $name;
		private $amount;
		private $year;
		private $month;
		private $day;
		
		
		public function __construct($id=0, $name='', $time=0, $event=NULL, $ticketDay=NULL, $ticket=NULL, $type=0, $data=array(), $amount=0, $year=0, $month=0, $day=0){
			parent::__construct($id, $name, NULL, 0, $time);
			$this->event = $event;
			$this->ticketDay = $ticketDay;
			$this->ticket = $ticket;
			$this->type = $type;
			$this->data = $data;
			$this->amount = $amount;
			$this->year = $year;
			$this->month = $month;
			$this->day = $day;
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
		
		
		public function getTicketDay(){
			return($this->ticketDay);
		}
		public function setTicketDay($ticketDay){
			$this->ticketDay = $ticketDay;
		}
		
		
		public function getTicket(){
			return($this->ticket);
		}
		public function setTicket($ticket){
			$this->ticket = $ticket;
		}
		
		
		public function getType(){
			return($this->type);
		}
		public function setType($type){
			$this->type = $type;
		}
		
		
		public function getData(){
			return($this->data);
		}
		public function setData($data){
			$this->data = $data;
		}
		
		
		public function getAmount(){
			return($this->amount);
		}
		public function setAmount($amount){
			$this->amount = $amount;
		}
		
		
		public function getYear(){
			$this->year = (int)($this->year == 0 ? date('Y', $this->getTime()) : $this->year);
			return($this->year);
		}
		public function setYear($year){
			$this->year = $year;
		}
		
		
		public function getMonth(){
			$this->month = (int)($this->month == 0 ? date('m', $this->getTime()) : $this->month);
			return($this->month);
		}
		public function setMonth($month){
			$this->month = $month;
		}
		public function getMonthLabel($month=0){
			if(empty($month)){
				$this->month = (int)($this->month == 0 ? date('m', $this->getTime()) : $this->month);
				$auxMonth = $this->month;
			}
			else{
				$auxMonth = $month;
			}
			
			switch($auxMonth){
				case 1: return('Janeiro');
				case 2: return('Fevereiro');
				case 3: return('Março');
				case 4: return('Abril');
				case 5: return('Maio');
				case 6: return('Junho');
				case 7: return('Julho');
				case 8: return('Agosto');
				case 9: return('Setembro');
				case 10: return('Outubro');
				case 11: return('Novembro');
				default: return('Dezembro');
			}
		}
		
		
		public function getDay(){
			return($this->day);
		}
		public function setDay($day){
			$this->day = $day;
		}
		
		
		public function getInitMonthTime(){
			$aux = mktime(0,0,0,date('m',$this->getTime()),1,date('Y',$this->getTime()));
			return($aux);
		}
		public function getFinishMonthTime(){
			$year = (int)date('Y',$this->getTime());
			$month = (int)date('m',$this->getTime());
			$day = (int)date('d',$this->getTime());
			
			//if(mktime(0,0,0,date('m',$this->getTime()),1,date('Y',$this->getTime())) < mktime(0,0,0,date('m'),1,date('Y'))){
				if(preg_match('/^(1|3|5|7|8|10|12){1}$/', $month)){
					$day = 31;
				}
				else if(preg_match('/^(4|6|9|11){1}$/', $month)){
					$day = 30;
				}
				else{
					if($year % 4 == 0 && $year % 100 == 0 && $year % 400 == 0){ // LEAP YEAR
						$day = 29;
					}
					else{
						$day = 28;
					}
				}
			//}
			$aux = mktime(0,0,0,date('m',$this->getTime()),$day,date('Y',$this->getTime()));
			return($aux);
		}
		
		
		public function generateSelectDataByEvent(){
			$nowYear = (int)date('Y');
			$nowMonth = (int)date('m');
			
			$createEventYear = (int)date('Y', $this->event->getTime());
			$createEventMonth = (int)date('m', $this->event->getTime());
		
			$html_Select = '';
			for($i = $createEventYear, $tamI = $nowYear; $i <= $tamI; $i++){
				$j = $i == $nowYear ? $createEventMonth : 1;
				for($tamJ = 12; $j <= $tamJ; $j++){
					if($i == $nowYear && $j == $nowMonth){
						$html_Select .= '<option value="'.$j.'__SPMAIN__'.$i.'" selected="selected">'.$this->getMonthLabel($j).' - '.$i.'</option>';
						goto finish;
					}
					else{
						$html_Select .= '<option value="'.$j.'__SPMAIN__'.$i.'">'.$this->getMonthLabel($j).' - '.$i.'</option>';
					}
				}
				if(false){
					finish:
						break;
				}
			}
			return($html_Select);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'event'=>				is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'ticketDay'=>			is_object($this->getTicketDay()) ? $this->getTicketDay()->getDataJSON() : NULL,
					'ticket'=>				is_object($this->getTicket()) ? $this->getTicket()->getDataJSON() : NULL,
					'id'=>					$this->getId(),
					'name'=>				$this->getName(),
					'type'=>				$this->getType(),
					'data'=>				$this->getData(),
					'amount'=>				$this->getAmount(),
					'year'=>				$this->getYear(),
					'month'=>				$this->getMonth(),
					'day'=>					$this->getDay(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>