<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/File.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	require_once(__PATH__.'/package/util/wideimage/lib/WideImage.php');
	require_once(__PATH__.'/package/util/class/Util.php');
	
	
	class AplFile {
		private $dao;
		private $wideImg;
		
		public function __construct(){
			// INITIALIAZE
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function setTmpMainImg($image){
			if(preg_match('/^(gif|jpeg|jpg|png){1}$/', $image->getType())){
				if($image->getSize() <= 10000000){
					$prefix = session_id();
					
					// REMOVE
						/*$dir = dir('../../img/temp/');  
						while($file = $dir->read()){
							if(stripos($file, $prefix) !== false){
								@unlink('../../img/temp/'.$file);
								break;
							}
						}
						$dir->close();*/
					
					// LOAD, SET SIZE, CHANGE NAME and SAVE
						$auxName = $prefix.md5(microtime()).'.'.$image->getType();
						$this->setImgToDirectory($image->getName(), '../../img/temp/'.$auxName);
						
					$auxReturn = 'img/temp/'.$auxName;
				}
				else
					$auxReturn = 3;
			}
			else
				$auxReturn = 2;
			return($auxReturn);
		}
		public function setImgToDirectory($oldPathName, $newPathName, $width=1000, $height=1000, $fill='inside', $down='down', $destroyOld=false, $quality=0){
			if(!empty($oldPathName)
				&& stripos($oldPathName, 'default-01') === false
				&& @($this->wideImg = WideImage::load($oldPathName))){
				
				$this->wideImg = $this->wideImg->resize($width, $height, $fill, $down);
				if(empty($quality)){
					$this->wideImg->saveToFile($newPathName);
				}
				else{
					$this->wideImg->saveToFile($newPathName, $quality);
				}
				$this->wideImg->destroy();
				
				// DESTROY OLD IMAGE
				if($destroyOld){
					@unlink($oldPathName);
				}
			}
		}
		
		
		public function setTmpFileDownload($fileObj, $directory='img/temp/'){
			if(strlen(trim($fileObj->getName())) > 0){
			//if($fileObj->getSize() <= 10000000){
				$prefix = session_id();
				// REMOVE
					/*$dir = dir('../../img/temp/');  
					while($file = $dir->read()){
						if(stripos($file, $prefix) !== false){
							@unlink('../../img/temp/'.$file);
							break;
						}
					}
					$dir->close();*/
				
				// LOAD, SET SIZE, CHANGE NAME and SAVE
					$auxName = $prefix.md5(microtime()).'.'.$fileObj->getType();
					$this->setFileToDirectory($fileObj->getName(), '../../'.$directory.$auxName);
					
					if(!preg_match('/(.zip){1}$/', $auxName)){
						$destination = explode('.', $auxName);
						Util::saveAsZip('../../'.$directory, $destination[0].'.zip', array($auxName));
						$auxName = $destination[0].'.zip';
					}
					
				//$auxReturn = $directory.$auxName;
				$auxReturn = 'img/system/bg/doc-ok-150x150.png|'.$directory.$auxName;
			}
			else
				$auxReturn = 3;
			return($auxReturn);
		}
		public function setFileToDirectory($oldPathName, $newPathName, $destroyOld=false){
			if(!empty($oldPathName)){
				//exit($oldPathName.'-----------'.$newPathName);
				//exit(move_uploaded_file($oldPathName, $newPathName) ? '1':'2');
				copy($oldPathName, $newPathName);
				
				// DESTROY OLD IMAGE
				if($destroyOld){
					@unlink($oldPathName);
				}
			}
		}
		
		
		public function deleteImg($image){
			if(stripos($image->getName(), 'default-01') === false){
				@unlink('../../img/post/100-100/'.$image->getName());
				@unlink('../../img/post/150-150/'.$image->getName());
				@unlink('../../img/post/400-400/'.$image->getName());
			}
		}
	}
?>