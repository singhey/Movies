<!DOCTYPE html>
<html>
<head>
	<title>Project | Buses</title>
	<link rel="stylesheet" type="text/css" href="/project/assets/css/buses.css">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/common.php'); ?>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/nav.php'); ?>
	<div class="legend"><?php echo $_GET['from'].'->'.$_GET['to'].'&nbsp;&nbsp;&nbsp;&nbsp;'.$_GET['date'];?></div>
	<?php
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/connection.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/functions.php');
		$source = $_GET['from'];
		$destination = $_GET['to'];
		$sql = "SELECT b.*, bd.* FROM bus b, bus_details bd where b.bus_id = bd.bus_id and source = '$source' and destination = '$destination'";
		/*echo $sql;*/
		$result = select_query($sql);
	?>
	<div class="all-wrapper">
		<?php
			if(mysqli_num_rows($result) == 0){
				echo "<p style='text-align:center;padding:24px 0px'>No buses found for specific route</p>";
			} 		
			while($r = $result->fetch_assoc()): 
		?>
		<div class="card">
			<div class="bus-icon">
				<img src="/project/assets/img/bus.png">
			</div>
			<div class="bus-details">
				<p>
					<span class="heading"><?php echo $r['bus_name']; ?></span>
					<span class="sub"><?php if($r['ac'] == 0)
						echo "Non A/C ";
						else
							echo "Volvo A/C ";
					 echo $r['seat_format']; ?></span>
				</p>
			</div>
			<div class="bus-timings"><?php echo $r['time_source']." -> ".$r['time_destination']."</br>".$r['duration']; ?></div>
			<div class="seats">24 seats</div>
			<div class="price">
				<p>
					<span class="amount"><?php echo "Rs ".$r['price']; ?></span>
					<a href="/project/pages/layout.php?busid=<?php echo $r['bus_id']."&date=".$_GET['date']; ?>">Book Now</a>
				</p>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
</body>
</html>