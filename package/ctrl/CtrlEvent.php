<?php
	session_start();
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/apl/AplEvent.php');

	ini_set("display_errors", 1);
	
	$apl = new AplEvent();
	
	if(preg_match('/^(vu-get-event-dashboard|vu-get-event-form-create|vu-get-event-list|vu-get-event-list-load-more|vu-get-event-update-form|vu-get-event-favorite-dashboard|vu-get-event-favorite-load-more|vu-get-event-favorite|vu-get-event-favorite-load-more|vu-get-event-payment-form|vu-get-events-page|get-users-confirm|vu-get-event-list-page-load-more|vu-mob-get-event-list){1}$/', $_POST['method'])){
		$user = new User($_SESSION['id']);
		
		if(preg_match('/^(vu-get-events-page|vu-get-event-list|vu-get-event-list-load-more|vu-get-event-list-page-load-more|vu-mob-get-event-list){1}$/', $_POST['method'])){
			$aplUser = new AplUser();
			$user = $aplUser->getUsers($user);
			$user = $user[0];
			
			$isMobile = false;
			if(preg_match('/^(vu-mob-get-event-list){1}$/', $_POST['method'])){
				$user->setId($_POST['id-user']);
				$isMobile = true;
				
				$apl->sicronyzeFill($_POST);
				$synchronizedData = $apl->sicronyzeGet(true, NULL, $user);
			}
			
			$userFromPage = empty($_POST['id']) ? NULL : new User($_POST['id']);
			if(is_object($userFromPage)){
				$userFromPage = $aplUser->getUsers($userFromPage);
				$userFromPage = $userFromPage[0];
			}
			
			$search = new Search();
			$search->post($_POST);
			
			$event = new Event(empty($_POST['ids']) ? 0 : $_POST['ids']);
			$event->setUser(preg_match('/^(vu-get-events-page|vu-get-event-list-page-load-more){1}$/', $_POST['method']) ? $userFromPage : $user);
			$event->setSearch(empty($_POST['is-search']) ? NULL : $search);
			$event->setIsAll(preg_match('/^(vu-get-events-page|vu-get-event-list-page-load-more){1}$/', $_POST['method']) ? false : true);
			$event->setIsLoadMore(preg_match('/^(vu-get-event-list-load-more|vu-get-event-list-page-load-more){1}$/', $_POST['method']));
			$event->setIsIndex($_POST['is-index']);
			$event->setLimit(__LIMIT_EVENTS__);
			
			$arrayEvents = $apl->getEvents($event, $user, $isMobile);
		}
		else if(preg_match('/^(vu-get-event-favorite-dashboard|vu-get-event-favorite|vu-get-event-favorite-load-more){1}$/', $_POST['method'])){
			$event = new Event(empty($_POST['ids']) ? 0 : $_POST['ids']);
			$event->setIsAll(false);
			$event->setIsLoadMore(preg_match('/^(vu-get-event-favorite-load-more){1}$/', $_POST['method']));
			$event->setLimit(__LIMIT_EVENTS__);
			
			$favorite = new Favorite();
			$favorite->setEvent($event);
			$favorite->setUser($user);
			
			$arrayEvents = $apl->getEventsFavorite($favorite);
		}
		else if(preg_match('/^(vu-get-event-update-form){1}$/', $_POST['method'])){
			$event = new Event($_POST['id']);
			$event->setUser($user);
			$event->setIsAll(true);
			$event = $apl->getEvents($event);
			$event = $event[0];
		}
		else if(preg_match('/^(vu-get-event-payment-form){1}$/', $_POST['method'])){
			if($user->getId() > 0){
				$event = new Event($_POST['id']);
				$event->setTicketsDayBoughtCorrectly($_POST['tickets-days']);
				$event = $apl->getEvents($event);
				$event = $event[0];
			}
			else{
				$_POST['old-method'] = $_POST['method'];
				$_POST['method'] = 'vu-get-user-login-form'; // TO GET LOGIN FORM
			}
		}
		else if(preg_match('/^(get-users-confirm){1}$/', $_POST['method'])){
			$event = new Event($_POST['id']);
			$event->setUsersConfirmedArray($apl->getUsersConfirmed($event));
		}
		
		
		if(!preg_match('/^(vu-get-user-login-form){1}$/', $_POST['method'])){
			require_once(__PATH__.'/view/event-make.php');
		}
		else{
			require_once(__PATH__.'/view/user-make.php');
		}
	}
	
	
	else if(preg_match('/^(vu-mob-get-event-users-confirmed|vu-mob-get-event-users-confirmed-load-more){1}$/', $_POST['method'])){
		$event = new Event($_POST['id-event']);
		$event->setIsLoadMore(preg_match('/^(vu-mob-get-event-users-confirmed-load-more){1}$/', $_POST['method']));
		$event->setIds(empty($_POST['extra-data']) ? '' : $_POST['extra-data']);
		
		$apl->sicronyzeFill($_POST);
		//$synchronizedData = $apl->sicronyzeGet(true, $event, NULL);
		
		$arrayObj = $apl->getUsersConfirmedForMobile($event, true);
		require_once(__PATH__.'/view/event-validate-status.php');
	}
	
	
	else if(preg_match('/^(vu-mob-validate-user-by-code|vu-mob-validate-user-by-qrcode){1}$/', $_POST['method'])){
		$error = new Error();
		$error->setHasError(true);
		
		$event = new Event($_POST['id-event']);
		
		$apl->sicronyzeFill($_POST);
		$synchronizedData = $apl->sicronyzeGet(true, $event, NULL);
		
		$ticket = new Ticket();
		$ticket->setEvent($event);
		if(preg_match('/^(vu-mob-validate-user-by-code){1}$/', $_POST['method'])){
			$ticket->setCodeTicketPaymentCorrectlyByCode($_POST['code']);
			$ticket->setIdTicketPaymentCorrectlyByCode($_POST['code']);
			$ticket = $apl->getPaymentTicketByNotQrCode($ticket);
		}
		else{
			$ticket->setCode($_POST['qrcode']);
			$ticket = $apl->getPaymentTicketByCode($ticket);
		}
		
		if(is_object($ticket)){
			$ticket->setEvent($event);
			$user = $apl->getUserBoughtTicket($ticket);
			$ticket->setUser($user);
			$ticket = $apl->getPaymentTickets($ticket, true);
		}
		
		if(is_array($ticket) && count($ticket) > 0 && $user->getId() > 0){
			$error = NULL;
			
			$aplUser = new AplUser();
			$user = $aplUser->getUsers($user);
			$user = $user[0];
			
			$ticket = $ticket[0];
			$ticket->setUser($user);
		}
		else{
			$ticket = new Ticket();
		}
		
		require_once(__PATH__.'/view/event-validate-status.php');
	}
	
	
	else if(preg_match('/^(vu-mob-confirm-user-entered){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_POST['id-user']);
		$aplUser = new AplUser();
		$user = $aplUser->getUsers($user);
		$user = $user[0];
		
		$event = new Event($_POST['id-event']);
		$event = $apl->getEvents($event);
		$event = $event[0];
		
		$apl->sicronyzeFill($_POST);
		$synchronizedData = $apl->sicronyzeGet(true, $event, NULL);
		
		$ticket = new Ticket();
		$ticket->setIdTicketPayment($_POST['id-ticket-payment']);
		$ticket->setUser($user);
		$ticket->setEvent($event);
		$ticket->setTicketValidDays($apl->getTicketPaymentValidDays($ticket));
		
		$return = $apl->confirmUserInEvent($ticket, $error);
		
		require_once(__PATH__.'/view/event-validate-status.php');
	}
	
	
	else if(preg_match('/^(vu-pay-event-ticket){1}$/', $_POST['method'])){
		$error = new Error();
		$user = new User(empty($_SESSION['id']) ? 0 : $_SESSION['id']);
		
		if($user->getId() > 0){
			$aplUser = new AplUser();
			$user = $aplUser->getUsers($user);
			$user = $user[0];
			
			$event = new Event($_POST['id']);
			$event->setTicketsDayBoughtCorrectly($_POST['tickets-days']);
			$event = $apl->getEvents($event);
			$event = $event[0];
			
			$payment = new Payment();
			$payment->post($_POST);
			$payment->setUser($user);
			$payment->setEvent($event);
			$payment->getParcels()->setArrayItemByTaxe($event->getTicketTypeTaxes());
			$return = $apl->savePayment($payment, $error);
		}
		
		require_once(__PATH__.'/view/event-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-map|vu-get-map-admin){1}$/', $_POST['method'])){
		$event = new Event($_POST['id']);
		$event->setIsAll(true);
		$event = $apl->getEvents($event);
		$event = $event[0];
		
		require_once(__PATH__.'/view/event-map-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-days-prices){1}$/', $_POST['method'])){
		$event = new Event($_POST['id']);
		$event->setIsAll(true);
		$event = $apl->getEvents($event);
		$event = $event[0];
		
		require_once(__PATH__.'/view/event-days-make.php');
	}
	
	
	else if(preg_match('/^(vu-validate-url-video){1}$/', $_POST['method'])){
		$video = new Video($_POST['val']);
		$video->validateVideo();
		
		echo json_encode(array('isVideo'=>true, 'html'=>$video->getUrl()));
	}
	
	
	else if(preg_match('/^(vu-get-event-report|vu-get-event-report-subcontent|vu-get-event-report-filter|vu-get-event-promoters-report-subcontent|vu-get-event-promoters-report-subcontent-filter){1}$/', $_POST['method'])){
		$user = new User($_SESSION['id']);
		
		$event = new Event($_POST['id']);
		$event->setUser($user);
		$event->setIsAll(true);
		$event = $apl->getEvents($event);
		$event = $event[0];
		
		if(preg_match('/^(vu-get-event-report){1}$/', $_POST['method'])){
			$reportDataTicket = new ReportData();
			$reportDataTicket->setName('Ingressos vendidos');
			$reportDataTicket->setEvent($event);
			$reportDataTicket->setTime(mktime(0,0,0,date('m'),date('d'),date('Y')));
			$arrayReportDataTickets = $apl->getReportTicket($reportDataTicket);
			
			$reportDataView = new ReportData();
			$reportDataView->setName('Visualizações');
			$reportDataView->setEvent($event);
			$reportDataView->setType(ReportData::REPORT_DATA_VIEWS);
			$reportDataView->setTime(mktime(0,0,0,date('m'),date('d'),date('Y')));
			$arrayReportDataViews = $apl->getReportData($reportDataView);
		}
		else if(preg_match('/^(vu-get-event-report-filter){1}$/', $_POST['method'])){
			$reportData = new ReportData();
			$reportData->setEvent($event);
			$reportData->setTime(mktime(0,0,0,$_POST['month'],30,$_POST['year']));
			
			if($_POST['type'] == 3){
				$reportData->setName('Visualizações');
				$reportData->setType($_POST['type']);
				$arrayReportData = $apl->getReportData($reportData);
			}
			else{
				$reportData->setName('Ingressos vendidos');
				$arrayReportData = $apl->getReportTicket($reportData);
			}
		}
		
		
		require_once(__PATH__.'/view/event-report.php');
	}
	
	
	else if(preg_match('/^(vu-get-ticket-active-dashboard|vu-get-ticket-active-list|vu-get-ticket-active-list-load-more|vu-get-ticket-inactive-list|vu-get-ticket-inactive-list-load-more|vu-mob-get-ticket-active-list){1}$/', $_POST['method'])){
		$user = new User($_SESSION['id']);
		
		$isMobile = false;
		if(preg_match('/^(vu-mob-get-ticket-active-list){1}$/', $_POST['method'])){
			$user->setId($_POST['id-user']);
			$isMobile = true;
			
			$apl->sicronyzeFill($_POST);
			$synchronizedData = $apl->sicronyzeGet(true, NULL, $user);
		}
		
		$ticket = new Ticket(empty($_POST['ids']) ? 0 : $_POST['ids']);
		$ticket->setUser($user);
		$ticket->setIsLoadMore(preg_match('/^(vu-get-ticket-active-list-load-more){1}$/', $_POST['method']));
		$ticket->setLimit(__LIMIT_TICKETS__);
		
		$arrayObj = $apl->getPaymentTickets($ticket, $isMobile);
		require_once(__PATH__.'/view/ticket-make.php');
	}
	
	
	else if(preg_match('/^(vu-event-create|vu-event-update){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_SESSION['id']);
		$aplUser = new AplUser();
		$user = $aplUser->getUsers($user);
		$user = $user[0];
		
		$event = new Event();
		$event->post($_POST);
		$event->setId($_POST['id']);
		$event->setUser($user);
		$event->setStatusBankAccount((is_null($user->getBank()) || $user->getBank()->getStatus() != 1) && $event->getTicketTypeCharge() == 2 ? 0 : 1);
		
		if(preg_match('/^(vu-event-update){1}$/', $_POST['method'])){
			$return = $apl->update($event, $error);
		}
		else{
			$return = $apl->save($event, $error);
		}
		
		require_once(__PATH__.'/view/event-make.php');
	}
	
	
	else if(preg_match('/^(vu-event-favoriting){1}$/', $_POST['method'])){
		$user = new User($_SESSION['id']);
		if($user->getId() > 0){
			$event = new Event($_POST['id']);
			
			$favorite = new Favorite();
			$favorite->setEvent($event);
			$favorite->setUser($user);
			$favorite->setTime(time());
			
			$return = $apl->setEventFavorite($favorite);
			$isFavorite = $apl->verifyUserAlreadyFavorite($favorite);
		}
		else{
			$_POST['old-method'] = $_POST['method'];
			$_POST['method'] = 'vu-get-user-login-form'; // TO GET LOGIN FORM
		}
		
		if(!preg_match('/^(vu-get-user-login-form){1}$/', $_POST['method'])){
			require_once(__PATH__.'/view/event-make.php');
		}
		else{
			require_once(__PATH__.'/view/user-make.php');
		}
	}
?>