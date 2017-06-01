<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/User.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class ForgotPassword extends Common {
		private $user;
		
		
		public function __construct($id=0, $status=0, $time=0, $user=NULL, $hash=''){
			parent::__construct($id, '', NULL, 0, $status, $time);
			$this->user = $user;
			$this->setHash($hash);
			
			// STATUS | 1 = FREE | 2 = ALREADY USED
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, '', NULL, 0, 0, time());
			$this->user = new User();
			$this->user->setEmail($post['email']);
			$this->setHash($this->generateHash());
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function generateHash(){
			$salt = substr(md5(time()), 0, 7);
			$auxHash = sha1($salt . $this->user->getEmail());
			return($auxHash);
		}
		
		
		public function getFullUrl(){
			return(__PATH_FULL_PREFIX__.'esqueceu-a-senha/'.$this->getHash());
		}
	}
?>