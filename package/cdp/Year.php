<?php
	class Year {
		private $item;
		private $arrayItem;
		
		
		public function __construct($item=0){
			$this->item = $item;
			$this->arrayItem = array(array(2014, "2014"),
									array(2013, "2013"),
									array(2012, "2012"),
									array(2011, "2011"),
									array(2010, "2010"),
									array(2009, "2009"),
									array(2008, "2008"),
									array(2007, "2007"),
									array(2006, "2006"),
									array(2005, "2005"),
									array(2004, "2004"),
									array(2003, "2003"),
									array(2002, "2002"),
									array(2001, "2001"),
									array(2000, "2000"),
									array(1999, "1999"),
									array(1998, "1998"),
									array(1997, "1997"),
									array(1996, "1996"),
									array(1995, "1995"),
									array(1994, "1994"),
									array(1993, "1993"),
									array(1992, "1992"),
									array(1991, "1991"),
									array(1990, "1990"));
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