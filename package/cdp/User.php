<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	require_once(__PATH__.'/package/cdp/Follow.php');
	require_once(__PATH__.'/package/cdp/Search.php');
	require_once(__PATH__.'/package/cdp/Address.php');
	require_once(__PATH__.'/package/cdp/Phone.php');
	
	
	class User extends Common {
		private $urlSufix;
		private $email;
		private $password;
		private $currentPassword;
		private $cpf;
		private $phone;
		private $address;
		private $idFacebook;
		private $description;
		private $bank;
		private $numberEvent;
		private $isFollow;
		private $numberFollowing;
		private $numberFollower;
		private $followingsArray;
		private $followersArray;
		private $ticket;
		private $search;
		private $ip;

		
		public function __construct($id=0, $name='', $image=NULL, $status=0, $time=0, $urlSufix='', $email='', $password='', $cpf='', $phone=NULL, $address=NULL, $idFacebook='', $description='', $bank=NULL, $numberEvent=0, $numberFollowing=0, $numberFollower=0, $isFollow=0, $followingsArray=array(), $followersArray=array(), $ticket=NULL){
			parent::__construct($id, $name, $image, $status, $time);
			$this->urlSufix = $urlSufix;
			$this->email = $email;
			$this->password = $password;
			$this->cpf = $cpf;
			$this->phone = $phone;
			$this->address = $address;
			$this->idFacebook = $idFacebook;
			$this->description = $description;
			$this->bank = $bank;
			$this->numberEvent = $numberEvent;
			$this->numberFollowing = $numberFollowing;
			$this->numberFollower = $numberFollower;
			$this->isFollow = $isFollow;
			$this->followingsArray = $followingsArray;
			$this->followersArray = $followersArray;
			$this->ticket = $ticket;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, $post['name'], NULL, 2, time());
			$this->urlSufix = $post['url-sufix'];
			$this->email = strtolower($post['email']);
			$this->password = $post['password'];
			
			$this->setImage(new Image());
			if(!empty($post['img-file'])){
				$this->setImage(new Image(0, $post['img-file'], 0, $this->getImage()->getCorrectName($post['img-file'])));
			}
			else{
				$this->getImage()->setName('');
			}
			
			$this->cpf = $post['cpf'];
			$this->setPhone(new Phone($post['phone-code'], $post['phone-number']));
			
			$this->setAddress(new Address());
			$this->getAddress()->post($post);
			
			$this->idFacebook = empty($post['id-facebook']) ? '' : $post['id-facebook'];
			$this->description = empty($post['description']) ? '' : $post['description'];
			
			
			// HACK CODE FOR BANK
				$this->setBank(new Bank());
				$this->getBank()->post($post);
				$this->getBank()->setStatus(1);
				$this->getBank()->setTime(time());
		}
		
		
		public function getUrlSufix(){
			return($this->urlSufix);
		}
		public function setUrlSufix($urlSufix){
			$this->urlSufix = $urlSufix;
		}
		
		
		public function getEmail(){
			return($this->email);
		}
		public function setEmail($email){
			$this->email = strtolower($email);
		}
		public function makeHashEmail(){
			$hash = sha1(strrev($this->email).md5(strrev($this->email)).strlen($this->email).$this->email);
			return($hash);
		}
		
		
		public function getPassword(){
			return($this->password);
		}
		public function setPassword($password){
			$this->password = $password;
		}
		public function getPasswordWithHash() {
			$salt = substr(md5(time()), 0, 7);
			$hash = $salt . sha1($salt . $this->password);
			return($hash);
		}
		
		
		public function getCurrentPassword(){
			return($this->currentPassword);
		}
		public function setCurrentPassword($currentPassword){
			$this->currentPassword = $currentPassword;
		}
		public function getCurrentPasswordWithHash() {
			$salt = substr(md5(time()), 0, 7);
			$hash = $salt . sha1($salt . $this->currentPassword);
			return($hash);
		}
		
		
		public function getCpf(){
			return($this->cpf);
		}
		public function setCpf($cpf){
			$this->cpf = $cpf;
		}
		
		
		public function getPhone(){
			return($this->phone);
		}
		public function setPhone($phone){
			$this->phone = $phone;
		}
		
		
		public function getAddress(){
			return($this->address);
		}
		public function setAddress($address){
			$this->address = $address;
		}
		
		
		public function getIdFacebook(){
			return($this->idFacebook);
		}
		public function setIdFacebook($idFacebook){
			$this->idFacebook = $idFacebook;
		}
		
		
		public function getDescription(){
			return($this->description);
		}
		public function setDescription($description){
			$this->description = $description;
		}
		public function getDescriptionPage(){
			$aux = explode("\n", $this->description);
			for($i = 0, $tam = count($aux); $i < $tam; $i++){
				$aux[$i] = '<p> '.$aux[$i].' </p>';
			}
			
			$rexProtocol = '(https?://)?';
			$rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
			$rexPort     = '(:[0-9]{1,5})?';
			$rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
			$rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
			$rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
			$aux = implode('', $aux);
			$aux = preg_replace_callback("&\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))&", 'User::callbackRegex', $aux);
			return($aux);
		}
		static function callbackRegex($match){
			// Prepend http:// if no protocol specified
			$completeUrl = $match[1] ? $match[0] : "http://{$match[0]}";
			return('<a class="description-link" href="'.$completeUrl.'" target="_blank">'.$match[2].$match[3].$match[4].'</a>');
		}
		
		
		public function getBank(){
			return($this->bank);
		}
		public function setBank($bank){
			$this->bank = $bank;
		}
		
		
		public function getNumberEvent(){
			return($this->numberEvent);
		}
		public function setNumberEvent($numberEvent){
			$this->numberEvent = $numberEvent;
		}
		public function getNumberEventLabel(){
			if($this->numberEvent == 1){
				return('<i class="fa fa-beer"></i> '.$this->numberEvent.' evento');
			}
			return('<i class="fa fa-beer"></i> '.$this->numberEvent.' eventos');
		}
		
		
		public function getNumberFollowing(){
			return($this->numberFollowing);
		}
		public function setNumberFollowing($numberFollowing){
			$this->numberFollowing = $numberFollowing;
		}
		public function getNumberFollowingLabel(){
			if($this->numberFollowing == 1){
				return('<i class="fa fa-certificate"></i> seguindo '.$this->numberFollowing);
			}
			return('<i class="fa fa-certificate"></i> seguindo '.$this->numberFollowing);
		}
		
		
		public function getNumberFollower(){
			return($this->numberFollower);
		}
		public function setNumberFollower($numberFollower){
			$this->numberFollower = $numberFollower;
		}
		public function getNumberFollowerLabel(){
			if($this->numberFollower == 1){
				return('<i class="fa fa-check-circle"></i> '.$this->numberFollower.' seguidor');
			}
			return('<i class="fa fa-check-circle"></i> '.$this->numberFollower.' seguidores');
		}
		
		
		public function getIsFollow(){
			return($this->isFollow);
		}
		public function setIsFollow($isFollow){
			$this->isFollow = $isFollow;
		}
		
		
		public function getFollowingsArray(){
			return($this->followingsArray);
		}
		public function setFollowingsArray($followingsArray){
			$this->followingsArray = $followingsArray;
		}
		public function getFollowingsArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->followingsArray); $i < $tam; $i++){
				$aux[] = $this->followingsArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getFollowersArray(){
			return($this->followersArray);
		}
		public function setFollowersArray($followersArray){
			$this->followersArray = $followersArray;
		}
		public function getFollowersArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->followersArray); $i < $tam; $i++){
				$aux[] = $this->followersArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getTicket(){
			return($this->ticket);
		}
		public function setTicket($ticket){
			$this->ticket = $ticket;
		}
		
		
		public function getSearch(){
			return($this->search);
		}
		public function setSearch($search){
			$this->search = $search;
		}


		public function getIp()
		{
			return $this->ip;
		}
		public function setIp($ip)
		{
			$this->ip = $ip;
		}
		public function getIpCorrectly()
		{
			$client  = @$_SERVER['HTTP_CLIENT_IP'];
			$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
			$remote  = $_SERVER['REMOTE_ADDR'];

			if(filter_var($client, FILTER_VALIDATE_IP)) {
				$ip = $client;
			}
			else if(filter_var($forward, FILTER_VALIDATE_IP)) {
				$ip = $forward;
			}
			else {
				$ip = $remote;
			}

			return $ip;
		}
		
		
		public function getImageUrl($path=''){
			if(is_object($this->getImage()) && strlen($this->getImage()->getName()) > 0){
				return($path.$this->getImage()->getName());
			}
			return($path.'default.gif');
		}
		
		
		public function getImageCloseStatus(){
			if(is_object($this->getImage()) && strlen($this->getImage()->getName()) > 0){
				return('style="display: block;"');
			}
			return('');
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'name'=>				$this->getName(),
					'urlSufix'=>			$this->getUrlSufix(),
					'email'=>				$this->getEmail(),
					'cpf'=>					$this->getCpf(),
					'phone'=>				is_object($this->getPhone()) ? $this->getPhone()->getDataJSON() : NULL,
					'address'=>				is_object($this->getAddress()) ? $this->getAddress()->getDataJSON() : NULL,
					'idFacebook'=>			$this->getIdFacebook(),
					'description'=>			$this->getDescription(),
					'image'=>				is_object($this->getImage()) ? $this->getImageUrl(__PATH_FULL_PREFIX__.'img/user/normal/') : NULL,
					'bank'=>				is_object($this->getBank()) ? $this->getBank()->getDataJSON() : NULL,
					'status'=>				$this->getStatus(),
					'numberEvent'=>			$this->getNumberEvent(),
					'numberFollowing'=>		$this->getNumberFollowing(),
					'numberFollower'=>		$this->getNumberFollower(),
					'isFollow'=>			$this->getIsFollow(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds(),
					'followings'=>			$this->getFollowingsArrayJSON(),
					'followers'=>			$this->getFollowersArrayJSON(),
					'ticket'=>				is_object($this->getTicket()) ? $this->getTicket()->getDataJSON() : NULL);
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
