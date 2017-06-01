<?php
	$tam = count($arrayEventTime);
	$html_EventTime = '';
	
	for($i = 0; $i < $tam; $i++){
		$html_EventTime .= $arrayEventTime[$i]->getId();
		$html_EventTime .= '-SPDATA-';
		
		$html_EventTime .= 'http://www.mibec.com.br/evento/'.$arrayEventTime[$i]->getId().__COMP_URL_MOBILE__;
		$html_EventTime .= '-SPDATA-';
		
		$date = date('d\/m\/Y', $arrayEventTime[$i]->getTimeInit()).', ';
		$date .= date('H:i', $arrayEventTime[$i]->getTimeInit());
		$date .= $arrayEventTime[$i]->getTimeInit() < $arrayEventTime[$i]->getTimeEnd() ? ' - '.date('H:i', $arrayEventTime[$i]->getTimeEnd()) : '';
		$html_EventTime .= $date;
		$html_EventTime .= '-SPDATA-';
		
		$html_EventTime .= $arrayEventTime[$i]->getEvent()->getTitle();
		$html_EventTime .= '-SPMAIN-';
	}
	$html_EventTime = preg_replace('/(-SPMAIN-){1}$/', '', $html_EventTime);
	echo $html_EventTime;
?>