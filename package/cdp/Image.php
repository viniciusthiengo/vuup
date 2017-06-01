<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Obj.php');
	
	
	class Image extends Obj {
		private $name;
		private $type;
		private $binary;
		private $isUpdate;
		private $side;
		private $realName;
		private $size;
		private $inContent;
		private $legend;
		
		
		public function __construct($id=0, $name='', $type='', $binary='', $isUpdate=0, $side=0, $realName='', $size=0, $inContent=0, $legend=0, $time=0){
			$this->id = $id;
			$this->setCorrectName($name);
			$this->type = $type;
			$this->binary = $binary;
			$this->isUpdate = $isUpdate;
			$this->side = $side;
			$this->realName = $realName;
			$this->size = $size;
			$this->inContent = $inContent;
			$this->legend = $legend;
			$this->time = $time;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getName(){
			return($this->name);
		}
		public function setName($name){
			$this->name = $name;
		}
		public function setCorrectName($name){
			if(!empty($name) && stripos($name, '/') !== false){
				$this->name = explode('/', $name);
				$this->name = str_replace('\")', '', $this->name[count($this->name) - 1]);
			}
			//else
				//$this->name = 'default-01.png';
		}
		public function getCorrectName($nameAux){
			if(!empty($nameAux)){
				$nameAux = explode('/', $nameAux);
				$nameAux = str_replace('\")', '', $nameAux[count($nameAux) - 1]);
			}
			else
				$nameAux = '';
			$nameAux = preg_replace('/(.jpg|.JPG|.jpeg|.JPEG|.gif|.GIF|.png|.PNG){1}$/', '', $nameAux);
			return($nameAux);
		}
		
		
		public function getIsUpdate(){
			return($this->isUpdate);
		}
		public function setIsUpdate($isUpdate){
			$this->isUpdate = $isUpdate;
		}
		
		
		public function getSide(){
			return($this->side);
		}
		public function setSide($side){
			$this->side = $side;
		}
		public function getSideClass(){
			switch($this->side){
				case 1:
					return('img-left');
				case 2:
					return('img-right');
				default:
					return('img-center');
			}
		}
		
		
		public function getRealName(){
			return($this->realName);
		}
		public function setRealName($realName){
			$this->realName = $realName;
		}
		
		
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
			$this->type = explode('/', $type);
			$this->type = $this->type[1];
			$this->type = (preg_match('/^(x-png|x-citrix-png){1}$/', $this->type)) ? 'png' : $this->type;
			$this->type = (preg_match('/^(pjpeg|x-citrix-jpeg){1}$/', $this->type)) ? 'jpeg' : $this->type;
		}
		public function buildCorrectType(){
			$this->type = explode('.', $this->name);
			$this->type = $this->type[count($this->type) - 1];
		}
		public function getMime(){
			$mime = explode('.', $this->name);
			return($mime[count($mime) - 1]);
		}
		public function getQuality(){
			if(preg_match('/^(PNG|png){1}$/', $this->type)){
				return(7);
			}
			else if(preg_match('/^(jpeg|JPEG|jpg|JPG){1}$/', $this->type)){
				return(70);
			}
			else {
				return(0);
			}
		}
		
		
		public function getInContent(){
			return($this->inContent);
		}
		public function setInContent($inContent){
			$this->inContent = $inContent;
		}
		public function getInContentHtml(){
			$html = '';
			if(!empty($this->inContent)){
				$width = getimagesize('img/post/400-400/'.$this->realName);
				$width = $width[0].'px';
				$class = $this->getSideClass();
				$html = <<<HTML
					<span class="$class" style="width: $width">
						<img src="img/post/400-400/$this->realName" />
						<span class="legenda">
							$this->legend
						</span>
					</span>
HTML;
			}
			return($html);
		}
		
		
		public function getLegend(){
			return($this->legend);
		}
		public function setLegend($legend){
			$this->legend = $legend;
		}
		
		
		public function generateNameImage(){
			$this->name = sha1(microtime().'_'.time()).'.'.$this->type;
		}
		
		
		public function generateBynaryImage($path){
			$binary = base64_decode($this->binary);
			header('Content-Type: bitmap; charset=utf-8');
			$file = fopen($path.'/'.$this->name, 'wb');
			fwrite($file, $binary);
			fclose($file);
		}
	}
?>