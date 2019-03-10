<?php
			
	if(!isset($_GET['amount']) || !isset($_GET['seats'])|| !isset($_GET['date'])){
		print json_encode(array("type"=>"error", "text"=>"details are missing"));
		exit;
	}
	session_start();
	$amount = $_GET['amount'];
	$seats = $_GET['seats'];
	$date = $_GET['date'];
	$bus_id = $_GET['busid'];
	$userId = $_SESSION['user_id'];
	#split seats
	$seats = explode("|", $seats);

	#check date

	#construction of sql command

	#establish connection
	require_once($_SERVER['DOCUMENT_ROOT']."/project/assets/required/connection.php");

	#verifying if seats are unoccupied
	#echo sizeof($seats);
	
	#get userId



	$sql = "SELECT * FROM bill where bus_id = '$bus_id' and date = '$date' and seatNo in ( ";
	for ($i=0; $i < (sizeof($seats)-2); $i++) { 
		$sql .= "'$seats[$i]', ";
	}
	$sql.="'$seats[$i]' )";
	#echo $sql;

	$result = mysqli_query($con, $sql);
	if(!$result){
		echo mysqli_error($con);
		exit;
	}
	if(mysqli_num_rows($result)>0){
		print json_encode(array("type"=>"error", "text"=>"That was a dumb move of changing class and passing. your account is banned"));
		exit;
	}

	$sql = "INSERT INTO bill (bus_id, customer_id, seatNo, date, amount) VALUES";
	for ($i=0; $i < (sizeof($seats)-2); $i++) { 
		$sql.= "  ('$bus_id', '$userId', '$seats[$i]', '$date', '$amount'),";
	}
	$sql.= "  ('$bus_id', '$userId', '$seats[$i]', '$date', '$amount')";
	#echo $sql."</br>";
	$result = mysqli_query($con, $sql);
	#echo mysqli_error($con);
	print json_encode(array("type"=>"success", "text"=>"Tickets booked", "link"=>"/project/account/tickets.php"));
	mysqli_close($con);

?>