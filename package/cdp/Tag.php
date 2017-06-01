<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Tag extends Common {
		private $event;
		private $qtd;
		
		
		public function __construct($id=0, $name='', $event=NULL, $qtd=0){
			parent::__construct($id, $name, NULL, 0, 0);
			$this->event = $event;
			$this->qtd = $qtd;
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
		
		
		public function getQtd(){
			return($this->qtd);
		}
		public function setQtd($qtd){
			$this->qtd = $qtd;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>		$this->getId(),
					'event'=>	is_object($this->getEvent()) ? $this->getEvent()->getDataJSON() : NULL,
					'name'=>	$this->getName(),
					'qtd'=>		$this->getQtd());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>