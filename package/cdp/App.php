<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class App extends Common {
		private $versionCodeOwnerApp;
		private $versionCodeWalkerApp;
		private $termsOfUse;
		private $pointsWalkerInWalk;
		private $pointsDogOwnerInWalk;
		private $pointsOrderAccepted;
		private $pointsReview;
		private $pointsCancelContract;
		private $pointsUserInvited;
		
		
		public function __construct($id=0, $versionCodeOwnerApp=0, $versionCodeWalkerApp=0, $termsOfUse='', $pointsWalkerInWalk=0, $pointsDogOwnerInWalk=0, $pointsOrderAccepted=0, $pointsReview=0, $pointsCancelContract=0, $pointsUserInvited=0){
			parent::__construct($id);
			$this->versionCodeOwnerApp = $versionCodeOwnerApp;
			$this->versionCodeWalkerApp = $versionCodeWalkerApp;
			$this->termsOfUse = $termsOfUse;
			$this->pointsWalkerInWalk = $pointsWalkerInWalk;
			$this->pointsDogOwnerInWalk = $pointsDogOwnerInWalk;
			$this->pointsOrderAccepted = $pointsOrderAccepted;
			$this->pointsReview = $pointsReview;
			$this->pointsCancelContract = $pointsCancelContract;
			$this->pointsUserInvited = $pointsUserInvited;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct();
			$this->versionCodeOwnerApp = $post['version-code-owner'];
			$this->versionCodeWalkerApp = $post['version-code-walker'];
			$this->termsOfUse = $post['terms-use'];
			$this->pointsWalkerInWalk = $post['points-walker-in-walk'];
			$this->pointsDogOwnerInWalk = $post['points-dog-owner-in-walk'];
			$this->pointsOrderAccepted = $post['points-order-accepted'];
			$this->pointsReview = $post['points-review'];
			$this->pointsCancelContract = $post['points-cancel-contract'];
			$this->pointsUserInvited = $post['points-user-invited'];
		}
		
		
		public function getVersionCodeOwnerApp(){
			return($this->versionCodeOwnerApp);
		}
		public function setVersionCodeOwnerApp($versionCodeOwnerApp){
			$this->versionCodeOwnerApp = $versionCodeOwnerApp;
		}
		
		
		public function getVersionCodeWalkerApp(){
			return($this->versionCodeWalkerApp);
		}
		public function setVersionCodeWalkerApp($versionCodeWalkerApp){
			$this->versionCodeWalkerApp = $versionCodeWalkerApp;
		}
		
		
		public function getTermsOfUse(){
			return($this->termsOfUse);
		}
		public function setTermsOfUse($termsOfUse){
			$this->termsOfUse = $termsOfUse;
		}
		public function getTermsOfUseAsHtml(){
			$aux = str_replace("\n", "<br />", $this->termsOfUse);
			return($aux);
		}
		
		
		public function getPointsWalkerInWalk(){
			return($this->pointsWalkerInWalk);
		}
		public function setPointsWalkerInWalk($pointsWalkerInWalk){
			$this->pointsWalkerInWalk = $pointsWalkerInWalk;
		}
		
		
		public function getPointsDogOwnerInWalk(){
			return($this->pointsDogOwnerInWalk);
		}
		public function setPointsDogOwnerInWalk($pointsDogOwnerInWalk){
			$this->pointsDogOwnerInWalk = $pointsDogOwnerInWalk;
		}
		
		
		public function getPointsOrderAccepted(){
			return($this->pointsOrderAccepted);
		}
		public function setPointsOrderAccepted($pointsOrderAccepted){
			$this->pointsOrderAccepted = $pointsOrderAccepted;
		}
		
		
		public function getPointsReview(){
			return($this->pointsReview);
		}
		public function setPointsReview($pointsReview){
			$this->pointsReview = $pointsReview;
		}
		
		
		public function getPointsCancelContract(){
			return($this->pointsCancelContract);
		}
		public function setPointsCancelContract($pointsCancelContract){
			$this->pointsCancelContract = $pointsCancelContract;
		}
		
		
		public function getPointsUserInvited(){
			return($this->pointsUserInvited);
		}
		public function setPointsUserInvited($pointsUserInvited){
			$this->pointsUserInvited = $pointsUserInvited;
		}
	}
?>