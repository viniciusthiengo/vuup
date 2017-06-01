<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class EventCategory extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0){
			$this->item = $item;
			$this->arrayItem = array(array(0, '*Categoria'),
									array(1, 'Congresso, seminário'),
									array(2, 'Culinária'),
									array(3, 'Curso, workshop'),
									array(4, 'Encontro, networking'),
									array(5, 'Esportivo'),
									array(6, 'Feira, exposição'),
									array(7, 'Religioso'),
									array(8, 'Show, música e festa'));
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