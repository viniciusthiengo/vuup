<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class State extends Common {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0, $isMobile=false){
			$this->item = $item;
			$this->arrayItem = array(array(0, '*Estado'),
									array(1, 'Acre (AC)'),
									array(2, 'Alagoas (AL)'),
									array(3, 'Amapá (AP)'),
									array(4, 'Amazonas (AM)'),
									array(5, 'Bahia (BA)'),
									array(6, 'Ceará (CE)'),
									array(7, 'Distrito Federal (DF)'),
									array(8, 'Espírito Santo (ES)'),
									array(9, 'Goiás (GO)'),
									array(10, 'Maranhão (MA)'),
									array(11, 'Mato Grosso (MT)'),
									array(12, 'Mato Grosso do Sul (MS)'),
									array(13, 'Minas Gerais (MG)'),
									array(14, 'Pará (PA)'),
									array(15, 'Paraíba (PB)'),
									array(16, 'Paraná (PR)'),
									array(17, 'Pernambuco (PE)'),
									array(18, 'Piauí (PI)'),
									array(19, 'Rio de Janeiro (RJ)'),
									array(20, 'Rio Grande do Norte (RN)'),
									array(21, 'Rio Grande do Sul (RS)'),
									array(22, 'Rondônia (RO)'),
									array(23, 'Roraima (RR)'),
									array(24, 'Santa Catarina (SC)'),
									array(25, 'São Paulo (SP)'),
									array(26, 'Sergipe (SE)'),
									array(27, 'Tocantins (TO)'));
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
		public function setArrayItemPosition($position, $value){
			$this->arrayItem[$position][1] = $value;
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