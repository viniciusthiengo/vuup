<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/util/class/Obj.php');
	
	class Email extends Obj {
		private $user;
		private $email;
		private $name;
		private $subject;
		private $content;
		private $count;
		private $arrayUsersEmailWasSent;
		
		
		public function __construct($id=0, $user=NULL, $email='', $name='', $subject='', $content='', $count=0, $status=1, $time=0, $arrayUsersEmailWasSent=array()){
			$this->id = $id;
			$this->user = $user;
			$this->email = $email;
			$this->name = $name;
			$this->subject = $subject;
			$this->content = $content;
			$this->count = $count;
			$this->status = $status;
			$this->time = $time;
			$this->arrayUsersEmailWasSent = $arrayUsersEmailWasSent;
		}
		public function __destruct(){
			// DESTRUCT OBJ
		}
		public function post($post){
			$this->name = $post['name'];
			$this->subject = $post['subject'];
			$this->content = $post['content'];
			$this->time = time();
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getEmail(){
			return($this->email);
		}
		public function setEmail($email){
			$this->email = $email;
		}
		
		
		public function getName(){
			return($this->name);
		}
		public function setName($name){
			$this->name = $name;
		}
		
		
		public function getSubject(){
			return($this->subject);
		}
		public function setSubject($subject){
			$this->subject = $subject;
		}
		
		
		public function getContent(){
			return($this->content);
		}
		public function setContent($content){
			$this->content = $content;
		}
		
		
		public function getCount(){
			return($this->count);
		}
		public function setCount($count){
			$this->count = $count;
		}
		
		
		public function getArrayUsersEmailWasSent(){
			return($this->arrayUsersEmailWasSent);
		}
		public function setArrayUsersEmailWasSent($arrayUsersEmailWasSent){
			$this->arrayUsersEmailWasSent = $arrayUsersEmailWasSent;
		}
	}
?>