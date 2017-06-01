<?php
	class Gcm {
		public static function callGcm($arrayUsers, $message){
			if(count($arrayUsers) == 0){
				return(NULL);
			}
			
			$registrationIDs = array();
			for($i = 0, $tam = count($arrayUsers); $i < $tam; $i++){
				if(strlen(trim($arrayUsers[$i]->getGcmId())) > 0 && !in_array($arrayUsers[$i]->getGcmId(), $registrationIDs)){
					$registrationIDs[] = $arrayUsers[$i]->getGcmId();
				}
			}

			// Set POST variables
			$url = 'https://android.googleapis.com/gcm/send';

			$fields = array('registration_ids'=>$registrationIDs,
							'data'=>array('q'=>$message));
			$headers = array('Authorization: key='.__GOOGLE_API_KEY__,
							'Content-Type: application/json');

			// Open connection
			$ch = curl_init();

			// Set the url, number of POST vars, POST data
			curl_setopt( $ch, CURLOPT_URL, $url );

			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

			// Execute post
			$result = curl_exec($ch);

			// Close connection
			curl_close($ch);
			//echo $result;
		}
	}
?>