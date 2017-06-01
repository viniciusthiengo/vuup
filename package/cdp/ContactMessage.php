<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/User.php');
	require_once(__PATH__.'/package/cdp/Event.php');
	
	
	class ContactMessage extends Common {
		private $userTo;
		private $userFrom;
		private $event;
		private $message;
		
		
		public function __construct($id=0, $time=0, $userTo=NULL, $userFrom=NULL, $event=NULL, $message=''){
			parent::__construct($id, '', NULL, 0, $time);
			$this->userTo = $userTo;
			$this->userFrom = $userFrom;
			$this->event = $event;
			$this->message = $message;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getUserTo(){
			return($this->userTo);
		}
		public function setUserTo($userTo){
			$this->userTo = $userTo;
		}
		
		
		public function getUserFrom(){
			return($this->userFrom);
		}
		public function setUserFrom($userFrom){
			$this->userFrom = $userFrom;
		}
		
		
		public function getEvent(){
			return($this->event);
		}
		public function setEvent($event){
			$this->event = $event;
		}
		
		
		public function getMessage(){
			return($this->message);
		}
		public function setMessage($message){
			$this->message = $message;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'userTo'=>				is_object($this->getUserTo()) ? $this->getUserTo()->getDataJSON() : NULL,
					'userFrom'=>			is_object($this->getUserFrom()) ? $this->getUserFrom()->getDataJSON() : NULL,
					'event'=>				is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'message'=>				$this->getMessage(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>