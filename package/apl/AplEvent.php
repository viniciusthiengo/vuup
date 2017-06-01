<?php
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/cdp/Report.php');
	require_once(__PATH__.'/package/cdp/Event.php');
	require_once(__PATH__.'/package/cdp/Search.php');
	require_once(__PATH__.'/package/cdp/Parameters.php');
	require_once(__PATH__.'/package/cdp/Payment.php');
	require_once(__PATH__.'/package/apl/AplUser.php');
	require_once(__PATH__.'/package/apl/AplEmail.php');
	require_once(__PATH__.'/package/cgd/DaoEvent.php');
	require_once(__PATH__.'/package/util/class/Gcm.php');
	require_once(__PATH__.'/package/util/phpqrcode/qrlib.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailService.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailServiceMessage.php');
	require_once(__PATH__.'/package/util/php-aws-ses-master/src/SimpleEmailServiceRequest.php');
	require_once(__PATH__.'/package/util/iugu-php-master/lib/Iugu.php');
	
	
	class AplEvent {
		private $dao;
		
		
		public function __construct(){
			$this->dao = new DaoEvent();
		}
		public function __destruct(){
			// OBJ
		}
		
		
		public function save($event, $error){
			if(!$error->hasError()){
				$return = $this->dao->save($event);
				
				if(!empty($return)){
					$event->setId($this->dao->getEventIdByTime($event));
					
					// SET QTD USER EVENTS
						$aplUser = new AplUSer();
						$aplUser->setNumberEventCorrectly($event->getUser());
					
					// TICKET
						$ticketsDayArray = $event->getTicketsDayArray();
						for($i = 0, $tam = count($ticketsDayArray); $i < $tam; $i++){
							$ticketsDayArray[$i]->setEvent($event);
							$returnAux = $this->dao->saveTicketDay($ticketsDayArray[$i]);
							
							if($returnAux == 1){
								$ticketsDayArray[$i]->setId($this->dao->getTicketDayId($ticketsDayArray[$i]));
								
								$ticketArray = $ticketsDayArray[$i]->getTicketArray();
								for($j = 0, $tamJ = count($ticketArray); $j < $tamJ; $j++){
									$ticketArray[$j]->setTicketDay($ticketsDayArray[$i]);
									$ticketArray[$j]->setStatus(1);
									$this->dao->saveTicket($ticketArray[$j]);
								}
							}
						}
					
					// ADDRESS
						$this->dao->saveAddress($event);
					
					// TAGS
						$tagsArray = $event->getTagsArray();
						for($i = 0, $tam = count($tagsArray); $i < $tam; $i++){
							$tagsArray[$i]->setEvent($event);
							if(strlen(trim($tagsArray[$i]->getName())) > 0){
								$this->dao->saveTag($tagsArray[$i]);
							}
						}
						
					$aplFile = new AplFile();
					// PHOTO
						$photosArray = $event->getPhotosArray();
						for($i = 0, $tam = count($photosArray); $i < $tam; $i++){
							$this->dao->savePhoto($photosArray[$i], $event);
							
							$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/normal/'.$photosArray[$i]->getName(), 1000, 1000, 'inside', 'down');
							$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/98-98/'.$photosArray[$i]->getName(), 98, 98, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/44-44/'.$photosArray[$i]->getName(), 44, 44, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/25-25/'.$photosArray[$i]->getName(), 25, 25, 'fill', 'any', true);
						}
				
					// IMAGE BANNER
						if(strlen($event->getImgBanner()->getName()) > 0 && file_exists('../../img/temp/'.$event->getImgBanner()->getName())){
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/normal/'.$event->getImgBanner()->getName(), 1000, 1000, 'inside', 'down');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/250-300/'.$event->getImgBanner()->getName(), 250, 300, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/75-90/'.$event->getImgBanner()->getName(), 75, 90, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/67-80/'.$event->getImgBanner()->getName(), 67, 80, 'fill', 'any', true);
						}
						
					// IMAGE BACKGROUND
						if(strlen($event->getImgBackground()->getName()) > 0 && file_exists('../../img/temp/'.$event->getImgBackground()->getName())){
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBackground()->getName(), '../../img/event/background/'.$event->getImgBackground()->getName(), 3000, 3000, 'inside', 'down', true);
						}
				}
			}
			return($return);
		}
		
		
		public function update($event, $error){
			if(!$error->hasError()){
				$return = $this->dao->update($event);
				
				if(!empty($return)){
					// TICKET
						$ticketsDayArray = $event->getTicketsDayArray();
						for($i = 0, $tam = count($ticketsDayArray); $i < $tam; $i++){
							$ticketsDayArray[$i]->setEvent($event);
							
							$returnAux = 1;
							if($ticketsDayArray[$i]->getId() > 0)
								$this->dao->updateTicketDay($ticketsDayArray[$i]);
							else
								$returnAux = $this->dao->saveTicketDay($ticketsDayArray[$i]);
							
							if($returnAux == 1){
								if($ticketsDayArray[$i]->getId() == 0)
									$ticketsDayArray[$i]->setId($this->dao->getTicketDayId($ticketsDayArray[$i]));
								
								$ticketArray = $ticketsDayArray[$i]->getTicketArray();
								for($j = 0, $tamJ = count($ticketArray); $j < $tamJ; $j++){
									$ticketArray[$j]->setTicketDay($ticketsDayArray[$i]);
									
									if($ticketArray[$j]->getId() > 0){
										$this->dao->updateTicket($ticketArray[$j]);
									}else{
										$ticketArray[$j]->setStatus(1);
										$this->dao->saveTicket($ticketArray[$j]);
									}
								}
							}
						}
					
					// ADDRESS
						$this->dao->saveAddress($event);
					
					// TAGS
						$this->dao->removeTags($event);
						$tagsArray = $event->getTagsArray();
						for($i = 0, $tam = count($tagsArray); $i < $tam; $i++){
							$tagsArray[$i]->setEvent($event);
							if(strlen(trim($tagsArray[$i]->getName())) > 0){
								$this->dao->saveTag($tagsArray[$i]);
							}
						}
						
					$aplFile = new AplFile();
					// PHOTO
						///$auxEvent = new Event();
						$auxPhotosArray = $this->dao->getPhotos($event);
						for($i = 0, $tam = count($auxPhotosArray); $i < $tam; $i++){
							if(!$event->verifyPhotoInGallery($auxPhotosArray[$i])){
								$returnAux = $this->dao->deletePhoto($auxPhotosArray[$i], $event);
								if($returnAux == 1){
									@unlink('../../img/event/photo/normal/'.$auxPhotosArray[$i]->getName());
									@unlink('../../img/event/photo/98-98/'.$auxPhotosArray[$i]->getName());
									@unlink('../../img/event/photo/44-44/'.$auxPhotosArray[$i]->getName());
									@unlink('../../img/event/photo/25-25/'.$auxPhotosArray[$i]->getName());
								}
							}
						}
						$photosArray = $event->getPhotosArray();
						for($i = 0, $tam = count($photosArray); $i < $tam; $i++){
							if(file_exists('../../img/temp/'.$photosArray[$i]->getName())){
								$this->dao->savePhoto($photosArray[$i], $event);
								$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/normal/'.$photosArray[$i]->getName(), 1000, 1000, 'inside', 'down');
								$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/98-98/'.$photosArray[$i]->getName(), 98, 98, 'fill', 'any');
								$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/44-44/'.$photosArray[$i]->getName(), 44, 44, 'fill', 'any');
								$aplFile->setImgToDirectory('../../img/temp/'.$photosArray[$i]->getName(), '../../img/event/photo/25-25/'.$photosArray[$i]->getName(), 25, 25, 'fill', 'any', true);
							}
						}
				
					// IMAGE BANNER
						$oldImg = $this->dao->getOldImage($event);
						if(strlen($event->getImgBanner()->getName()) > 0 && file_exists('../../img/temp/'.$event->getImgBanner()->getName())){
							@unlink('../../img/event/normal/'.$oldImg->getName());
							@unlink('../../img/event/250-300/'.$oldImg->getName());
							@unlink('../../img/event/75-90/'.$oldImg->getName());
							@unlink('../../img/event/67-80/'.$oldImg->getName());
							
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/normal/'.$event->getImgBanner()->getName(), 1000, 1000, 'inside', 'down');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/250-300/'.$event->getImgBanner()->getName(), 250, 300, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/75-90/'.$event->getImgBanner()->getName(), 75, 90, 'fill', 'any');
							$aplFile->setImgToDirectory('../../img/temp/'.$event->getImgBanner()->getName(), '../../img/event/67-80/'.$event->getImgBanner()->getName(), 67, 80, 'fill', 'any', true);
						}
				}
			}
			return($return);
		}
		
		
		public function getEventsFavorite($favorite){
			$arrayEvents = $this->dao->getEventsFavorite($favorite);
			
			for($i = 0, $tamI = count($arrayEvents); $i < $tamI; $i++){
				$arrayEvents[$i] = $this->getEvents($arrayEvents[$i]);
				$arrayEvents[$i] = $arrayEvents[$i][0];
			}
			return($arrayEvents);
		}
		
		
		public function getEvents($event, $userSession=NULL, $isMobile=false){
			$arrayEvents = $this->dao->getEvents($event, $userSession);
			
			$aplUser = new AplUser();
			for($i = 0, $tamI = count($arrayEvents); $i < $tamI; $i++){
				$user = $aplUser->getUsers($arrayEvents[$i]->getUser());
				$arrayEvents[$i]->setUser($user[0]);
				$arrayEvents[$i]->setAddress($this->dao->getAddress($arrayEvents[$i]));
				$arrayEvents[$i]->setPhotosArray($this->dao->getPhotos($arrayEvents[$i]));
				$arrayEvents[$i]->setTagsArray($this->dao->getTags($arrayEvents[$i]));
				
				// COFNFIRMED USERS
					/*if($isMobile){
						$arrayEvents[$i]->setUsersConfirmedArray($this->getUsersConfirmedForMobile($arrayEvents[$i]));
					}
					else{*/
						$arrayEvents[$i]->setUsersConfirmedArray($this->getUsersConfirmed($arrayEvents[$i], __LIMIT_USERS_CONFIRMED__));
					//}
					
				// FAVORITE
					if(is_object($userSession) && $userSession->getId() != $arrayEvents[$i]->getUser()->getId()){
						$favorite = new Favorite();
						$favorite->setEvent($arrayEvents[$i]);
						$favorite->setUser($userSession);
						$arrayEvents[$i]->setIsFavorite($this->verifyUserAlreadyFavorite($favorite));
					}
					
				// TICKETS
					if($event->getId() > 0 && is_array($event->getTicketsDayArray()) && count($event->getTicketsDayArray()) > 0){
						$arrayEvents[$i]->setTicketsDayArray($this->getTicketsDayById($event->getTicketsDayArray()));
						
						// SUPPORT TICKETS DAY
							$arrayTicketsDaySupport = $this->dao->getTicketsDay($arrayEvents[$i]);
							for($j = 0, $tamJ = count($arrayTicketsDaySupport); $j < $tamJ; $j++){
								$arrayTicketsDaySupport[$j]->setTicketArray($this->dao->getTickets($arrayTicketsDaySupport[$j]));
							}
							$arrayEvents[$i]->setTicketsDaySupportArray($arrayTicketsDaySupport);
					}
					else{
						$arrayTicketsDay = $this->dao->getTicketsDay($arrayEvents[$i]);
						for($j = 0, $tamJ = count($arrayTicketsDay); $j < $tamJ; $j++){
							$arrayTicketsDay[$j]->setTicketArray($this->dao->getTickets($arrayTicketsDay[$j]));
						}
						$arrayEvents[$i]->setTicketsDayArray($arrayTicketsDay);
						$arrayEvents[$i]->setTicketsDaySupportArray($arrayTicketsDay);
					}
					
					
					
			}
			return($arrayEvents);
		}
		
		
		public function getUsersConfirmed($event, $limit=0){
			return($this->dao->getUsersConfirmed($event, $limit));
		}
		
		
		public function getUsersConfirmedForMobile($event, $asJson=false){
			$arrayTickets = $this->dao->getUsersConfirmedForMobile($event);
			
			if($asJson){
				$arrayJson = array();
				for($i = 0, $tamI = count($arrayTickets); $i < $tamI; $i++){
					$arrayJson[] = array('paymentId'=>$arrayTickets[$i]->getPayment()->getId(),
						'paymentFullPrice'=>$arrayTickets[$i]->getPayment()->getFullPrice(),
						'paymentPriceToPay'=>$arrayTickets[$i]->getPayment()->getPriceToPay(),
						'paymentStatus'=>$arrayTickets[$i]->getPayment()->getStatus(),
						'paymentTime'=>$arrayTickets[$i]->getPayment()->getTimeMilliseconds(),
						'paymentParcelsItem'=>$arrayTickets[$i]->getPayment()->getParcels()->getItem(),
						'paymentParcelsLabel'=>$arrayTickets[$i]->getPayment()->getParcels()->getLabelItem(),
						'ticketDayId'=>$arrayTickets[$i]->getTicketDay()->getId(),
						'ticketDayIdTicketDayPayment'=>$arrayTickets[$i]->getTicketDay()->getIdTicketDayPayment(),
						'ticketDayDay'=>$arrayTickets[$i]->getTicketDay()->getDayMilliseconds(),
						'userId'=>$arrayTickets[$i]->getUser()->getId(),
						'userName'=>$arrayTickets[$i]->getUser()->getName(),
						'ticketId'=>$arrayTickets[$i]->getId(),
						'ticketIdTicketPayment'=>$arrayTickets[$i]->getIdTicketPayment(),
						'ticketIdTicketPaymentAsCode'=>$arrayTickets[$i]->getIdTicketPaymentAsCode(),
						'ticketStatus'=>$arrayTickets[$i]->getStatus(),
						'ticketTime'=>($arrayTickets[$i]->getTimeMilliseconds()),
						'ticketCode'=>$arrayTickets[$i]->getCode(),
						'ticketPrice'=>$arrayTickets[$i]->getPrice(),
						'ticketTicketValidDaysItem'=>$arrayTickets[$i]->getTicketValidDays()->getItem(),
						'ticketTicketValidDaysLabel'=>$arrayTickets[$i]->getTicketValidDays()->getLabelItem(),
						'ticketTicketValidDaysUsedItem'=>$arrayTickets[$i]->getTicketValidDaysUsed()->getItem(),
						'ticketTicketValidDaysUsedLabel'=>$arrayTickets[$i]->getTicketValidDaysUsed()->getLabelItem());
				}
				return($arrayJson);
			}
			return($arrayTickets);
		}
		/*public function getUsersConfirmedForMobile($event){
			$arrayUsersConfirmed = $this->dao->getUsersConfirmedForMobile($event);
			
			for($i = 0, $tamI = count($arrayUsersConfirmed); $i < $tamI; $i++){
				$auxTicket = $arrayUsersConfirmed[$i]->getTicket();
				$auxTicket->setUser($arrayUsersConfirmed[$i]);
				$auxTicket = $this->getPaymentTickets($auxTicket, true);
				$arrayUsersConfirmed[$i]->setTicket($auxTicket[0]);
				$arrayUsersConfirmed[$i]->getTicket()->setUser(new User());
				//$arrayUsersConfirmed[$i]->getTicket()->setEvent(new Event());
				$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setUsersConfirmedArray(array());
				$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setUser(NULL);
				$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setAddress(NULL);
				$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setPhotosArray(array());
				$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setTagsArray(array());
				//$arrayUsersConfirmed[$i]->getTicket()->getEvent()->setTicketsDayArray(array());
			}
			return($arrayUsersConfirmed);
		}*/
		
		
		public function getTicketsDayById($arrayTicketsDay){
			for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
				$auxTicketDay = $this->dao->getTicketsDay($arrayTicketsDay[$i]);
				$auxTicketDay = $auxTicketDay[0];
				$arrayTicketsDay[$i]->setDay($auxTicketDay->getDay());
				
				$arrayTickets = $arrayTicketsDay[$i]->getTicketArray();
				for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
					$auxTicket = $this->dao->getTickets($arrayTickets[$j]);
					$auxTicket = $auxTicket[0];
					$arrayTickets[$j]->setName($auxTicket->getName());
					$arrayTickets[$j]->setQtdMaxSell($auxTicket->getQtdMaxSell());
					$arrayTickets[$j]->setTicketValidDays($auxTicket->getTicketValidDays());
					$arrayTickets[$j]->setPrice($auxTicket->getPrice());
					$arrayTickets[$j]->setStatus($auxTicket->getStatus());
					
					if(is_null($arrayTickets[$j]->getQtdMax()) || $arrayTickets[$j]->getQtdMax()->getItem() == 0){
						$arrayTickets[$j]->setQtdMax($auxTicket->getQtdMax());
					}
				}
				$arrayTicketsDay[$i]->setTicketArray($arrayTickets);
			}
			return($arrayTicketsDay);
		}
		
		
		public function getEventByPage($event, $userSession=NULL){
			$event = $this->dao->getEventByPage($event, $userSession);
			
			if(is_object($event)){
				$event = $this->getEvents($event, $userSession);
				$event = $event[0];
			}
			return($event);
		}
		
		
		public function setNumberView($event, $user){
			$return = 0;
			if($this->dao->verifyUserAlreadyVisit($event, $user) == 0){
				$return += $this->dao->saveEventUserView($event, $user);
				$return += $this->dao->setNumberViewCorrectly($event);
			}
			return($return);
		}
		
		
		public function verifyUserAlreadyFavorite($favorite){
			return($this->dao->verifyUserAlreadyFavorite($favorite));
		}
		public function setEventFavorite($favorite){
			$return = 0;
			if($this->verifyUserAlreadyFavorite($favorite) == 0){
				$return = $this->dao->saveFavorite($favorite);
			}
			else{
				$return = $this->dao->deleteFavorite($favorite);
			}
			$this->dao->setNumberFavoriteCorrectly($favorite->getEvent());
			return($return);
		}
		
		
		public function getPaymentId($payment){
			return($this->dao->getPaymentId($payment));
		}
		public function savePayment($payment, $error){
			// ERROR
				//exit($payment->getFullPriceEventParcel().' - '.$payment->getFullPrice());
				$return = 0;
				if(!$payment->getEvent()->validateTicketsQtdSell($error)){
					$error->setHasError(true);
				}
				else if($payment->getEvent()->getTicketTypeCharge() == 2
					&& $payment->getFullPriceEventParcel() != $payment->getFullPrice()){
					$error->setHasError(true);
					$error->setPaymentError(new ErrorBlock('Houve uma falha no pagamento, feche a janela e tente novamente.', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->savePayment($payment);
				
				if(!empty($return)){
					$payment->setId($this->getPaymentId($payment));
					
					// TICKET
						$ticketsDayArray = $payment->getEvent()->getTicketsDayArray();
						for($i = 0, $tam = count($ticketsDayArray); $i < $tam; $i++){
							$ticketsDayArray[$i]->setPayment($payment);
							$returnAux = $this->dao->savePaymentTicketDay($ticketsDayArray[$i]);
							
							if($returnAux == 1){
								$ticketsDayArray[$i]->setIdTicketDayPayment($this->dao->getPaymentTicketDayId($ticketsDayArray[$i]));
								
								$ticketArray = $ticketsDayArray[$i]->getTicketArray();
								for($j = 0, $tamJ = count($ticketArray); $j < $tamJ; $j++){
									$ticketArray[$j]->setTicketDay($ticketsDayArray[$i]);
									
									for($z = 0, $tamZ = $ticketArray[$j]->getQtdMax()->getItem(); $z < $tamZ; $z++){
										$returnAux = $this->dao->savePaymentTicket($ticketArray[$j]);
										if($returnAux != 1){
											return(0);
										}
									}
								}
							}
							else{
								return(0);
							};
						}
						
					// PAYMENT ON IUGU
						if($payment->getEvent()->getTicketTypeCharge() == 2){
							$itens = array();
							$arrayTicketsDay = $payment->getEvent()->getTicketsDayArray();
							for($i = $c = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
								$arrayTicket = $arrayTicketsDay[$i]->getTicketArray();
								for($j = 0, $tamJ = count($arrayTicket); $j < $tamJ; $j++){
									$itens[$c] = array();
									$itens[$c]['description'] = 'Ingresso '.$payment->getEvent()->getName().': ';
									$itens[$c]['description'] .= $arrayTicket[$j]->getName();
									$itens[$c]['description'] .= ' ('.$arrayTicketsDay[$i]->getDayPage();
									$itens[$c]['description'] .= ' às '.$arrayTicketsDay[$i]->getTimeSeccondsToBrazilDate().'). ';
									$itens[$c]['description'] .= $arrayTicket[$j]->getTicketValidDaysHumanFormat();
									$itens[$c]['quantity'] = $arrayTicket[$j]->getQtdMax()->getItem();
									$itens[$c]['price_cents'] = $arrayTicket[$j]->getPrice($payment->getEvent()->getTicketTypeTaxes(), false, true);
									$c++;
								}
							}
							//Iugu::setApiKey('95b24750134930f8b0aaaff9e829ef91'); // TESTES
							Iugu::setApiKey('793ea3ae799fee9722e4ff7f5aa13244');
							$charger = Iugu_Charge::create(Array(
								"token"=>$payment->getToken(),
								"months"=>$payment->getParcels()->getPosItem(0),
								"email"=>$payment->getUser()->getEmail(),
								"items"=>$itens
							));
							$return = $charger['success'] ? 1 : 0;
						}
						
						if(!empty($return)){
							$payment->setStatus(1);
							
							// REPORT
								$this->saveReportPayment($payment);
							
							if($payment->getEvent()->getTicketTypeCharge() == 2){ // IUGU DATA
								$payment->setPaymentIugu(new PaymentIugu());
								$payment->getPaymentIugu()->post($charger);
								$payment->getPaymentIugu()->setPayment($payment);
								$this->savePaymentIugu($payment->getPaymentIugu());
								
								// SEND EMAIL FOR BUYER
									//AplEmail::ticketBill($payment);
									/*include(__PATH__.'/view/email/ticket-bill.php');
									$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
									$simpleEmailService = new SimpleEmailServiceMessage();
									$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
									$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
									$simpleEmailService->addTo($email);
									$simpleEmailService->setSubject($subject);
									$simpleEmailService->setMessageFromString('', $body);
									$ses->sendEmail($simpleEmailService);*/
							}
							
							// SET PAYMENT STATUS LIKE OK
								$this->setPaymentStatus($payment);
							
							// CORRECT NUMBER TICKETS SOLD
								$this->setNumberTicketSoldCorrectly($payment->getEvent());
								$arrayTicketsDay = $payment->getEvent()->getTicketsDayArray();
								for($i = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
									$arrayTickets = $arrayTicketsDay[$i]->getTicketArray();
									for($j = 0, $tamJ = count($arrayTickets); $j < $tamJ; $j++){
										$this->setTicketNumberTicketSoldCorrectly($arrayTickets[$j]);
									}
								}
						
							// SEND EMAIL FOR SALER
								if($payment->getEvent()->getTicketEmailSend() == 1){
									//AplEmail::ticketSold($payment);
									/*include(__PATH__.'/view/email/ticket-sold.php');
									$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
									$simpleEmailService = new SimpleEmailServiceMessage();
									$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
									$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
									$simpleEmailService->addTo($email);
									$simpleEmailService->setSubject($subject);
									$simpleEmailService->setMessageFromString('', $body);
									$ses->sendEmail($simpleEmailService);*/
								}
								
							// SEND EMAIL WITH TICKETS
								$arrayTicketsDay = $payment->getEvent()->getTicketsDayArray();
								for($i = $c = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
									$arrayTicket = $arrayTicketsDay[$i]->getTicketArray();
									
									for($j = 0, $tamJ = count($arrayTicket); $j < $tamJ; $j++){
										$arrayTicket[$j]->setUser($payment->getUser());
										$arrayTicket[$j]->setPayment($payment);
										$arrayAuxTicket = $this->getPaymentTickets($arrayTicket[$j]);
										
										for($z = 0, $tamZ = count($arrayAuxTicket); $z < $tamZ; $z++){
											$arrayAuxTicket[$z]->getPayment()->setUser($payment->getUser());
											$arrayAuxTicket[$z]->getPayment()->setEvent($payment->getEvent());
											
											QRcode::png($arrayAuxTicket[$z]->getCode(), __PATH__.'/img/ticket/qrcode/300-300/'.$arrayAuxTicket[$z]->getCode().'.png', QR_ECLEVEL_L, 8);
											//AplEmail::ticket($arrayAuxTicket[$z]);
											$ticket = $arrayAuxTicket[$z];
											/*include(__PATH__.'/view/email/ticket.php');
											$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
											$simpleEmailService = new SimpleEmailServiceMessage();
											$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
											$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
											$simpleEmailService->addTo($email);
											$simpleEmailService->setSubject($subject);
											$simpleEmailService->setMessageFromString('', $body);
											$ses->sendEmail($simpleEmailService);
											sleep(0.300);*/
										}
										break; // NOT NECESSARY TO CONTINUE
									}
									break; // NOT NECESSARY TO CONTINUE
								}
						}
						else{
							$error->setHasError(true);
							$error->setPaymentError(new ErrorBlock('Pagamento não aprovado.', true));
						}
				}
			}		
			return($return);
		}
		public function setPaymentStatus($payment){
			return($this->dao->setPaymentStatus($payment));
		}
		public function savePaymentIugu($paymentIugu){
			return($this->dao->savePaymentIugu($paymentIugu));
		}
		
		
		public function setNumberTicketSoldCorrectly($event){
			return($this->dao->setNumberTicketSoldCorrectly($event));
		}
		
		public function setTicketNumberTicketSoldCorrectly($ticket){
			return($this->dao->setTicketNumberTicketSoldCorrectly($ticket));
		}
		
		
		public function getUserBoughtTicket($ticket){
			$user = $this->dao->getUserBoughtTicket($ticket);
			return($user);
		}
		
		
		public function getPaymentTicketByNotQrCode($ticket){
			$ticket = $this->dao->getPaymentTicketByNotQrCode($ticket);
			return($this->getPaymentTicketByCodeFill($ticket));
		}
		public function getPaymentTicketByCode($ticket){
			$ticket = $this->dao->getPaymentTicketByCode($ticket);
			return($this->getPaymentTicketByCodeFill($ticket));
		}
		public function getPaymentTicketByCodeFill($ticket){
			if(is_object($ticket)){
				$aplUser = new AplUser();
				$auxUser = $ticket->getUserRepass()->getId() > 0 ? $ticket->getUserRepass() : $ticket->getUser();
				$auxUser = $aplUser->getUsers($auxUser);
				$auxUser = $auxUser[0];
				
				$ticket->setUser($auxUser);
				$ticket = $this->getPaymentTickets($ticket);
				$ticket = $ticket[0];
				$ticket->setUser($auxUser);
			}
			return($ticket);
		}
		
		
		public function getPaymentTickets($ticket, $isMobile=false){
			$arrayTickets = $this->dao->getPaymentTickets($ticket);
			$aplUser = new AplUser();
			
			for($i = 0, $tamI = count($arrayTickets); $i < $tamI; $i++){
				$auxEvent = $arrayTickets[$i]->getEvent();
				$auxTicketDay = $arrayTickets[$i]->getTicketDay();
				
				// BACKUP
					$arrayTickets[$i]->setQtdMax(new TicketQtdMax());
					$auxTicketStatus = $arrayTickets[$i]->getStatus();
					$auxTicketPrice = $arrayTickets[$i]->getPrice();
				
				$auxTicketDay->setTicketArray(array($arrayTickets[$i]));
				$auxEvent->setTicketsDayArray(array($auxTicketDay));
				$auxEvent->setIsAll(true); // HACKCODE TO GET EVENT EVEN THAT IS DEACTIVATE
				$auxEvent = $this->getEvents($auxEvent);
				$arrayTickets[$i]->setEvent($auxEvent[0]);
				
				$arrayTickets[$i]->setStatus($auxTicketStatus);
				$arrayTickets[$i]->setPrice($auxTicketPrice);
				
				// HACKCODE TO AVOID INFINITE LOOP IN JSON
					if($isMobile){
						$auxTicketDay->setTicketArray(array());
					}
				
				// GENERATE QRCODE
					if(!file_exists(__PATH__.'/img/ticket/qrcode/300-300/'.$arrayTickets[$i]->getCode().'.png')){
						QRcode::png($arrayTickets[$i]->getCode(), __PATH__.'/img/ticket/qrcode/300-300/'.$arrayTickets[$i]->getCode().'.png', QR_ECLEVEL_L, 8);
					}
					
				// USER REPASS
					if($arrayTickets[$i]->getUserRepass()->getId() > 0){
						$auxUser = $aplUser->getUsers($arrayTickets[$i]->getUserRepass());
						if(is_array($auxUser) && count($auxUser) > 0){
							$auxTime = $arrayTickets[$i]->getUserRepass()->getTime();
							$arrayTickets[$i]->setUserRepass($auxUser[0]);
							$arrayTickets[$i]->getUserRepass()->setTime($auxTime);
						}
					}
			}
			return($arrayTickets);
		}
		
		
		public function repassTicket($ticket, $userRepass, $error){
			// ERROR
				$return = 0;
				$aplUser = new AplUser();
				if($aplUser->verifyPassword($ticket->getUser()) == 0){
					$error->setHasError(true);
					$error->setPasswordError(new ErrorBlock('Senha inválida', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->repassTicket($ticket, $userRepass);
			
				if($return == 1){
					$user = $aplUser->getUsers($ticket->getUser());
					$user = $user[0];
					$ticket->setUser($user);
					
					//AplEmail::ticketRepass($ticket, $userRepass);
					include(__PATH__.'/view/email/ticket-repass.php');
					$ses = new SimpleEmailService(__SES_TOKEN__, __SES_KEY__);
					$simpleEmailService = new SimpleEmailServiceMessage();
					$simpleEmailService->setFrom(__SES_EMAIL_FROM__);
					$simpleEmailService->addReplyTo(__SES_EMAIL_REPLY__);
					$simpleEmailService->addTo($email);
					$simpleEmailService->setSubject($subject);
					$simpleEmailService->setMessageFromString('', $body);
					$ses->sendEmail($simpleEmailService);
				}
			}
		
			return($return);
		}
		
		
		public function getTicketPaymentValidDays($ticket){
			$ticketValidDays = $this->dao->getTicketPaymentValidDays($ticket);
			return($ticketValidDays);
		}
		
		
		public function confirmUserInEvent($ticket, $error){
			// ERROR
				$return = 0;
				if($ticket->getUser()->getStatus() != 1){
					$error->setHasError(true);
					$error->setCodeError(__ERROR_USER_INACTIVE__);
					$error->setGenericError(new ErrorBlock('O usuário "'.$ticket->getUser()->getName().'" está desativado do <b>vuup</b>.', true));
				}
				else if(!$this->dao->isEventActivate($ticket->getEvent())){
					$error->setHasError(true);
					$error->setCodeError(__ERROR_EVENT_INACTIVE__);
					$error->setGenericError(new ErrorBlock('O evento "'.$ticket->getEvent()->getName().'" não está mais aitvo.', true));
				}
			// ERROR
			
			if(!$error->hasError()){
				$return = $this->dao->confirmUserInEvent($ticket);
				
				if(!empty($return)){
					$this->dao->setPaymentTicketStatus($ticket);
					$this->dao->setAmountInsideCorrectly($ticket->getEvent());
				}
				else{
					$error->setHasError(true);
					$error->setCodeError(__ERROR_TICKET_INACTIVE__);
					$error->setGenericError(new ErrorBlock('O ingresso de código "'.$ticket->getIdTicketPaymentAsCode().'" já foi utilizado o máximo de vezes possíves ('.$ticket->getTicketValidDays()->getItem().').', true));
				}
			}
			return($return);
		}
		
		
		// REPORT
			public function saveReportData($reportData){
				$return = $this->dao->saveReportData($reportData);
				return($return);
			}
			public function getReportData($reportData){
				$arrayReportData = $this->dao->getReportData($reportData);
				return($arrayReportData);
			}
			
			
			public function saveReportPayment($payment){
				$return = 0;
				$reportData = new ReportData();
				$reportData->setEvent($payment->getEvent());
				$reportData->setTime(mktime(0,0,0,date('m', $payment->getTime()),date('d', $payment->getTime()),date('Y', $payment->getTime())));
				
				$arrayTicketsDay = $payment->getEvent()->getTicketsDayArray();
				for($i = $c = 0, $tamI = count($arrayTicketsDay); $i < $tamI; $i++){
					$reportData->setTicketDay($arrayTicketsDay[$i]);
					$arrayTicket = $arrayTicketsDay[$i]->getTicketArray();
					
					for($j = 0, $tamJ = count($arrayTicket); $j < $tamJ; $j++){
						$reportData->setTicket($arrayTicket[$j]);
						for($z = 0, $tamZ = $arrayTicket[$j]->getQtdMax()->getItem(); $z < $tamZ; $z++){
							$return += $this->saveReportTicket($reportData);
						}
					}
				}
				return($return);
			}
			public function saveReportTicket($reportData){
				$return = $this->dao->saveReportTicket($reportData);
				return($return);
			}
			public function getReportTicket($reportData){
				$arrayReportTicket = $this->dao->getReportTicket($reportData);
				
				for($i = 0, $tamI = count($arrayReportTicket); $i < $tamI; $i++){
					// TICKET DAY
						$auxTicketDay = $this->dao->getTicketsDay($arrayReportTicket[$i]->getTicketDay());
						$arrayReportTicket[$i]->setTicketDay($auxTicketDay[0]);
					
					// TICKET
						$auxTicket = $this->dao->getTickets($arrayReportTicket[$i]->getTicket());
						$arrayReportTicket[$i]->setTicket($auxTicket[0]);
				}
				return($arrayReportTicket);
			}
			
		// SINCRONIZY
			public function sicronyzeFill($post){
				if(!empty($post['extra-data-sicronyze'])){
					$arrayAux_1 = explode(__SPMAIN__, $post['extra-data-sicronyze']);
					
					for($i = 0, $tamI = count($arrayAux_1); $i < $tamI; $i++){
						$arrayAux_2 = explode(__SPDATA__, $arrayAux_1[$i]);
						$ticket = new Ticket();
						$ticket->setUser(new User($arrayAux_2[0]));
						$ticket->setEvent(new Event($arrayAux_2[1]));
						$ticket->setIdTicketPayment($arrayAux_2[2]);
						
						$return = $this->dao->confirmUserInEvent($ticket);
						if(!empty($return)){
							$this->dao->setPaymentTicketStatus($ticket);
							$this->dao->setAmountInsideCorrectly($ticket->getEvent());
						}
					}
				}
			}
			public function sicronyzeGet($asJson=false, $event=NULL, $user=NULL){
				$arrayTickets = $this->dao->sicronyzeGet($event, $user);
				
				if($asJson){
					$arrayJson = array();
					for($i = 0, $tamI = count($arrayTickets); $i < $tamI; $i++){
						$arrayJson[] = array('idTicketPayment'=>$arrayTickets[$i]->getIdTicketPayment(),
							'status'=>$arrayTickets[$i]->getStatus(),
							'ticketValidDaysUsedItem'=>$arrayTickets[$i]->getTicketValidDaysUsed()->getItem());
							/*'idUser'=>$arrayTickets[$i]->getUser()->getId(),
							'idEvent'=>$arrayTickets[$i]->getEvent()->getId());*/
					}
					//exit(json_encode($arrayJson));
					return($arrayJson);
				}
				return($arrayTickets);
			}
	}
?>