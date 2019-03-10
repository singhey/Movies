<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/connection.php');

	$q =  $_GET['q'];
	$row = array();
	$result = select_query("SELECT city_name as city from suggestion where city_name LIKE '%$q%'");
	while($r = $result->fetch_assoc()){
		$row[] = $r;
	}
	echo json_encode($row);
?>