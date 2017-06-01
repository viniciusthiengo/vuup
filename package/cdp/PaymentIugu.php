<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	
	
	class PaymentIugu extends Common {
		private $payment;
		private $success;
		private $message;
		private $invoiceId;
		private $url;
		private $pdf;
		private $token;
		
		public function __construct($payment=NULL, $success=0, $message='', $invoiceId='', $url='', $pdf='', $token=''){
			$this->payment = $payment;
			$this->success = $success;
			$this->message = $message;
			$this->invoiceId = $invoiceId;
			$this->url = $url;
			$this->pdf = $pdf;
			$this->token = $token;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			$this->success = $post['success'] ? 1 : 0;
			$this->message = $post['message'];
			$this->invoiceId = $post['invoice_id'];
			$this->url = $post['url'];
			$this->pdf = $post['pdf'];
			$this->token = $post['token'];
		}
		
		
		public function getPayment(){
			return($this->payment);
		}
		public function setPayment($payment){
			$this->payment = $payment;
		}
		
		
		public function getSuccess(){
			return($this->success);
		}
		public function setSuccess($success){
			$this->success = $success;
		}
		
		
		public function getMessage(){
			return($this->message);
		}
		public function setMessage($message){
			$this->message = $message;
		}
		
		
		public function getInvoiceId(){
			return($this->invoiceId);
		}
		public function setInvoiceId($invoiceId){
			$this->invoiceId = $invoiceId;
		}
		
		
		public function getUrl(){
			return($this->url);
		}
		public function setUrl($url){
			$this->url = $url;
		}
		
		
		public function getPdf(){
			return($this->pdf);
		}
		public function setPdf($pdf){
			$this->pdf = $pdf;
		}
		
		
		public function getToken(){
			return($this->token);
		}
		public function setToken($token){
			$this->token = $token;
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'payment'=>		is_object($this->getPayment()) ? $this->getPayment()->getDataJSON() : NULL,
					'success'=>		$this->getSuccess(),
					'message'=>		$this->getMessage(),
					'invoiceId'=>	$this->getInvoiceId(),
					'url'=>			$this->getUrl(),
					'pdf'=>			$this->getPdf(),
					'token'=>		$this->getToken());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>