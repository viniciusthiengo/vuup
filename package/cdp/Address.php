<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/State.php');
	require_once(__PATH__.'/package/cdp/Country.php');
	require_once(__PATH__.'/package/cdp/Map.php');
	
	
	class Address extends Common {
		private $country;
		private $state;
		private $city;
		private $neighborhood;
		private $street;
		private $number;
		private $complement;
		private $cep;
		private $map;
		
		
		public function __construct($country=NULL, $state=NULL, $city='', $neighborhood='', $street='', $number=0, $complement='', $cep='', $map=NULL){
			$this->country = $country;
			$this->state = $state;
			$this->city = $city;
			$this->neighborhood = $neighborhood;
			$this->street = $street;
			$this->number = $number;
			$this->complement = $complement;
			$this->cep = $cep;
			$this->map = $map;
		}
		public function __destruct(){
			// OBJ
		}
		public function __toString(){
			$aux = 'Rua '.$this->street;
			$aux .= ', nº '.$this->number;
			$aux .= ', Bairro '.$this->neighborhood;
			$aux .= ', '.$this->city;
			$aux .= !empty($this->complement) ? ' (complemento: '.$this->complement.')' : '';
			$aux .= ' - '.$this->state->getLabelItem();
			return($aux);
		}
		
		
		public function post($post){
			$this->country = new Country($post['country']);
			$this->state = new State(empty($post['state']) ? 0 : $post['state']);
			$this->city = $post['city'];
			$this->neighborhood = $post['neighborhood'];
			$this->cep = $post['cep'];
			$this->street = $post['street'];
			$this->number = $post['number'];
			$this->complement = $post['complement'];
			$this->setMap(new Map($post['latitude'], $post['longitude']));
		}
		
		
		public function getCountry(){
			return($this->country);
		}
		public function setCountry($country){
			$this->country = $country;
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
		
		
		public function getNeighborhood(){
			return($this->neighborhood);
		}
		public function setNeighborhood($neighborhood){
			$this->neighborhood = $neighborhood;
		}
		
		
		public function getStreet(){
			return($this->street);
		}
		public function setStreet($street){
			$this->street = $street;
		}
		
		
		public function getNumber(){
			return($this->number);
		}
		public function setNumber($number){
			$this->number = $number;
		}
		
		
		public function getComplement(){
			return($this->complement);
		}
		public function setComplement($complement){
			$this->complement = $complement;
		}
		
		
		public function getCep(){
			return($this->cep);
		}
		public function setCep($cep){
			$this->cep = $cep;
		}
		
		
		public function getMap(){
			return($this->map);
		}
		public function setMap($map){
			$this->map = $map;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'country'=>			is_object($this->getCountry()) ? $this->getCountry()->getDataJSON() : NULL,
					'state'=>			is_object($this->getState()) ? $this->getState()->getDataJSON() : NULL,
					'city'=>			$this->getCity(),
					'neighborhood'=>	$this->getNeighborhood(),
					'street'=>			$this->getStreet(),
					'number'=>			$this->getNumber(),
					'complement'=>		$this->getComplement(),
					'cep'=>				$this->getCep(),
					'map'=>				is_object($this->getMap()) ? $this->getMap()->getDataJSON() : NULL);
					
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>