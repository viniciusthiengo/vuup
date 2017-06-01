<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Favorite extends Common {
		private $event;
		private $user;
		
		
		public function __construct($id=0, $time=0, $event=NULL, $user=NULL){
			parent::__construct($id, '', NULL, 0, $time);
			$this->event = $event;
			$this->user = $user;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, '', NULL, 1, time());
		}
		
		
		public function getEvent(){
			return($this->event);
		}
		public function setEvent($event){
			$this->event = $event;
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'event'=>				is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'user'=>				is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>