<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Hour extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0, $isMobile=false){
			$this->item = $item;
			$this->arrayItem = array(array(0, '00'),
									array(1, '01'),
									array(2, '02'),
									array(3, '03'),
									array(4, '04'),
									array(5, '05'),
									array(6, '06'),
									array(7, '07'),
									array(8, '08'),
									array(9, '09'),
									array(10, '10'),
									array(11, '11'),
									array(12, '12'),
									array(13, '13'),
									array(14, '14'),
									array(15, '15'),
									array(16, '16'),
									array(17, '17'),
									array(18, '18'),
									array(19, '19'),
									array(20, '20'),
									array(21, '21'),
									array(22, '22'),
									array(23, '23'));
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
		public function getOptions(){
			$options = '';
			for($i = 0, $tam = count($this->arrayItem); $i < $tam; $i++){
				$value = $this->arrayItem[$i][0];
				if($this->arrayItem[$i][0] == $this->item){
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