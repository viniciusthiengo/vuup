<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class TicketParcel extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=1, $taxes=0){
			$this->item = $item;
			
			/*if($taxes == 0){
				$this->arrayItem = array(array(1, '1x (10% de taxa)', 10, 10),
										array(2, '2x (13% de taxa)', 13, 13),
										array(3, '3x (14% de taxa)', 14, 14));
			}
			else*/// if($taxes == 1){
				$this->arrayItem = array(array(1, '1x', 0, 0),
										array(2, '2x (+ 3.5%)', 3.5, 3),
										array(3, '3x (+ 4.5%)', 4.5, 4));
			/*}
			else if($taxes == 2){
				$this->arrayItem = array(array(1, '1x', 0, 0),
										array(2, '2x', 0, 3),
										array(3, '3x', 0, 4));
			}
									/*array(4, '4x (12% taxa)', 12),
									array(5, '5x (13% taxa)', 13),
									array(6, '6x (15% taxa)', 15),
									array(7, '7x (16% taxa)', 16),
									array(8, '8x (17% taxa)', 17),
									array(9, '9x (18% taxa)', 18),
									array(10, '10x (20% taxa)', 20),
									array(11, '11x (21% taxa)', 21),
									array(12, '12x (22% taxa)', 22));*/
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function getItem($position=0){
			if(empty($position)){
				return($this->item);
			}
			else{
				return($this->arrayItem[$this->item][$position]);
			}
		}
		public function setItem($item){
			$this->item = $item;
		}
		public function getPosItem($position){
			return($this->arrayItem[$this->item][$position]);
		}
		public function getLabelItem(){
			return($this->arrayItem[$this->item][1]);
		}
		public function getLabelCodeItem(){
			$aux = explode(' ', $this->arrayItem[$this->item][1]);
			$aux = trim($aux[count($aux) - 1], '()');
			return($aux);
		}
		
		
		public function getArrayItem(){
			return($this->arrayItem);
		}
		public function setArrayItem($arrayItem){
			$this->arrayItem = $arrayItem;
		}
		public function setArrayItemByTaxe($taxes=0){
			/*if($taxes == 0){
				$this->arrayItem = array(array(1, '1x (10% de taxa)', 10, 10), array(2, '2x (13% de taxa)', 13, 13), array(3, '3x (14% de taxa)', 14, 14));
			}
			else if($taxes == 1){
				$this->arrayItem = array(array(1, '1x', 0, 0), array(2, '2x (+ 3%)', 3, 3), array(3, '3x (+ 4%)', 4, 4));
			}
			else{*/
				$this->arrayItem = array(array(1, '1x', 0, 0), array(2, '2x', 0, 3), array(3, '3x', 0, 4));
			//}
		}
		public function setArrayItemPosition($position, $value){
			$this->arrayItem[$position][1] = $value;
		}
		public function getOptions($maxTam=0){
			$options = '';
			$maxTam = empty($maxTam) ? count($this->arrayItem) : $maxTam;
			for($i = 0, $tam = $maxTam; $i < $tam; $i++){
				$value = $this->arrayItem[$i][0];
				if($this->arrayItem[$i][0] == $this->item){
					$options .= '<option value="'.$value.'" data="'.$this->arrayItem[$i][2].'" selected="selected">'.$this->arrayItem[$i][1].'</option>';
				}
				else{
					$options .= '<option value="'.$value.'" data="'.$this->arrayItem[$i][2].'">'.$this->arrayItem[$i][1].'</option>';
				}
			}
			return($options);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'item'=>	$this->getItem(),
					'label'=>	$this->getLabelItem());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>