<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/RemoveAccountReason.php');
	require_once(__PATH__.'/package/cdp/User.php');
	
	
	class RemoveAccount extends Common {
		private $user;
		private $removeAccountReason;
		private $reason;
		
		
		public function __construct($id=0, $time=0, $user=NULL, $removeAccountReason=NULL, $reason=''){
			parent::__construct($id, '', NULL, 0, 0, $time);
			$this->user = $user;
			$this->removeAccountReason = $removeAccountReason;
			$this->reason = $reason;
		}
		public function __destruct(){
			// OBJ
		}
		public function post($post=array()){
			$this->user = new User($post['id-user']);
			$this->user->setCurrentPassword($post['password']);
			$this->removeAccountReason = new RemoveAccountReason($post['reason']);
			$this->reason = $post['reason-text'];
			$this->time = time();
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getRemoveAccountReason(){
			return($this->removeAccountReason);
		}
		public function setRemoveAccountReason($removeAccountReason){
			$this->removeAccountReason = $removeAccountReason;
		}
		
		
		public function getReason(){
			return($this->reason);
		}
		public function setReason($reason){
			$this->reason = $reason;
		}
	}
?>