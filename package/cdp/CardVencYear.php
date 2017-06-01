<?php
	class CardVencYear extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0){
			$this->item = $item;
			$this->arrayItem = array(array(2014, "2014"),
									array(2015, "2015"),
									array(2016, "2016"),
									array(2017, "2017"),
									array(2018, "2018"),
									array(2019, "2019"),
									array(2020, "2020"),
									array(2021, "2021"),
									array(2022, "2022"),
									array(2023, "2023"),
									array(2024, "2024"),
									array(2025, "2025"),
									array(2026, "2026"));
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