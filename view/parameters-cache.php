<?php
	$parameters = new Parameters();
	$parameters->setDataCorrectlyFromUrl($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	
	if($user->getId() > 0){
		// CACHE EVENT
			if(preg_match('/^(vu-get-event-payment-form){1}$/', $parameters->{'old-method'})){
				$eventCache = new Event($parameters->{'id'});
				$eventCache->setTicketsDayBoughtCorrectly($parameters->{'tickets-days'});
				$eventCache = $aplEvent->getEvents($eventCache);
				$eventCache = $eventCache[0];
			}
		
		// CACHE EVENT FAVORITE
			if(preg_match('/^(vu-event-favoriting){1}$/', $parameters->{'old-method'})){
				$eventCache = new Event($parameters->{'id'});
				$eventCache = $aplEvent->getEvents($eventCache);
				$eventCache = $eventCache[0];
				
				if($eventCache->getUser()->getId() != $user->getId()){
					$favorite = new Favorite();
					$favorite->setEvent($eventCache);
					$favorite->setUser($user);
					$favorite->setTime(time());
					
					if($aplEvent->verifyUserAlreadyFavorite($favorite) == 0){
						$isFavorite = $aplEvent->setEventFavorite($favorite);
					
						if($isFavorite == 1 && is_object($event)){
							$event->setIsFavorite($isFavorite);
						}
					}
				}
			}
			
		// CACHE USER FOLLOW
			if(preg_match('/^(vu-user-follow){1}$/', $parameters->{'old-method'})){
				$userFollowed = new User($parameters->{'id'});
				$follow = new Follow();
				$follow->setIsFollowing(true);
				$follow->setUserFollowing($user);
				$follow->setUserFollower($userFollowed);
				
				if($userFollowed->getId() != $user->getId()
					&& $aplUser->verifyUserAlreadyFollow($follow) == 0){
					$aplUser->setUserFollow($follow);
				}
			}
	}
?>