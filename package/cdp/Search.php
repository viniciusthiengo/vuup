<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/User.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Search extends Common {
		private $obj;
		private $text;
		private $eventCategory;
		private $state;
		private $city;
		private $startDate;
		private $endDate;
		private $onlyPayment;
		private $onlyFree;
		private $arrayData;
		
		
		public function __construct($text='', $eventCategory=NULL, $state=NULL, $city='', $startDate=0, $endDate=0, $onlyPayment=0, $onlyFree=0){
			$this->text = $text;
			$this->eventCategory = $eventCategory;
			$this->state = $state;
			$this->city = $city;
			$this->startDate = $startDate;
			$this->endDate = $endDate;
			$this->onlyPayment = $onlyPayment;
			$this->onlyFree = $onlyFree;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			$this->text = empty($post['q']) ? $this->text : urldecode($post['q']);
			$this->eventCategory = empty($post['ec']) ? $this->eventCategory : new EventCategory($post['ec']);
			$this->state = empty($post['s']) ? $this->state : new State($post['s']);
			$this->city = empty($post['c']) ? $this->city : urldecode($post['c']);
			empty($post['sd']) ? $this->startDate : $this->setStartDateCorrectly(urldecode($post['sd']));
			empty($post['ed']) ? $this->endDate : $this->setEndDateCorrectly(urldecode($post['ed']));
			$this->onlyFree = empty($post['of']) ? $this->onlyFree : $post['of'];
			$this->onlyPayment = empty($post['op']) ? $this->onlyPayment : $post['op'];
		}
		
		
		public function setDataCorrectlyFromUrl($fullUrl){
			$aux = explode('?', $fullUrl);
			if(!empty($aux[1])){
				$aux = explode('&', $aux[1]);
				
				$arrayData = array();
				for($i = 0, $tam = count($aux); $i < $tam; $i++){
					$aux[$i] = explode('=', $aux[$i]);
					$arrayData[$aux[$i][0]] = $aux[$i][1];
				}
				$this->post($arrayData);
			}
		}
		
		
		public function getObj(){
			return($this->obj);
		}
		public function setObj($obj){
			$this->obj = $obj;
		}
		
		
		public function getText(){
			return($this->text);
		}
		public function setText($text){
			$this->text = $text;
		}
		
		
		public function getEventCategory(){
			return($this->eventCategory);
		}
		public function setEventCategory($eventCategory){
			$this->eventCategory = $eventCategory;
		}
		
		
		public function getState(){
			return($this->state);
		}
		public function setState($state){
			$this->state = $state;
		}
		
		
		public function getCity(){
			return($this->city);
		}
		public function setCity($city){
			$this->city = $city;
		}
		
		
		public function getStartDate(){
			return($this->startDate);
		}
		public function setStartDate($startDate){
			$this->startDate = $startDate;
		}
		public function setStartDateCorrectly($startDate){
			$aux = explode('/', $startDate);
			$this->startDate = mktime(0,0,0,$aux[1],$aux[0],$aux[2]);
		}
		
		
		public function getEndDate(){
			return($this->endDate);
		}
		public function setEndDate($endDate){
			$this->endDate = $endDate;
		}
		public function setEndDateCorrectly($endDate){
			$aux = explode('/', $endDate);
			$this->endDate = mktime(23,59,59,$aux[1],$aux[0],$aux[2]);
		}
		
		
		public function getOnlyPayment(){
			return($this->onlyPayment);
		}
		public function setOnlyPayment($onlyPayment){
			$this->onlyPayment = $onlyPayment;
		}
		
		
		public function getOnlyFree(){
			return($this->onlyFree);
		}
		public function setOnlyFree($onlyFree){
			$this->onlyFree = $onlyFree;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'text'=>				$this->getText(),
					'eventCategory'=>		is_object($this->getEventCategory()) ? $this->getEventCategory()->getDataJSON() : NULL,
					'state'=>				is_object($this->getState()) ? $this->getState()->getDataJSON() : NULL,
					'city'=>				$this->getCity(),
					'startDate'=>			$this->getStartDate(),
					'endDate'=>				$this->getEndDate(),
					'onlyPayment'=>			$this->getOnlyPayment(),
					'onlyFree'=>			$this->getOnlyFree());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>