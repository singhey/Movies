<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/common.php'); ?>
</head>
<body>
	<?php
		if(!isset($_SESSION['username']))header('Location: /project/account/login.php?error=2'); 
	?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/nav.php'); ?>
	<?php
		#establish connection
		require_once($_SERVER['DOCUMENT_ROOT']."/project/assets/required/connection.php");
		#check if all variables are recieved
	?>
	<link rel="stylesheet" type="text/css" href="/project/assets/css/tickets.css">
	<div class="all-wrapper">
		<section>
  <!--for demo wrap-->
			<h1>Booked ticket List</h1>
			<div class="tbl-header">
    			<table cellpadding="0" cellspacing="0" border="0">
    				<thead>
        				<tr>
							<th>Bus Name</th>
							<th>Seat no</th>
							<th>From</th>
							<th>To</th>
							<th>Date</th>
        				</tr>
					</thead>
				</table>
  			</div>
			<div class="tbl-content">
 		   		<table cellpadding="0" cellspacing="0" border="0">
    				<tbody>
    					<?php
    						$userId = $_SESSION['user_id'];
    						$sql = "SELECT GROUP_CONCAT(seatNo), date, amount, bus_id from bill where customer_id = $userId GROUP BY bus_id";
    						#echo $sql;
    						$result = mysqli_query($con, $sql);
    						$i = 1;
    						while($r = $result->fetch_assoc()):
    					?>
    					<tr>
    						<?php
    							#get screen location and no
    							$bus_id= $r['bus_id'];
    							$sql = "SELECT b.*, bd.* FROM bus b, bus_details bd where
    									b.bus_id = bd.bus_id AND
    									b.bus_id =  '$bus_id'
    									";
    							#echo $sql;
    							$bus_result = mysqli_query($con, $sql);
    							if(!$bus_result)
    								echo mysqli_error($con)."Error ocuured </br>";
    							$t = $bus_result->fetch_assoc();
    						?>
		       				<td><?php echo $t['bus_name']; ?></td>
	    	    			<td><?php echo $r['GROUP_CONCAT(seatNo)']; ?></td>
	    	    			<td><?php echo $t['source']; ?></td>
	        				<td><?php echo $t['destination']; ?></td>
	        				<td><?php echo $r['date']; ?></td>
	        				<!--  -->
        				</tr>
        				<?php
        					endwhile;
        				?>
   	 				</tbody>
    			</table>
			</div>
		</section>
	</div>
</body>
</html>