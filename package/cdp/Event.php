<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Common.php');
	require_once(__PATH__.'/package/cdp/Image.php');
	require_once(__PATH__.'/package/cdp/Phone.php');
	require_once(__PATH__.'/package/cdp/Address.php');
	require_once(__PATH__.'/package/cdp/Video.php');
	require_once(__PATH__.'/package/cdp/Tag.php');
	require_once(__PATH__.'/package/cdp/TicketDay.php');
	require_once(__PATH__.'/package/cdp/EventCategory.php');
	require_once(__PATH__.'/package/cdp/TicketParcel.php');
	require_once(__PATH__.'/package/cdp/Favorite.php');
	
	
	class Event extends Common {
		private $user;
		private $statusBankAccount;
		private $urlSufix;
		private $category;
		private $phone;
		private $address;
		private $description;
		private $ticketTypeCharge;
		private $ticketEmailSend;
		private $ticketParcels;
		private $ticketTypeTaxes;
		private $showUserConfirmed;
		private $imgBanner;
		private $imgBackground;
		private $video;
		private $tagsArray;
		private $ticketsDayArray;
		private $ticketsDaySupportArray;
		private $isFavorite;
		private $photosArray;
		private $numberTicketSold;
		private $numberComment;
		private $numberView;
		private $numberFavorite;
		private $amountInside;
		private $search;
		private $usersConfirmedArray;
		
		
		public function __construct($id=0, $name='', $status=0, $time=0, $user=NULL, $statusBankAccount=0, $urlSufix='', $category=NULL, $phone=NULL, $address=NULL, $description='', $ticketTypeCharge=0, $ticketEmailSend=0, $ticketParcels=NULL, $ticketTypeTaxes=0, $showUserConfirmed=0, $imgBanner=NULL, $imgBackground=NULL, $video=NULL, $tagsArray=array(), $ticketsDayArray=array(), $ticketsDaySupportArray=array(), $isFavorite=0, $photosArray=array(), $numberTicketSold=0, $numberComment=0, $numberView=0, $numberFavorite=0, $amountInside=0){
			parent::__construct($id, $name, NULL, $status, $time);
			$this->user = $user;
			$this->statusBankAccount = $statusBankAccount;
			$this->urlSufix = $urlSufix;
			$this->category = $category;
			$this->phone = $phone;
			$this->address = $address;
			$this->description = $description;
			$this->ticketTypeCharge = $ticketTypeCharge;
			$this->ticketEmailSend = $ticketEmailSend;
			$this->ticketParcels = $ticketParcels;
			$this->ticketTypeTaxes = $ticketTypeTaxes;
			$this->showUserConfirmed = $showUserConfirmed;
			$this->imgBanner = $imgBanner;
			$this->imgBackground = $imgBackground;
			$this->video = $video;
			$this->tagsArray = $tagsArray;
			$this->ticketsDayArray = $ticketsDayArray;
			$this->ticketsDaySupportArray = $ticketsDaySupportArray;
			$this->isFavorite = $isFavorite;
			$this->photosArray = $photosArray;
			$this->numberTicketSold = $numberTicketSold;
			$this->numberComment = $numberComment;
			$this->numberView = $numberView;
			$this->numberFavorite = $numberFavorite;
			$this->amountInside = $amountInside;
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function post($post){
			parent::__construct(0, $post['name'], NULL, $post['status'], time());
			
			$this->setUrlSufixByName($post['name']);
			$this->category = new EventCategory($post['category']);
			
			$this->setPhone(new Phone());
			$this->getPhone()->post($_POST);
			
			$this->setAddress(new Address());
			$this->getAddress()->post($_POST);
			
			$this->description = $post['description'];
			
			$this->ticketTypeCharge = $post['ticket-type-charge'];
			$this->ticketEmailSend = $post['ticket-email-send'];
			$this->ticketParcels = new TicketParcel($post['ticket-parcels']);
			$this->ticketTypeTaxes = $post['ticket-type-taxes'];
			$this->showUserConfirmed = $post['show-user-confirmed'];
			
			$this->setImgBanner(new Image());
			if(!empty($post['img-banner'])){
				$this->setImgBanner(new Image(0, $post['img-banner'], 0, $this->getImgBanner()->getCorrectName($post['img-banner'])));
			}
			else{
				$this->getImgBanner()->setName('');
			}
			
			$this->setImgBackground(new Image());
			if(!empty($post['img-background'])){
				$this->setImgBackground(new Image(0, $post['img-background'], 0, $this->getImgBackground()->getCorrectName($post['img-background'])));
			}
			else{
				$this->getImgBackground()->setName('');
			}
			
			$this->setVideo(new Video($post['video']));
			$this->getVideo()->validateVideo();
			
			$this->setTagsArrayCorrectly($post['tags-array']);
			$this->setTicketsDayArrayCorrectly($post['tickets-array']);
			$this->setPhotosArrayCorrectly($post['photos-array']);
		}
		
		
		public function getUser(){
			return($this->user);
		}
		public function setUser($user){
			$this->user = $user;
		}
		
		
		public function getStatusBankAccount(){
			return($this->statusBankAccount);
		}
		public function setStatusBankAccount($statusBankAccount){
			$this->statusBankAccount = $statusBankAccount;
		}
		
		
		public function getUrlSufix(){
			return($this->urlSufix);
		}
		public function setUrlSufix($urlSufix){
			$this->urlSufix = $urlSufix;
		}
		public function setUrlSufixByName($name){
			$this->urlSufix = strtolower($name);
			$this->urlSufix = preg_replace('/[\s\,\.\*]/', '-', $this->urlSufix);
			$this->urlSufix = preg_replace('/[áàäâãª]/', 'a', $this->urlSufix);
			$this->urlSufix = preg_replace('/[íìïî]/', 'i', $this->urlSufix);
			$this->urlSufix = preg_replace('/[éèêë]/', 'e', $this->urlSufix);
			$this->urlSufix = preg_replace('/[óòöôõº]/', 'o', $this->urlSufix);
			$this->urlSufix = preg_replace('/[úùüû]/', 'u', $this->urlSufix);
			$this->urlSufix = preg_replace('/[ç]/', 'c', $this->urlSufix);
			$this->urlSufix = preg_replace('/[ñ]/', 'n', $this->urlSufix);
			$this->urlSufix = preg_replace('/(-){2,}/', '-', $this->urlSufix);
			$this->urlSufix = preg_replace('/[^a-z0-9\-]/', '', $this->urlSufix);
			$this->urlSufix = preg_replace('/^[\-]/', '', $this->urlSufix);
			$this->urlSufix = preg_replace('/[\-]$/', '', $this->urlSufix);
		}
		public function getFullUrl(){
			return(__PATH_FULL_PREFIX__.$this->getUser()->getUrlSufix().'/'.date('Y-m-d-H-i-s', $this->getTime()).'/'.$this->getUrlSufix());
		}
		
		
		public function getCategory(){
			return($this->category);
		}
		public function setCategory($category){
			$this->category = $category;
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
		
		
		public function getTicketTypeCharge(){
			return($this->ticketTypeCharge);
		}
		public function setTicketTypeCharge($ticketTypeCharge){
			$this->ticketTypeCharge = $ticketTypeCharge;
		}
		
		
		public function getTicketEmailSend(){
			return($this->ticketEmailSend);
		}
		public function setTicketEmailSend($ticketEmailSend){
			$this->ticketEmailSend = $ticketEmailSend;
		}
		
		
		public function getTicketParcels(){
			return($this->ticketParcels);
		}
		public function setTicketParcels($ticketParcels){
			$this->ticketParcels = $ticketParcels;
		}
		
		
		public function getTicketTypeTaxes(){
			return($this->ticketTypeTaxes);
		}
		public function setTicketTypeTaxes($ticketTypeTaxes){
			$this->ticketTypeTaxes = $ticketTypeTaxes;
		}
		
		
		public function getShowUserConfirmed(){
			return($this->showUserConfirmed);
		}
		public function setShowUserConfirmed($showUserConfirmed){
			$this->showUserConfirmed = $showUserConfirmed;
		}
		
		
		public function getImgBanner(){
			return($this->imgBanner);
		}
		public function setImgBanner($imgBanner){
			$this->imgBanner = $imgBanner;
		}
		public function getImgBannerUrl($path=''){
			if(is_object($this->getImgBanner()) && strlen($this->getImgBanner()->getName()) > 0){
				return($path.$this->getImgBanner()->getName());
			}
			return('');
		}
		
		
		public function getImgBackground(){
			return($this->imgBackground);
		}
		public function setImgBackground($imgBackground){
			$this->imgBackground = $imgBackground;
		}
		public function getImgBackgroundUrl($path=''){
			if(is_object($this->getImgBackground()) && strlen($this->getImgBackground()->getName()) > 0){
				return($path.$this->getImgBackground()->getName());
			}
			return('');
		}
		
		
		public function getVideo(){
			return($this->video);
		}
		public function setVideo($video){
			$this->video = $video;
		}
		
		
		public function getTagsArray(){
			return($this->tagsArray);
		}
		public function setTagsArray($tagsArray){
			$this->tagsArray = $tagsArray;
		}
		public function setTagsArrayCorrectly($data){
			$auxArray = explode(__SPMAIN__, $data);
			$this->tagsArray = array();
			
			for($i = 0, $tam = count($auxArray); $i < $tam; $i++){
				$this->tagsArray[] = new Tag(0, $auxArray[$i]);
			}
		}
		public function getTagsArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->tagsArray); $i < $tam; $i++){
				$aux[] = $this->tagsArray[$i]->getDataJSON();
			}
			return($aux);
		}
		public function getTagsPage($withTitle=true, $withHtml=false, $prefix=''){
			$tags .= $withTitle ? $this->getName().',' : '';
			
			for($i = 0, $tam = count($this->tagsArray); $i < $tam; $i++){
				$tag = trim($this->tagsArray[$i]->getName());
				if($withHtml){
					$tags .= '<a href="'.__PATH_FOR_LONG_URL__.'busca?q='.$tag.'" class="more-info">'.$prefix.$tag.'</a>, ';
				}
				else{
					$tags .= $prefix.$tag.', ';
				}
			}
			return(rtrim($tags, ', '));
		}
		
		
		public function getTicketsDayArray(){
			return($this->ticketsDayArray);
		}
		public function setTicketsDayArray($ticketsDayArray){
			$this->ticketsDayArray = $ticketsDayArray;
		}
		public function setTicketsDayArrayCorrectly($data){
			$auxArray = explode(__SPMAIN__, $data);
			$this->ticketsDayArray = array();
			
			for($i = $j = 0, $tam = count($auxArray); $i < $tam; $i++){
				$auxLineArray = explode(__SPDATA__, $auxArray[$i]);
				
				if(is_array($auxLineArray) && count($auxLineArray) > 0){
					$this->ticketsDayArray[$j] = new TicketDay($auxLineArray[0]);
					$this->ticketsDayArray[$j]->setDayBrazilToSql($auxLineArray[1]);
					$this->ticketsDayArray[$j]->setHour(new Hour($auxLineArray[2]));
					$this->ticketsDayArray[$j]->setMinute(new Minute($auxLineArray[3]));
					$this->ticketsDayArray[$j]->setTicketArrayCorrectly($auxLineArray[4]);
					$j++;
				}
			}
		}
		public function setTicketsDayBoughtCorrectly($data){
			$auxArray = explode(__SPMAIN__, $data);
			$this->ticketsDayArray = array();
			
			for($i = 0, $tamI = count($auxArray); $i < $tamI; $i++){
				$auxLineArray = explode(__SPLINE__, $auxArray[$i]);
				$this->ticketsDayArray[$i] = new TicketDay($auxLineArray[0]);
				
				$auxArrayTicket = explode(__SPDATA__, $auxLineArray[1]);
				for($j = 0, $tamJ = count($auxArrayTicket); $j < $tamJ; $j++){
					$auxTicket = explode(__SPSUBDATA__, $auxArrayTicket[$j]);
					$ticket = new Ticket($auxTicket[0]);
					$ticket->setQtdMax(new TicketQtdMax($auxTicket[1]));
					$auxArrayTicket[$j] = $ticket;
				}
				$this->ticketsDayArray[$i]->setTicketArray($auxArrayTicket);
			}
		}
		public function getTicketsDayArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->ticketsDayArray); $i < $tam; $i++){
				$aux[] = $this->ticketsDayArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getTicketsDaySupportArray(){
			return($this->ticketsDaySupportArray);
		}
		public function setTicketsDaySupportArray($ticketsDaySupportArray){
			$this->ticketsDaySupportArray = $ticketsDaySupportArray;
		}
		public function getTicketDayNext(){
			$aux = NULL;
			$time = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
			for($i = 0, $tam = count($this->ticketsDaySupportArray); $i < $tam; $i++){
				if($this->ticketsDaySupportArray[$i]->getDay() >= $time){
					$aux = $this->ticketsDaySupportArray[$i];
					break;
				}
			}
			return($aux);
		}
		public function getTicketsDaySupportArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->ticketsDaySupportArray); $i < $tam; $i++){
				$aux[] = $this->ticketsDaySupportArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getIsFavorite(){
			return($this->isFavorite);
		}
		public function setIsFavorite($isFavorite){
			$this->isFavorite = $isFavorite;
		}
		
		
		public function getPhotosArray(){
			return($this->photosArray);
		}
		public function setPhotosArray($photosArray){
			$this->photosArray = $photosArray;
		}
		public function setPhotosArrayCorrectly($data){
			$auxArray = explode(__SPMAIN__, $data);
			$this->photosArray = array();
			
			for($i = $j = 0, $tam = count($auxArray); $i < $tam; $i++){
				if(!empty($auxArray[$i])){
					$this->photosArray[$j] = new Image();
					$this->photosArray[$j] = new Image(0, $auxArray[$i], 0, $this->photosArray[$i]->getCorrectName($auxArray[$i]));
					$j++;
				}
			}
		}
		public function verifyPhotoInGallery($photo, $auxPhotoArray=NULL){
			$auxArray = is_null($auxPhotoArray) ? $this->photosArray : $auxPhotoArray;
			for($i = 0, $tam = count($auxArray); $i < $tam; $i++){
				if(strcasecmp($auxArray[$i]->getName(), $photo->getName()) == 0){
					return(true);
				}
			}
			return(false);
		}
		public function getPhotosArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->photosArray); $i < $tam; $i++){
				$aux[] = array('photo'=>__PATH_FULL_PREFIX__.'event/photo/normal/'.$this->photosArray[$i]->getName());
			}
			return($aux);
		}
		
		
		public function getNumberTicketSold(){
			return($this->numberTicketSold);
		}
		public function setNumberTicketSold($numberTicketSold){
			$this->numberTicketSold = $numberTicketSold;
		}
		public function getNumberTicketSoldLabel(){
			/*if($this->numberTicketSold == 0){
				return('');
			}
			else */if($this->numberTicketSold == 1){
				$sufix = $this->getTicketTypeCharge() == 1 ? 'obtido' : 'vendido';
				return('<i class="fa fa-ticket"></i> '.$this->numberTicketSold.' ingresso '.$sufix);
			}
			$sufix = $this->getTicketTypeCharge() == 1 ? 'obtidos' : 'vendidos';
			return('<i class="fa fa-ticket"></i> '.$this->numberTicketSold.' ingressos '.$sufix);
		}
		
		
		public function getNumberComment(){
			return($this->numberComment);
		}
		public function setNumberComment($numberComment){
			$this->numberComment = $numberComment;
		}
		public function getNumberCommentLabel(){
			/*if($this->numberComment == 0){
				return('');
			}
			else */if($this->numberComment == 1){
				return('<i class="fa fa-comments"></i> '.$this->numberComment.' comentário');
			}
			return('<i class="fa fa-comments"></i> '.$this->numberComment.' comentários');
		}
		
		
		public function getNumberView(){
			return($this->numberView);
		}
		public function setNumberView($numberView){
			$this->numberView = $numberView;
		}
		public function getNumberViewLabel(){
			/*if($this->numberView == 0){
				return('');
			}
			else */if($this->numberView == 1){
				return('<i class="fa fa-fire"></i> '.$this->numberView.' visualização');
			}
			return('<i class="fa fa-fire"></i> '.$this->numberView.' visualizações');
		}
		
		
		public function getNumberFavorite(){
			return($this->numberFavorite);
		}
		public function setNumberFavorite($numberFavorite){
			$this->numberFavorite = $numberFavorite;
		}
		public function getNumberFavoriteLabel(){
			/*if($this->numberFavorite == 0){
				return('');
			}
			else */if($this->numberFavorite == 1){
				return('<i class="fa fa-star"></i> '.$this->numberFavorite.' favorito');
			}
			return('<i class="fa fa-star"></i> '.$this->numberFavorite.' favoritos');
		}
		
		
		public function getAmountInside(){
			return($this->amountInside);
		}
		public function setAmountInside($amountInside){
			$this->amountInside = $amountInside;
		}
		
		
		public function getSearch(){
			return($this->search);
		}
		public function setSearch($search){
			$this->search = $search;
		}
		
		
		public function getUsersConfirmedArray(){
			return($this->usersConfirmedArray);
		}
		public function setUsersConfirmedArray($usersConfirmedArray){
			$this->usersConfirmedArray = $usersConfirmedArray;
		}
		public function getUsersConfirmedArrayJSON(){
			$aux = array();
			for($i = 0, $tam = count($this->usersConfirmedArray); $i < $tam; $i++){
				$aux[] = $this->usersConfirmedArray[$i]->getDataJSON();
			}
			return($aux);
		}
		
		
		public function getStatusClass(){
			if(is_null($this->getTicketDayNext()) && $this->getStatus() == 1){
				return('finished');
			}
			else if($this->getStatusBankAccount() != 1){
				return('analysis');
			}
			
			switch($this->getStatus()){
				case 1:
					return('open');
				case 2:
					return('analysis');
				default:
					return('close');
			}
		}
		public function getStatusLabel(){
			if(is_null($this->getTicketDayNext()) && $this->getStatus() == 1){
				return('Finalizado');
			}
			else if($this->getStatusBankAccount() != 1){
				return('Sem conta bancária ainda ativa');
			}
			
			switch($this->getStatus()){
				case 1:
					return('Aberto');
				case 2:
					return('Não liberado');
				default:
					return('Desativado');
			}
		}
		
		
		public function setCorrectTimeByPage($timePage){
			$timePage = explode('-', $timePage);
			if(is_array($timePage) && count($timePage) == 6){
				$this->setTime(mktime($timePage[3], $timePage[4], $timePage[5], $timePage[1], $timePage[2], $timePage[0]));
			}
		}
		
		
		public function getFullPrice($isHumanFormated=false, $lessTaxes=false){
			$price = 0;
			for($i = 0, $tamI = count($this->ticketsDayArray); $i < $tamI; $i++){
				$arrayTickets = $this->ticketsDayArray[$i]->getTicketArray();
				for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
					$price += $arrayTickets[$j]->getPrice($this->getTicketTypeTaxes(), true, false, $lessTaxes);
				}
			}
			if($isHumanFormated){
				return('R$ '.str_replace('.', ',', sprintf('%.2f', $price)));
			}
			return($price);
		}
		
		
		public function getTicketMaximum(){
			$aux = 0;
			for($i = 0, $tamI = count($this->ticketsDayArray); $i < $tamI; $i++){
				$arrayTickets = $this->ticketsDayArray[$i]->getTicketArray();
				for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
					$aux += $arrayTickets[$j]->getQtdMaxSell();
				}
			}
			return($aux);
		}
		
		
		public function validateTicketsQtdSell($error){
			for($i = 0, $tamI = count($this->ticketsDayArray); $i < $tamI; $i++){
				$arrayTickets = $this->ticketsDayArray[$i]->getTicketArray();
				for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
					//exit($arrayTickets[$j]->getNumberTicketSold().' - '.$arrayTickets[$j]->getQtdMax()->getItem().' - '.$arrayTickets[$j]->getQtdMaxSell());
					//if(($arrayTickets[$j]->getNumberTicketSold() + $arrayTickets[$j]->getQtdMax()->getItem()) < $arrayTickets[$j]->getQtdMaxSell()){ // TEST
					if(($arrayTickets[$j]->getNumberTicketSold() + $arrayTickets[$j]->getQtdMax()->getItem()) > $arrayTickets[$j]->getQtdMaxSell()){
						$error->setHasError(true);
						$error->setPaymentError(new ErrorBlock('Não há '.$arrayTickets[$j]->getQtdMax()->getItem().' ingressos "'.$arrayTickets[$j]->getName().'" disponíveis.', true));
						return(false);
					}
				}
			}
			return(true);
		}
		
		
		// JSON
			public function getDataJSON(){
				$aux = array(
					'id'=>					$this->getId(),
					'name'=>				$this->getName(),
					'status'=>				$this->getStatus(),
					'timeMilliseconds'=>	$this->getTimeMilliseconds(),
					'user'=>				is_object($this->getUser()) ? $this->getUser()->getDataJSON() : NULL,
					'statusBankAccount'=>	$this->getStatusBankAccount(),
					'urlSufix'=>			$this->getUrlSufix(),
					'category'=>			is_object($this->getCategory()) ? $this->getCategory()->getDataJSON() : NULL,
					'phone'=>				is_object($this->getPhone()) ? $this->getPhone()->getDataJSON() : NULL,
					'address'=>				is_object($this->getAddress()) ? $this->getAddress()->getDataJSON() : NULL,
					'description'=>			$this->getDescription(),
					'ticketTypeCharge'=>	$this->getTicketTypeCharge(),
					'ticketEmailSend'=>		$this->getTicketEmailSend(),
					'ticketParcels'=>		is_object($this->getTicketParcels()) ? $this->getTicketParcels()->getDataJSON() : NULL,
					'ticketTypeTaxes'=>		$this->getTicketTypeTaxes(),
					'showUserConfirmed'=>	$this->getShowUserConfirmed(),
					'imageBanner'=>			is_object($this->getImgBanner()) ? 'http://www.vuup.com.br/img/event/normal/'.$this->getImgBanner()->getName() : NULL,
					'imageBackground'=>		is_object($this->getImgBackground()) ? 'http://www.vuup.com.br/img/event/background/'.$this->getImgBackground()->getName() : NULL,
					'video'=>				is_object($this->getVideo()) ? $this->getVideo()->getDataJSON() : NULL,
					'tags'=>				$this->getTagsArrayJSON(),
					'ticketsDay'=>			$this->getTicketsDayArrayJSON(),
					'ticketsDaySupport'=>	$this->getTicketsDaySupportArrayJSON(),
					'isFavorite'=>			$this->getIsFavorite(),
					'photos'=>				$this->getPhotosArrayJSON(),
					'numberTicketSold'=>	$this->getNumberTicketSold(),
					'numberComment'=>		$this->getNumberComment(),
					'numberView'=>			$this->getNumberView(),
					'numberFavorite'=>		$this->getNumberFavorite(),
					'amountInside'=>		$this->getAmountInside(),
					'usersConfirmed'=>		$this->getUsersConfirmedArrayJSON());
				$aux = $this->setArrayToUtf8($aux);
				return($aux);
			}
	}
?>