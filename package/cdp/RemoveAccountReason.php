<?php
	class RemoveAccountReason {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0, $isWalker=false){
			$this->item = $item;
			if(!$isWalker){
				$this->arrayItem = array(array(0, '*Motivo'),
											array(1, 'Não tem passeador em minha região'),
											array(2, 'Não tenho Dog, cadastrei para conhecer'),
											array(3, 'Já tenho um passeador fixo'),
											array(4, 'Sou passeador, cadastrei na APP errada'),
											array(5, 'Outro'));
			}
			else{
				$this->arrayItem = array(array(0, '*Motivo'),
											array(1, 'Não tem clientes em minha região'),
											array(2, 'Cadastrei somente para conhecer'),
											array(3, 'Já tenho uma agenda fixa'),
											array(4, 'Acho que meu lucro vai cair se oferecer meus serviços de passeio aqui'),
											array(5, 'Outro'));
			}
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
	}
?>