<?php
	$arrayJson = array();
	
	if(preg_match('/^(vu-mob-get-event-users-confirmed|vu-mob-get-event-users-confirmed-load-more){1}$/', $_POST['method'])){
		$arrayJson = $arrayObj;
		//$tamI = count($arrayObj);
		/*for($i = 0; $i < $tamI; $i++){
			$arrayJson[] = $arrayObj[$i]->getDataJSON();
		}*/
		
	}
	else if(preg_match('/^(vu-mob-confirm-user-entered){1}$/', $_POST['method'])){
		$ticket = NULL;
		if(!empty($return)){
			$error = NULL;
		}
	}
	
	echo json_encode(array('feedback'=>$return,
							'usersConfirmed'=>$arrayJson,
							'ticket'=>(is_object($ticket) ? $ticket->getDataJSON() : NULL),
							'error'=>(is_object($error) ? $error->getDataJSON() : ''),
							'synchronizedData'=>$synchronizedData));
?>