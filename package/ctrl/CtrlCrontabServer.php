<?php
	session_start();
	@include_once('config/config.php');
	@include_once('../../config/config.php');
	require_once(__PATH__.'/package/apl/AplNotification.php');
	
	
	$apl = new AplNotification();
	
	if(preg_match('/^(gw-verify-dogs-in-wait-state)$/', $_GET['method'])){
		$user = new User();
		$user->setTime(time());
		
		$aplDog = new AplDog();
		$aplDog->verifyDogsInWaitState($user);
	}
	
	
	else if(preg_match('/^(gw-verify-alerts-dogs)$/', $_GET['method'])){
		$aplDog = new AplDog();
		$aplDog->sendAlerts();
	}
	
	
	else if(preg_match('/^(gw-verify-orders-to-deactivate)$/', $_GET['method'])){
		$aplOrder = new AplOrder();
		$aplOrder->deactivateOrdersOneTime();
	}
	
	
	else if(preg_match('/^(gw-verify-next-orders)$/', $_GET['method'])){
		$user = new User();
		$user->setTime(time());
		
		$aplOrder = new AplOrder();
		$aplOrder->getNextOrdersByUser($user);
		$aplOrder->getNextOrdersByWalker($user);
	}
?>