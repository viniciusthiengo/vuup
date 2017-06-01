<?php
	/*$query = <<<SQL
		SELECT
			id,
			id_event,
			id_user
			ip,
			time
			FROM
				vu_event_view
			WHERE
				id_event = 3
SQL;

	$conn = new mysqli('localhost', 'root', 'root', 'vuup');
	
	$resource = $conn->query($query);
	
	$data = NULL;
	$time = time();
	$count = 1;
	while($data = $resource->fetch_object()){
		$auxTime = mktime(0,0,0,date('m', $data->time),date('d', $data->time),date('Y', $data->time));
		
		if($time != $auxTime){
			echo $count.'<br />';
			
			$time = $auxTime;
			echo $data->id.' | ';
			echo $data->id_event.' | ';
			echo $data->id_user.' | ';
			echo $data->ip.' | ';
			echo $auxTime.' | ';
			echo date('Y-m-d', $auxTime).' | ';
			
			$query = <<<HTML
				INSERT INTO
					vu_event_report_data(id_event,
										type,
										time,
										amount)
					VALUES(3,
							3,
							$auxTime,
							$count)
					ON DUPLICATE KEY
						UPDATE
							amount = (amount + $count)
HTML;
			echo '<br />'.$query.'<br />';
			$count = 1;
		}
		else{
			$count++;
		}
	}
	$count--;
	//echo $count.'<br />';
	$query = <<<HTML
				INSERT INTO
					vu_event_report_data(id_event,
										type,
										time,
										amount)
					VALUES(3,
							3,
							$auxTime,
							$count)
					ON DUPLICATE KEY
						UPDATE
							amount = (amount + $count)
HTML;
	echo '<br />'.$query.'<br />';
	
	$resource->free();
	$conn->close();*/
	
	
	
	
	
	// TICKET SOLD
	/*$query = <<<SQL
			SELECT
				ve.id,
				vp.time time_payment,
				vptd.id_ticket_day,
				vpt.id_ticket
				FROM
					vu_event ve
					INNER JOIN
					vu_payment vp
						ON(ve.id = vp.id_event)
					INNER JOIN
					vu_payment_ticket_day vptd
						ON(vp.id = vptd.id_payment)
					INNER JOIN
					vu_payment_ticket vpt
						ON(vptd.id = vpt.id_payment_ticket_day)
					INNER JOIN
					vu_event_ticket_day vtd
						ON(vptd.id_ticket_day = vtd.id)
				WHERE
					vp.status = 1
					AND
					vp.id_event = 3
				ORDER BY
					vptd.id_ticket_day ASC,
					vpt.id_ticket ASC,
					vp.time ASC
SQL;

	$conn = new mysqli('localhost', 'root', 'root', 'vuup');
	
	$resource = $conn->query($query);
	
	$data = NULL;
	$time = 0;
	$count = 1;
	$idTicketDay = 0;
	$idTicket = 0;
	while($data = $resource->fetch_object()){
		$auxTime = mktime(0,0,0,date('m', $data->time_payment),date('d', $data->time_payment),date('Y', $data->time_payment));
		
		//if($time != $auxTime || $idTicketDay != $data->id_ticket_day || $idTicket != $data->id_ticket){
			$time = $auxTime;
			$idTicketDay = $data->id_ticket_day;
			$idTicket = $data->id_ticket;
			
			$query = <<<SQL
				INSERT INTO
						vu_event_report_ticket(id_event,
												id_ticket_day,
												id_ticket,
												time,
												amount)
						VALUES($data->id,
								$idTicketDay,
								$idTicket,
								$auxTime,
								$count)
						ON DUPLICATE KEY
							UPDATE
								amount = (amount + $count);
SQL;
			echo $query.'<br />';
	}
	
	$resource->free();
	$conn->close();*/
?>