<?php
	//header("HTTP/1.1 301 Moved Permanently");
	//header("Location: http://www.thiengo.com.br");
	//exit();
	
	session_start();
	require_once('config/config.php');
	/*require_once(__PATH__.'/package/util/mdetect/mdetect.php');*/
	require_once(__PATH__.'/package/ctrl/CtrlEvent.php');
	require_once(__PATH__.'/package/ctrl/CtrlUser.php');


	/*$user = new User();
	$user->setPassword('33189588');
	exit('--> '.$user->getPasswordWithHash());*/

	// APLs
		$aplUser = new AplUser();
		$aplEvent = new AplEvent();
		
	// VARS
		//$isIndex = false;
	
	// USER LOGGED
		/*if($_SESSION['id'] == 1){
			$_SESSION['id'] = 246;
		}*/
		$user = new User(empty($_SESSION['id']) ? 0 : $_SESSION['id']);
		$user = $user->getId() > 0 ? $user : new User(empty($_COOKIE[__COOKIE_KEEP_CONNNECTED__]) ? 0 : $_COOKIE[__COOKIE_KEEP_CONNNECTED__]);
		if($user->getId() > 0){
			$_SESSION['id'] = $user->getId();
			$user = $aplUser->getUsers($user);
			$user = $user[0];
			$user = is_object($user) ? $user : new User();
		}
		$user->setIp(ip2long($user->getIpCorrectly()));
	
	/*// ESTATISTICS
		$estatistics = $aplAdmin->getEstatistics();*/
	
	// FORGOT PASSWORD FEEDBACK
		/*$forgotPassword = NULL;
		if(strlen($_GET['page']) == 41){
			$forgotPassword = new ForgotPassword();
			$forgotPassword->setHash(substr($_GET['page'], 1, 40));
			$forgotPassword = $aplAdmin->getForgotPasswordByHash($forgotPassword);
			$forgotPassword->setStatus(substr($_GET['page'], 0, 1));
		}*/
		
	/*// DOG OWNER LOGGED
		if(!empty($_SESSION['id-user'])){
			
			// APLs
				$aplDog = new AplDog();
			
			// DOGS
				$dog = new Dog();
				$dog->setUser($user);
				$arrayDogs = $aplDog->getDogs($dog);
		}*/
	
	//exit('Cookie: '.$_COOKIE[__COOKIE_KEEP_CONNNECTED__]);
	
	if(preg_match('/^(test-payment){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/test-payment.php');
	}
	else if(preg_match('/^(get-csv){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/get-csv.php');
	}
	else if(preg_match('/^(correct-bd){1}$/', $_GET['page'])){ // ONLY DEVELOPERS
		require_once(__PATH__.'/view/correct-bd.php');
	}
	else if(preg_match('/^(email){1}$/', $_GET['page']) && !empty($_GET['subpage'])){ // ONLY DEVELOPERS
		require_once(__PATH__.'/view/email/'.$_GET['subpage'].'.php');
	}
	else if(preg_match('/^(login){1}$/', $_GET['page']) && $user->getId() == 0){
		require_once(__PATH__.'/view/login.php');
	}
	else if(preg_match('/^(inscrever-se){1}$/', $_GET['page']) && $user->getId() == 0){
		require_once(__PATH__.'/view/sign-up.php');
	}
	else if(preg_match('/^(como-funciona){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/how-it-works.php');
	}
	else if(preg_match('/^(termos-e-condicoes-de-uso){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/terms-of-use.php');
	}
	else if(preg_match('/^(politica-de-privacidade){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/privacy-policy.php');
	}
	else if(preg_match('/^(esqueceu-a-senha){1}$/', $_GET['page']) && $user->getId() == 0){
		$forgotPassword = NULL;
		if(strlen(trim($_GET['subpage'])) > 0){
			$forgotPassword = new ForgotPassword();
			$forgotPassword->setHash($_GET['subpage']);
			$forgotPassword = $aplUser->getForgotPassword($forgotPassword);
		}
		
		require_once(__PATH__.'/view/forgot-password.php');
	}
	else if(preg_match('/^(perguntas-frequentes){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/faq.php');
	}
	else if(preg_match('/^(programa-de-indicacao){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/referral-program.php');
	}
	else if(preg_match('/^(dicas-para-organizadores){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/tips-for-organizers.php');
	}
	else if(preg_match('/^(trabalhe-conosco){1}$/', $_GET['page'])){
		require_once(__PATH__.'/view/work-with-us.php');
	}
	else if(preg_match('/^(busca){1}$/', $_GET['page'])){
		$search = new Search();
		$search->setDataCorrectlyFromUrl($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		
		// CACHE
			require_once(__PATH__.'/view/parameters-cache.php');
		
		$event = new Event();
		$event->setSearch($search);
		$event->setIsAll(false);
		$event->setLimit(__LIMIT_EVENTS__);
		$event->setIsIndex(true);
		$arrayObj = $aplEvent->getEvents($event, $user);
		
		require_once(__PATH__.'/view/search.php');
	}
	else if(preg_match('/^(confirmar){1}$/', $_GET['page']) && $user->getId() == 0){
		$user->setEmail($_GET['subpage']);
		$user = $aplUser->confirmAccount($user);
		
		require_once(__PATH__.'/view/confirm.php');
	}
	else if(preg_match('/^(dashboard){1}$/', $_GET['page']) && $user->getId() > 0){
		require_once(__PATH__.'/view/dashboard.php');
	}
	else if(preg_match('/^(sair){1}$/', $_GET['page'])){
		setcookie(__COOKIE_KEEP_CONNNECTED__, 0, 0, '/');
		unset($_SESSION['id']);
		$_SESSION['id'] = 0;
		$user = new User();
		
		header('Location: '.__PATH__);
		exit();
	}
	else if(preg_match('/^(ingresso){1}$/', $_GET['page']) && !empty($_GET['subpage'])){
		
		$ticket = new Ticket();
		$ticket->setCode($_GET['subpage']);
		$ticket = $aplEvent->getPaymentTicketByCode($ticket);
		
		if(is_object($ticket)){
			require_once(__PATH__.'/view/ticket.php');
		}
		else{
			goto notFound; // GOTO
		}
	}
	else if(!empty($_GET['page']) && !empty($_GET['subpage'])){
		$ownerEvent = new User();
		$ownerEvent->setUrlSufix($_GET['page']);
		$ownerEvent = $aplUser->getUserByPage($ownerEvent);
		
		if(is_object($ownerEvent)){
			$eventCache = NULL;
			$event = new Event();
			$event->setUser($ownerEvent);
			$event->setCorrectTimeByPage($_GET['subpage']);
			$event->setUrlSufix($_GET['subsubpage']);
			$event = $aplEvent->getEventByPage($event, $user);
		
			if(is_object($event)){
				$event->setUser($ownerEvent);
				
				// CACHE
					require_once(__PATH__.'/view/parameters-cache.php');
				
				// SET VIEW IN EVENT
					$return = $aplEvent->setNumberView($event, $user);
					if($return > 0){
						$reportData = new ReportData();
						$reportData->setType(ReportData::REPORT_DATA_VIEWS);
						$reportData->setEvent($event);
						$reportData->setTime(mktime(0,0,0,date('m'),date('d'),date('Y')));
						$reportData->setDay(date('d'));
						$reportData->setMonth(date('m'));
						$reportData->setYear(date('Y'));
						$aplEvent->saveReportData($reportData);
					}
				
				require_once(__PATH__.'/view/event-page.php');
			}
		}
		
		if(!is_object($ownerEvent) || !is_object($event)){
			goto notFound; // GOTO
		}
	}
	else if(!empty($_GET['page']) && empty($_GET['subpage'])){
		$ownerEvent = new User();
		$ownerEvent->setUrlSufix($_GET['page']);
		$ownerEvent = $aplUser->getUserByPage($ownerEvent);
		
		if(is_object($ownerEvent)){
			// CACHE
				require_once(__PATH__.'/view/parameters-cache.php');
			
			// FOLLOW
				$follow = new Follow();
				$follow->setIsFollowing(true);
				$follow->setUserFollowing($user);
				$follow->setUserFollower($ownerEvent);
				$ownerEvent->setIsFollow($aplUser->verifyUserAlreadyFollow($follow));
			
				$follow = new Follow();
				$follow->setIsFollower(true);
				$follow->setUserFollower($ownerEvent);
				$follow->setLimit(__LIMIT_FOLLOWS_PAGE__);
				$ownerEvent->setFollowingsArray($aplUser->getFollows($follow));
				
				$follow = new Follow();
				$follow->setIsFollowing(true);
				$follow->setUserFollowing($ownerEvent);
				$follow->setLimit(__LIMIT_FOLLOWS_PAGE__);
				$ownerEvent->setFollowersArray($aplUser->getFollows($follow));
					
			$event = new Event();
			$event->setUser($ownerEvent);
			$event->setIsAll(false);
			$event->setLimit(__LIMIT_EVENTS__);
			$event->setIsIndex(false);
			$arrayObj = $aplEvent->getEvents($event, $user);
			
			require_once(__PATH__.'/view/organizer-page.php');
		}
		else{
			goto notFound; // GOTO
		}
	}
	else{
		notFound: // GOTO - PLACE
		
		// CACHE
			require_once(__PATH__.'/view/parameters-cache.php');
		
		$event = new Event();
		$event->setIsAll(false);
		$event->setLimit(__LIMIT_EVENTS__);
		$event->setIsIndex(true);
		$arrayObj = $aplEvent->getEvents($event, $user);
		
		require_once(__PATH__.'/view/index.php');
	}
