<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class Follow extends Common {
		private $userFollowing;
		private $userFollower;
		private $user;
		private $isFollowing;
		private $isFollower;
		
		
		public function __construct($id=0, $time=0, $userFollowing=NULL, $userFollower=NULL, $user=NULL, $isFollowing=false, $isFollower=false){
			parent::__construct($id, '', NULL, 0, $time);
			$this->userFollowing = $userFollowing;
			$this->userFollower = $userFollower;
			$this->user = $user;
			$this->isFollowing = $isFollowing;
			$this->isFollower = $isFollower;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function getUserFollowing(){
			return($this->userFollowing);
		}
		public function setUserFollowing($userFollowing){
			$this->userFollowing = $userFollowing;
		}
		
		
		public function getUserFollower(){
			return($this->userFollower);
		}
		public function setUserFollower($userFollower){
			$this->userFollower = $userFollower;
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getIsFollowing(){
			return($this->isFollowing);
		}
		public function setIsFollowing($isFollowing){
			$this->isFollowing = $isFollowing;
		}
		
		
		public function getIsFollower(){
			return($this->isFollower);
		}
		public function setIsFollower($isFollower){
			$this->isFollower = $isFollower;
		}
		
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'userFollowing'=>		is_object($this->getUserFollowing()) ? $this->getUserFollowing()->getDataJSON() : NULL,
					'userFollower'=>		is_object($this->getUserFollower()) ? $this->getUserFollower()->getDataJSON() : NULL,
					'user'=>				is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'isFollowing'=>			$this->getIsFollowing(),
					'isFollower'=>			$this->getIsFollower(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>