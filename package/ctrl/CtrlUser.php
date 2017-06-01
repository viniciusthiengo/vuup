<?php
	session_start();
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/apl/AplUser.php');
	require_once(__PATH__.'/package/apl/AplEvent.php');
	
	
	$apl = new AplUser();
	
	if(preg_match('/^(vu-get-user-login-form|vu-get-user-dashboard|vu-get-user-update-form|vu-get-user-pass-form|vu-get-user-bank-form|vu-get-user-remove-account|vu-get-form-promoter-message|vu-get-form-organizer-event-message|vu-get-form-organizer-event-message-in-page|vu-get-user-gift-ticket|vu-get-gift-ticket-form|vu-get-user-gift-ticket-step-confirm){1}$/', $_POST['method'])){
		if(preg_match('/^(vu-get-user-dashboard|vu-get-user-update-form){1}$/', $_POST['method'])){
			$user = new User($_SESSION['id']);
			$user = $apl->getUsers($user);
			$user = $user[0];
		}
		else if(preg_match('/^(vu-get-user-bank-form){1}$/', $_POST['method'])){
			$user = new User($_SESSION['id']);
			$user->setBank($apl->getBank($user));
		}
		else if(preg_match('/^(vu-get-form-organizer-event-message|vu-get-form-organizer-event-message-in-page){1}$/', $_POST['method'])){
			$user = new User(empty($_SESSION['id']) ? 0 : $_SESSION['id']);
			
			if($_POST['is-from-event'] == 1){
				$event = new Event($_POST['id']);
				$event->setIsAll(preg_match('/^(vu-get-form-organizer-event-message){1}$/', $_POST['method']));
				$aplEvent = new AplEvent();
				$event = $aplEvent->getEvents($event);
				$event = $event[0];
				$ownerUser = $apl->getUsers($event->getUser());
				$ownerUser = $ownerUser[0];
				$event->setUser($ownerUser);
			}
			else{
				$ownerUser = $apl->getUsers(new User($_POST['id']));
				$ownerUser = $ownerUser[0];
			}
		}
		else if(preg_match('/^(vu-get-user-gift-ticket){1}$/', $_POST['method'])){
			$search = new Search();
			$search->setText($_POST['search']);
			$search->setObj(new User($_POST['id']));
			
			$user = new User($_SESSION['id']);
			$user->setSearch($search);
			$user->setLimit(__LIMIT_USERS_PASS_TICKET__);
			
			$arrayObj = $apl->getUsers($user);
		}
		else if(preg_match('/^(vu-get-gift-ticket-form|vu-get-user-gift-ticket-step-confirm){1}$/', $_POST['method'])){
			if(preg_match('/^(vu-get-user-gift-ticket-step-confirm){1}$/', $_POST['method'])){
				$userRepass = new User($_POST['user']);
				$userRepass = $apl->getUsers($userRepass);
				$userRepass = $userRepass[0];
			}
			
			$ticket = new Ticket();
			$ticket->setUser(new User($_SESSION['id']));
			$ticket->setIdTicketPayment(empty($_POST['ticket']) ? $_POST['id'] : $_POST['ticket']);
			
			$aplEvent = new AplEvent();
			$ticket = $aplEvent->getPaymentTickets($ticket);
			$ticket = $ticket[0];
		}
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-user-gift-ticket-step-finish){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_SESSION['id']);
		$user->setCurrentPassword($_POST['password']);
		
		$userRepass = new User($_POST['user']);
		$userRepass = $apl->getUsers($userRepass);
		$userRepass = $userRepass[0];
		
		$ticket = new Ticket();
		$ticket->setUser($user);
		$ticket->setIdTicketPayment($_POST['ticket']);
		$aplEvent = new AplEvent();
		$ticket = $aplEvent->getPaymentTickets($ticket);
		$ticket = $ticket[0];
		$ticket->setUser($user);
		$ticket->setTime(time());
		
		$return = $aplEvent->repassTicket($ticket, $userRepass, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more|vu-get-followings-dashboard|vu-get-followings|vu-get-followings-load-more|vu-get-followers-page|vu-get-followers-page-load-more|vu-get-followings-page|vu-get-followings-page-load-more){1}$/', $_POST['method'])){
		if(preg_match('/^(vu-get-followers-page|vu-get-followers-page-load-more|vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method'])){
			$follow = new Follow(empty($_POST['last-id']) ? 0 : $_POST['last-id']);
			$follow->setUserFollowing(new User(empty($_POST['id']) ? 0 : $_POST['id']));
			$follow->setUserFollowing(preg_match('/^(vu-get-followers-dashboard|vu-get-followers|vu-get-followers-load-more){1}$/', $_POST['method']) ? new User($_SESSION['id']) : $follow->getUserFollowing());
			$follow->setIsFollowing(true);
			$follow->setIsLoadMore(preg_match('/^(vu-get-followers-page-load-more|vu-get-followers-load-more){1}$/', $_POST['method']));
			$follow->setLimit(__LIMIT_FOLLOWS_PAGE__);
			
			$arrayObj = $apl->getFollows($follow);
		}
		else{
			$follow = new Follow(empty($_POST['last-id']) ? 0 : $_POST['last-id']);
			$follow->setUserFollower(new User(empty($_POST['id']) ? 0 : $_POST['id']));
			$follow->setUserFollower(preg_match('/^(vu-get-followings-dashboard|vu-get-followings|vu-get-followings-load-more){1}$/', $_POST['method']) ? new User($_SESSION['id']) : $follow->getUserFollower());
			$follow->setIsFollower(true);
			$follow->setIsLoadMore(preg_match('/^(vu-get-followings-page-load-more|vu-get-followings-load-more){1}$/', $_POST['method']));
			$follow->setLimit(__LIMIT_FOLLOWS_PAGE__);
			//exit(var_dump($follow->getIsLoadMore()));
			
			$arrayObj = $apl->getFollows($follow);
		}
		
		require_once(__PATH__.'/view/user-follow-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-user-sign-up){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User();
		$user->post($_POST);
		$return = $apl->save($user, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-user-update){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User();
		$user->post($_POST);
		$user->setId($_SESSION['id']);
		$user->setTime(time());
		$return = $apl->update($user, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-user-bank-update){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_SESSION['id']);
		$user = $apl->getUsers($user);
		$user = $user[0];
		$user->setCurrentPassword($_POST['current-password']);
		
		$bank = new Bank();
		$bank->post($_POST);
		$bank->setUser($user);
		
		$return = $apl->updateBank($bank, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-user-password-update){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_SESSION['id']);
		$user->setCurrentPassword($_POST['current-password']);
		$user->setPassword($_POST['new-password']);
		$return = $apl->updatePassword($user, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-validate-url-person){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User();
		$user->setUrlSufix($_POST['val']);
		$return = $apl->verifyUrlSufix($user, $error);
		
		echo json_encode(array('isUrlPerson'=>true, 'feedback'=>$return, 'error'=>$error->getDataJSON()));
	}
	
	
	else if(preg_match('/^(vu-user-login|vu-user-login-go-back-page|vu-mob-user-login|vu-mob-user-connected-login){1}$/', $_POST['method'])){
		$user = new User();
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		
		if(preg_match('/^(vu-mob-user-connected-login){1}$/', $_POST['method']) && $_POST['id'] > 0){
			$user->setId($_POST['id']);
			$return = 1;
		
			$aplEvent = new AplEvent();
			$aplEvent->sicronyzeFill($_POST);
			$synchronizedData = $aplEvent->sicronyzeGet(true, NULL, $user);
		}
		else{
			$return = $apl->verifyLogin($user);
		}
		
		if($return == 1){
			if(strcasecmp($_POST['email'], 'vuupevents@gmail.com') == 0){
				$user->setId(4); // HACKCODE FOR GOPARTY
			}
		
			$user = $apl->getUsers($user);
			$user = $user[0];
			
			if($user->getStatus() == 1){
				$_SESSION['id'] = $user->getId();
				
				$value = empty($_POST['keep-me-connected']) ? 0 : $user->getId();
				$expire = empty($_POST['keep-me-connected']) ? 0 : __COOKIE_KEEP_CONNNECTED_TIME__;
				setcookie(__COOKIE_KEEP_CONNNECTED__, $value, $expire, '/');
			}
		}
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-get-send-organizer-event-message-in-page){1}$/', $_POST['method'])){
		$error = new Error();
		
		$event = NULL;
		$userTo = NULL;
		if($_POST['is-from-event'] == 1){
			$event = new Event($_POST['id']);
			$aplEvent = new AplEvent();
			$event = $aplEvent->getEvents($event);
			//if(is_array($event) && count($event) > 0){
				$event = $event[0];
				$userTo = $event->getUser();
		}
		else{
			$userTo = $apl->getUsers(new User($_POST['id']));
			$userTo = $userTo[0];
		}
		
		$userFrom = new User(empty($_SESSION['id']) ? 0 : $_SESSION['id']);
		$userFrom->setName($_POST['name']);
		$userFrom->setEmail($_POST['email']);
		if($userFrom->getId() > 0){
			$userFrom = $apl->getUsers($userFrom);
			$userFrom = $userFrom[0];
		}
		
		$contactMessage = new ContactMessage();
		$contactMessage->setUserTo($userTo);
		$contactMessage->setUserFrom($userFrom);
		$contactMessage->setEvent($event);
		$contactMessage->setMessage($_POST['message']);
		$contactMessage->setTime(time());
		
		$return = $apl->saveContactMessage($contactMessage, $error);
		
		require_once(__PATH__.'/view/contact-message-make.php');
	}
	
	
	else if(preg_match('/^(vu-user-follow|vu-user-unfollow-me){1}$/', $_POST['method'])){
		$userFollowing = new User($_SESSION['id']);
		if($userFollowing->getId() > 0){
			$follow = new Follow();
			$follow->setTime(time());
			
			if(preg_match('/^(vu-user-follow){1}$/', $_POST['method'])){
				$follow->setUserFollowing(new User($_SESSION['id']));
				$follow->setUserFollower(new User($_POST['id']));
			}
			else{
				$follow->setUserFollowing(new User($_POST['id']));
				$follow->setUserFollower(new User($_SESSION['id']));
			}
			
			$return = $apl->setUserFollow($follow);
			$isFollow = $apl->verifyUserAlreadyFollow($follow);
		}
		else{
			$_POST['old-method'] = $_POST['method'];
			$_POST['method'] = 'vu-get-user-login-form'; // TO GET LOGIN FORM
		}
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-save-forgot-password){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User();
		$user->setEmail($_POST['email']);
		
		$forgotPassword = new ForgotPassword();
		$forgotPassword->setUser($user);
		$forgotPassword->setTime(time());
		
		$return = $apl->setForgotPassword($forgotPassword, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	else if(preg_match('/^(vu-reset-forgot-password){1}$/', $_POST['method'])){
		$error = new Error();
		
		$user = new User($_POST['id']);
		$user->setPassword($_POST['password']);
		
		$forgotPassword = new ForgotPassword();
		$forgotPassword->setUser($user);
		$forgotPassword->setHash($_POST['hash']);
		
		$return = $apl->setPasswordByForgotPassword($forgotPassword, $error);
		
		require_once(__PATH__.'/view/user-make.php');
	}
	
	
	/*	//	exit('easda');
		if(preg_match('/^(vu-save-user|vu-mob-save-user){1}$/', $_POST['method'])){
			$user = new User();
			$user->post($_POST);
			$user->setStatus(1);
			$return = $apl->saveUser($user);
			
			if(preg_match('/^(vu-save-new-user){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(vu-update-user|vu-mob-update-user){1}$/', $_POST['method'])){
			$user = new User();
			$user->post($_POST);
			$user->setId($_POST['id']);
			$return = $apl->updateUser($user);
			
			
			if(preg_match('/^(vu-update-user){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(vu-update-password|vu-mob-update-password){1}$/', $_POST['method'])){
			$user = new User($_POST['id']);
			$user->setPassword($_POST['password']);
			$user->setCurrentPassword($_POST['current-password']);
			$return = $apl->updatePassword($user);
			
			if(preg_match('/^(vu-update-password){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(vu-remove-user|vu-mob-remove-user){1}$/', $_POST['method'])){
			$removeAccount = new RemoveAccount();
			$removeAccount->post($_POST);
			$return = $apl->deleteUser($removeAccount);
			
			if(preg_match('/^(vu-remove-user){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(vu-login|vu-mob-login){1}$/', $_POST['method'])){
			$user = new User();
			$user->setEmail($_POST['login']);
			$user->setPassword($_POST['password']);
			
			$return = $apl->verifyLogin($user);
			if($return == 1){
				$user = $apl->getUsers($user);
				$user = $user[0];
				$_SESSION['id'] = $user->getId();
				$_SESSION['type'] = $user->getType();
			}
			echo $return;
		}*/
		
		
		/*else if(preg_match('/^(gw-get-points|gw-js-get-points){1}$/', $_POST['method'])){
			$user = new User($_POST['id']);
			$user = $apl->getUsers($user);
			$user = $user[0];
			
			if(preg_match('/^(gw-get-points){1}$/', $_POST['method'])){
				echo $user->getPoints().'-SPMAIN-'.$user->getPosition();
			}
			else{
				echo json_encode(array('points'=>$user->getPoints(), 'position'=>$user->getPosition(), 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(gw-get-user-data|gw-js-get-user-data){1}$/', $_POST['method'])){
			$user = new User($_POST['id']);
			$arrayUsers = $apl->getUsers($user);
			
			// LAST LOGIN
				$user->setTime(time());
				$apl->updateLastUserConnection($user);
			
			$aplAdmin = new AplAdmin();
			$app = $aplAdmin->getApp();
			
			if(preg_match('/^(gw-get-user-data){1}$/', $_POST['method'])){
				header('Content-Type: text/html; charset=iso-8859-1');
				require_once(__PATH__.'/view/user-make-mobile.php');
			}
			else{
				require_once(__PATH__.'/view/user-make-mobile-json.php');
			}
		}
		
		
		else if(preg_match('/^(gw-js-get-user-data-by-facebook){1}$/', $_POST['method'])){
			$user = new User();
			$user->setIdFacebook($_POST['id-facebook']);
			$user->setEmail($_POST['email']);
			
			$return = $apl->getUserByFacebook($user);
			
			header('Content-Type: text/html; charset=iso-8859-1');
			if(is_object($return)){
				$user->setId($return->getId());
			
				// LAST LOGIN
					$user->setTime(time());
					$apl->updateLastUserConnection($user);
				
				$aplAdmin = new AplAdmin();
				$app = $aplAdmin->getApp();
				
				$arrayUsers = array($user);
				require_once(__PATH__.'/view/user-make-mobile-json.php');
			}
			else{
				echo json_encode(array('error'=>$return));
			}
		}
		
		
		else if(preg_match('/^(gw-send-promotional-code|gw-js-send-promotional-code){1}$/', $_POST['method'])){
			$promotionalCode = new PromotionalCode();
			$promotionalCode->setCode($_POST['promotional-code']);
			
			$user = new User($_POST['id']);
			$user->setPromotionalCode($promotionalCode);
			
			$return = $apl->sendPromotionalCode($user);
			
			if(preg_match('/^(gw-send-promotional-code){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(gw-send-exchange-product|gw-js-send-exchange-product){1}$/', $_POST['method'])){
			$user = new User($_POST['id-user']);
			
			$product = new product($_POST['id']);
			$product->setUser($user);
			
			$return = $apl->sendExchangeProduct($product);
			
			if(preg_match('/^(gw-send-exchange-product){1}$/', $_POST['method'])){
				echo $return;
			}
			else{
				echo json_encode(array('feedback'=>$return, 'error'=>-10));
			}
		}
		
		
		else if(preg_match('/^(gw-update-gcm-id){1}$/', $_POST['method'])){
			$user = new User($_POST['id']);
			$user->setGcmId($_POST['gcm-id']);
			
			$f = fopen('ARQUIVO.txt', 'w');
			fwrite($f, $_POST['id']."\r\n".$_POST['gcm-id']);
			fclose($f);
			
			$return = $apl->updateGcmId($user);
			echo $return;
		}
		
		
		else if(preg_match('/^(gw-teste-image){1}$/', $_POST['method'])){
			$file = fopen('ARQUIVO.txt', 'w');
			fwrite($file, $post['img-mime']."\r\n\r\n");
			fwrite($file, $_POST['img-image']);
			fclose($file);
		
			$binary = base64_decode($_POST['img-file']);
			header('Content-Type: bitmap; charset=utf-8');
			$file = fopen('teste.png', 'wb');
			fwrite($file, $binary);
			fclose($file);
		}
		
		
		
		
		
	// WEB AREA
		if(preg_match('/^(gw-do-login){1}$/', $_POST['method'])){
			$user = new User();
			$user->setEmail($_POST['login']);
			$user->setPassword($_POST['password']);
			$user->setType(1);
			
			$_SESSION['id-user'] = NULL;
			$return = 0;
			$aplUser = new AplUser();
			
			if($aplUser->verifyLogin($user) == 1){
				$user = $aplUser->getUsers($user);
				$user = $user[0];
				
				if($user->getType() == 1){
					$_SESSION['id-user'] = $user->getId();
					$return = 1;
				}
			}
			else{
				$user = $apl->getUserByEmail($user, false);
				$return = is_null($user) ? 0 : $user->getStatus();
			}
			
			echo $return;
		}*/
?>