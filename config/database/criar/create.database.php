<?php
	require_once('../PACKAGE/USEFUL/GPSMAP/Database.php');
	
	$conn = new Database();
	
	// PEFFANS
	$conn->getConn()->query('CREATE DATABASE thiengo');
	echo '<strong>thiengo</strong>: '.(($conn->getConn()->affected_rows > 0) ? $conn->getConn()->affected_rows: 0).'<br />';
	
	$conn->getConn()->close();
