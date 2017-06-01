<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Obj.php');
	
	
	class File extends Obj {
		private $name;
		private $size;
		private $type;
		
		
		public function __construct($id=0, $name='', $size=0, $type=0, $time=0){
			$this->id = $id;
			$this->setCorrectName($name);
			$this->size = $size;
			$this->type = $type;
			$this->time = $time;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getName(){
			return($this->name);
		}
		public function getNameAsZip(){
			if(!preg_match('/(.zip){1}$/', $this->name)){
				$destination = explode('.', $this->name);
				return($destination[0].'.zip');
			}
			return($this->name);
		}
		public function setName($name){
			$this->name = $name;
		}
		public function setCorrectName($name){
			if(!empty($name)){
				$this->name = explode('/', $name);
				$this->name = str_replace('\")', '', $this->name[count($this->name) - 1]);
			}
		}
		/*public function getCorrectName($nameAux){
			if(!empty($nameAux)){
				$nameAux = explode('/', $nameAux);
				$nameAux = str_replace('\")', '', $nameAux[count($nameAux) - 1]);
			}
			else
				$nameAux = '';
			$nameAux = explode('.', $nameAux);
			return($nameAux[0]);
		}*/
		
		
		public function getSize(){
			return($this->size);
		}
		public function setSize($size){
			$this->size = $size;
		}
		
		
		public function getType(){
			return($this->type);
		}
		public function setType($type){
			$this->type = $type;
		}
		public function setCorrectType($type){
			$this->type = explode('.', $type);
			$this->type = $this->type[count($this->type) - 1];
			$this->type = (preg_match('/^(x-png|x-citrix-png){1}$/', $this->type)) ? 'png' : $this->type;
			$this->type = (preg_match('/^(pjpeg|x-citrix-jpeg){1}$/', $this->type)) ? 'jpeg' : $this->type;
		}
		public function buildCorrectType(){
			$this->type = explode('.', $this->name);
			$this->type = $this->type[count($this->type) - 1];
		}
	}
?>