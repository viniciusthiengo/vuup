<?php
	$ch = curl_init();
	
		$fields = array('api_token'=>'5700ed79ac55dab3c2f2835534ec833a',
						'account_id'=>'95b24750134930f8b0aaaff9e829ef91',
						'method'=>'credit_card',
						'test'=>true,
						'data'=>array(
							'number'=> 5488260399504125,
							'verification_value'=> 514,
							'first_name'=> 'Vinicius',
							'last_name'=> 'Thiengo',
							'month'=> 5,
							'year'=> 2016,
						));
		$fields_string = '';
		foreach($fields as $key=>$value){
			$fields_string .= $key.'='.$value.'&';
		}
		$fields_string = rtrim($fields_string, '&');
		
		$url = 'https://api.iugu.com/v1/payment_token';
		$headers = array('Content-Type: application/json');
		
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields) );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	// Set the url, number of POST vars, POST data
		/*$fields = array('api_token'=>'5700ed79ac55dab3c2f2835534ec833a', 'name'=>'TestThiengo', 'commission_percent'=>'3');
		$fields_string = '';
		foreach($fields as $key=>$value){
			$fields_string .= $key.'='.$value.'&';
		}
		$fields_string = rtrim($fields_string, '&');
		
		$url = 'https://api.iugu.com/v1/marketplace/create_account';
		$headers = array('Content-Type: application/json');
		//$headers = array('Content-Type: application/x-www-form-urlencoded');
		//$headers = array('Authorization: Basic 53d20287-2136-4fc2-a485-2c974fd1b5cc', 'Content-Type: application/json'); //, 'Content-Type: application/x-www-form-urlencoded');
		//$headers = array('WWW-Authenticate: Basic 53d20287-2136-4fc2-a485-2c974fd1b5cc:'); //, 'Content-Type: application/x-www-form-urlencoded');
		
		curl_setopt( $ch, CURLOPT_URL, $url );
		//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//curl_setopt($ch, CURLOPT_USERPWD, "5700ed79ac55dab3c2f2835534ec833a:");
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt( $ch, CURLOPT_USERPWD, '53d20287-2136-4fc2-a485-2c974fd1b5cc');
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		//curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields_string );
		//curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields) );
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);*/

	// Execute post
	
		$result = curl_exec($ch);
		var_dump($result);
		
		$request=  curl_getinfo($ch);
		var_dump($request);

	// Close connection
		curl_close($ch);
		
	
	//Iugu::setApiKey("seuApiToken");

	/*Iugu_Charge::create(Array(
		"token" = > "123AEAE123EA0kEIEIJAEI",
		"email" = > "teste@teste.com",
		"items" = > Array(
			Array(
				"description" = > "Item Um",
				"quantity" = > "1",
				"price_cents" = > "1000"
			)
		) ,
		"payer" = > Array(
			"name" = > "Item Um",
			"phone_prefix" = > "1",
			"phone" = > "1000",
			"email" => "teste@teste.com",
			"address" => Array(
				"street" => "Rua Tal",
				"number" => "700",
				"city" => "São Paulo",
				"state" => "SP",
				"country" => "Brasil",
				"zip_code" => "12122-00"
			)
		)
	));*/
	
	/*
		RETURN
			{
			"success": true,
			"message": "Autorizado",
			"invoice_id": "53B53D39F7AD44C4B8B873E15F067193"
		}
	*/
?>