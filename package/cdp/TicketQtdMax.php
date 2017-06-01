<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class TicketQtdMax extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0, $isMobile=false){
			$this->item = $item;
			$this->arrayItem = array(array(0, '*Máximo compra'),
									array(1, '1'),
									array(2, '2'),
									array(3, '3'),
									array(4, '4'),
									array(5, '5'));
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function getItem(){
			return($this->item);
		}
		public function setItem($item){
			$this->item = $item;
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
		public function getOptions($markSelected=true, $untillMax=0, $startCount=0){
			$options = '';
			$maxTam = $untillMax > 0 ? $untillMax+1 : count($this->arrayItem);
			for($i = $startCount, $tam = $maxTam; $i < $tam; $i++){
				$value = $this->arrayItem[$i][0];
				if($this->arrayItem[$i][0] == $this->item && $markSelected){
					$options .= '<option value="'.$value.'" selected="selected">'.$this->arrayItem[$i][1].'</option>';
				}
				else{
					$options .= '<option value="'.$value.'">'.$this->arrayItem[$i][1].'</option>';
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