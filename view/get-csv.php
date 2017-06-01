<?php
	$csvName = 'go-party-emails.csv';
	$csvHandle = fopen($csvName, 'w'); // source do arquivo CSV.
	fputcsv($csvHandle, array('Nome', 'E-mail'), ';');
	
	$query = <<<SQL
		SELECT
			name,
			email
			FROM
				vu_user
			ORDER BY
				name ASC
SQL;
	$conn = new mysqli('localhost', 'root', 'root', 'vuup');
	$result = $conn->query($query);
	$conn->close();
	while($data = $result->fetch_object()){
		fputcsv($csvHandle, array(utf8_decode($data->name), $data->email), ';');
	}
	$result->free();
	fclose($csvHandle);
	
	header('Content-Type: text/x-csv'); // Content-Type: application/octet-stream // outros // Content-Type: application/force-download // IE 
	header('Content-Disposition: attachment; filename="'.$csvName.'"');
	echo file_get_contents($csvName);
?>