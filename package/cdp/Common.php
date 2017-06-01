<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	require_once(__PATH__.'/package/util/class/Obj.php');
	
	class Common extends Obj {
		private $name;
		private $image;
		private $limit;
		private $isAll;
		private $isLoadMore;
		private $app;
		private $return;
		private $isIndex;
		private $ids;
		private $synchronizedData;
		
		public function __construct($id=0, $name='', $image=NULL, $status=0, $time=0, $limit=0, $isAll=false, $isLoadMore=false, $app=NULL, $return=0, $isIndex=false, $ids='', $synchronizedData=''){
			parent::__construct($id, $status, $time, 0, '');
			$this->name = $name;
			$this->image = $image;
			$this->limit = $limit;
			$this->isAll = $isAll;
			$this->isLoadMore = $isLoadMore;
			$this->app = $app;
			$this->return = $return;
			$this->isIndex = $isIndex;
			$this->ids = $ids;
			$this->synchronizedData = $synchronizedData;
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		
		
		public function getName(){
			return($this->name);
		}
		public function setName($name){
			$this->name = $name;
		}
		
		
		public function getImage(){
			return($this->image);
		}
		public function setImage($image){
			$this->image = $image;
		}
		
		
		public function getLimit(){
			return($this->limit);
		}
		public function setLimit($limit){
			$this->limit = $limit;
		}
		
		
		public function getIsAll(){
			return($this->isAll);
		}
		public function setIsAll($isAll){
			$this->isAll = $isAll;
		}
		
		
		public function getIsLoadMore(){
			return($this->isLoadMore);
		}
		public function setIsLoadMore($isLoadMore){
			$this->isLoadMore = $isLoadMore;
		}
		
		
		public function getApp(){
			return($this->app);
		}
		public function setApp($app){
			$this->app = $app;
		}
		
		
		public function getReturn(){
			return($this->return);
		}
		public function setReturn($return){
			$this->return = $return;
		}
		
		
		public function getIsIndex(){
			return($this->isIndex);
		}
		public function setIsIndex($isIndex){
			$this->isIndex = $isIndex;
		}
		
		
		public function getIds(){
			return($this->ids);
		}
		public function setIds($ids){
			$this->ids = $ids;
		}
		
		
		public function getSynchronizedData(){
			return($this->synchronizedData);
		}
		public function setSynchronizedData($synchronizedData){
			$this->synchronizedData = $synchronizedData;
		}
	}
?>