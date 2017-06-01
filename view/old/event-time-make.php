<?php
	$arrayEventTime = $event->getArrayEventTime();
	$tam = count($arrayEventTime);
	$html_EventTime = '';
	
	for($i = 0; $i < $tam; $i++){
		$indice = $i + 1;
		$date = date('d\/m\/Y', $arrayEventTime[$i]->getTimeInitAsNumber());
		
		$hourInit = (int)date('H', $arrayEventTime[$i]->getTimeInitAsNumber());
		$hourInit = new Hour($hourInit);
		$hourInit = $hourInit->getOptions();
		$minuteInit = (int)date('i', $arrayEventTime[$i]->getTimeInitAsNumber());
		$minuteInit = new Minute($minuteInit);
		$minuteInit = $minuteInit->getOptions();
		
		$hourEnd = (int)date('H', $arrayEventTime[$i]->getTimeEndAsNumber());
		$hourEnd = new Hour($hourEnd);
		$hourEnd = $hourEnd->getOptions();
		$minuteEnd = (int)date('i', $arrayEventTime[$i]->getTimeEndAsNumber());
		$minuteEnd = new Minute($minuteEnd);
		$minuteEnd = $minuteEnd->getOptions();
		
		$html_EventTime .= <<<HTML
			<li class="embed date">
				<div class="box-aux-date">
					<i class="fa fa-calendar icon-video"></i>
					<input type="text" id="fca-date-p-$indice" value="$date" placeholder="dd/mm/aaaa" />
				</div>
				<a href="#" class="remove-embed border-radius" title="Remover"><i class="fa fa-trash-o"></i></a>
				<div class="box-hour-minute">
					início
					<select id="fca-hour-init-p-$indice">
						$hourInit
					</select>
					:
					<select id="fca-minute-init-p-$indice">
						$minuteInit
					</select>
					&nbsp;&nbsp;
					término
					<select id="fca-hour-finish-p-$indice">
						$hourEnd
					</select>
					:
					<select id="fca-minute-finish-p-$indice">
						$minuteEnd
					</select>
				</div>
				<div class="cl"></div>
			</li>
HTML;
	}
	echo $html_EventTime;
?>