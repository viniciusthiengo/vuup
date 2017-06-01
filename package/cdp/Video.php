<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Video extends Common {
		private $url;
		
		
		public function __construct($url=''){
			$this->url = $url;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			$this->url = $post['url'];
		}
		
		
		public function getUrl(){
			return($this->url);
		}
		public function setUrl($url){
			$this->url = $url;
		}
		public function getUrlIframe($width=420, $height=315){
			return('<iframe width="'.$width.'" height="'.$height.'" src="'.$this->url.'" frameborder="0" allowfullscreen></iframe>');
		}
		
		
		public function validateVideo(){
			$video = $this->url;
			
			if(!preg_match('/^(http:\/\/|https:\/\/)/', $video) && stripos($video, 'http://') === false && stripos($video, 'https://') === false)
				$video = 'http://'.$video;
			$video = explode('"', $video);
			$video = str_replace('https://', 'http://', $video);
			
			foreach($video as $key=>$value){
				if(strpos($value, 'src=') !== false || count($video) == 1){
					$key++;
					$video[$key] = str_replace('\\', '', $video[$key]); // hack code to clean string
					
					// YOUTUBE
					if((preg_match('/^http:\/\/www\.youtube\.com\/embed\//', $video[$key]) || preg_match('/^\/\/www\.youtube\.com\/embed\//', $video[$key])))// && @fopen($video[$key], 'r'))
						$video = $video[$key];
					else if(preg_match('/(watch\?v=){1}/', $value) && @fopen($value, 'r')){
						$value = explode('=', $value);
						if(@fopen('http://www.youtube.com/embed/'.$value[1], 'r'))
							$video = 'http://www.youtube.com/embed/'.$value[1];
					}
					else if(preg_match('/(\/youtu\.be\/){1}/', $value) && @fopen($value, 'r')){
						$value = explode('/', $value);
						if(@fopen('http://www.youtube.com/embed/'.$value[count($value) - 1], 'r'))
							$video = 'http://www.youtube.com/embed/'.$value[count($value) - 1];
					}
					
					// VIMEO
					else if((preg_match('/^http:\/\/player\.vimeo\.com\/video\//', $video[$key]) || preg_match('/^player\.vimeo\.com\/video\//', $video[$key]) || preg_match('/^\/\/player\.vimeo\.com\/video\//', $video[$key])))// && @fopen($video[$key], 'r'))
						$video = $video[$key];
					else if(preg_match('/(vimeo\.com\/){1}/', $value) && @fopen($value, 'r')){
						$value = explode('/', $value);
						if(@fopen('http://player.vimeo.com/video/'.$value[count($value) - 1], 'r'))
							$video = 'http://player.vimeo.com/video/'.$value[count($value) - 1];
					}
					
					// DAILY MOTION
					else if((preg_match('/^http:\/\/www\.dailymotion\.com\/embed\/video\//', $video[$key]) || preg_match('/^www\.dailymotion\.com\/embed\/video\//', $video[$key])) && @fopen($video[$key], 'r'))
						$video = $video[$key];
					else if(preg_match('/(dailymotion\.com\/video\/){1}/', $value) && @fopen($value, 'r')){
						$value = explode('/', $value);
						$value = explode('_', $value[count($value) - 1]);
						if(@fopen('http://www.dailymotion.com/embed/video/'.$value[0], 'r'))
							$video = 'http://www.dailymotion.com/embed/video/'.$value[0];
					}
					
					// METACAFE
					else if((preg_match('/^http:\/\/www\.metacafe\.com\/(fplayer|embed){1}\//', $video[$key]) || preg_match('/^www\.metacafe\.com\/(fplayer|embed){1}\//', $video[$key])) && @fopen($video[$key], 'r'))
						$video = $video[$key];
					else if(preg_match('/(metacafe\.com\/watch\/){1}/', $value) && @fopen($value, 'r')){
						$value = preg_replace('/(http:\/\/|https:\/\/)/', '', $value);
						$value = explode('/', $value);
						$value = $value[2] . '/' . $value[3] . '.swf';
						if(@fopen('http://www.metacafe.com/fplayer/' . $value, 'r'))
							$video = 'http://www.metacafe.com/fplayer/'.$value;
					}
					
					// SLIDE SHARE
					else if((preg_match('/^http:\/\/www\.slideshare\.net\/slideshow\/embed_code\//', $video[$key]) || preg_match('/^www\.slideshare\.net\/slideshow\/embed_code\//', $video[$key])) && @fopen($video[$key], 'r'))
						$video = $video[$key];
					
					// BLIP TV
					else if(preg_match('/^http:\/\/blip\.tv\/play\//', $video[$key]) && @fopen($video[$key], 'r') || preg_match('/^blip\.tv\/play\//', $video[$key]) && @fopen($video[$key], 'r'))
						$video = $video[$key];
					
					break;
				}
			}
			
			$this->url = $video;
			if(is_array($video))
				$this->url = '';
			return($video);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'url'=>	$this->getUrl());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>