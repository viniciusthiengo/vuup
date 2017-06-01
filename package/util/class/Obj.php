<?php
	class Obj {
		private $id;
		private $status;
		private $time;

		public function __construct($id=0, $status=0, $time=0){
			$this->id = $id;
			$this->status = $status;
			$this->time = $time;
		}
		public function __destruct(){}


		public function getId()
		{
			return $this->id;
		}
		public function setId($id)
		{
			$this->id = $id;
		}


		public function getStatus()
		{
			return $this->status;
		}
		public function setStatus($status)
		{
			$this->status = $status;
		}


		public function getTime()
		{
			return $this->time;
		}
		public function setTime($time)
		{
			$this->time = $time;
		}
		public function getTimeMilliseconds()
		{
			return $this->time * 1000;
		}
		public function getTimeHumanFormat()
		{
			return date('d/m/Y', $this->time);
		}
		public function getTimeHumanFormatWithHour()
		{
			return date('d/m/Y \à\s H:i', $this->time);
		}
		public function getTimeHour()
		{
			return date('H', $this->time);
		}
		public function getTimeMinute()
		{
			return date('i', $this->time);
		}
		
		
		public function setArrayToUtf8($array){
			foreach($array as $key=>$value){
				if(is_array($value)){
					$array[$key] = $this->setArrayToUtf8($value);
				}
				else if(is_string($value) && !$this->detectUTF8($value)){
					$array[$key] = utf8_encode($value);
				}
			}
			return($array);
		}
		
		
		public function detectUTF8($string){
			return preg_match('%(?:
			[\xC2-\xDF][\x80-\xBF]        # non-overlong 2-byte
			|\xE0[\xA0-\xBF][\x80-\xBF]               # excluding overlongs
			|[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}      # straight 3-byte
			|\xED[\x80-\x9F][\x80-\xBF]               # excluding surrogates
			|\xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
			|[\xF1-\xF3][\x80-\xBF]{3}                  # planes 4-15
			|\xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
			)+%xs', $string);
		}
	}
