<!DOCTYPE html>
<html>
<head>
	<title>Seat layout</title>
	<link rel="stylesheet" type="text/css" href="/project/assets/css/layout.css">
	<script type="text/javascript" src='/project/assets/js/jquery.min.js'></script>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/common.php'); ?>
	<script type="text/javascript" src="/project/assets/js/layout.js"></script>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/nav.php'); ?>
	<div class="all-wrapper">
		<?php if(!isset($_SESSION['username']))header('Location: /project/account/login.php?error=2'); ?>
		<h1 style="font-weight:400;font-size:32px;text-align: center;padding:32px 0px;text-transform:uppercase;"> Select seats</h1>
		<div class="layout">
			<div class="seat-holder">
				<?php 
					require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/functions.php');
					require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/connection.php');
					$bus_id = $_GET['busid'];
					$date = $_GET['date'];
					$result = select_query("SELECT * FROM bus_layout where bus_id = '$bus_id'");
					$r = $result->fetch_assoc();
					$format = $r['seat_format'];
					$rows = $r['rows'];
					$_format = explode('+', $format);
					$left = $_format[0];
					$right = $_format[1];
					$k = 0;
					$user_id = $_SESSION['user_id'];
					$alphabets = ['a' ,'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm'];
					$sql = "SELECT * FROM bill r where r.bus_id = '$bus_id' and  r.date = '$date' and customer_id = '$user_id' ";
					$oc = mysqli_query($con, $sql);
						if(!$oc){
							echo "error retrieving occupied seats".mysqli_error($con);
							exit;
						}
						$occupied = array();
						#echo $sql;
						while($r = $oc->fetch_assoc()){
							$occupied[] = $r['seatNo'];
					}
					$sql = "SELECT b.*, bd.* FROM bus b, bus_details bd where b.bus_id = bd.bus_id and b.bus_id = '$bus_id'";
					$result = select_query($sql);
					$data = $result->fetch_assoc();
					$price = $data['price'];
					for ($i=0; $i < $rows; $i++): ?>
					<div class="row">
						<?php
							for ($j=0, $m = 0; $j < $left; $j++, $m++) { 
								$k++;
								$pos = $alphabets[$i]."".$m;
								$class = "available";
								for($k = 0; $k<sizeOf($occupied);$k++){
									if($pos == $occupied[$k]){
										$class = "reserved";
									}
								}
								echo "<svg fill='#000000' class='$class' data-location='$pos' data-price='$price' height='48' viewBox='0 0 24 24' width='48'><path d='M4 18v3h3v-3h10v3h3v-6H4zm15-8h3v3h-3zM2 10h3v3H2zm15 3H7V5c0-1.1.9-2 2-2h6c1.1 0 2 .9 2 2v8z'/></svg>";
							}
							echo "<span class='blank'></span>";
							for ($j=0; $j < $right; $j++, $m++) { 
								$k++;
								$pos = $alphabets[$i]."".$m;
								$class = "available";
								for($k = 0; $k<sizeOf($occupied);$k++){
									if($pos == $occupied[$k]){
										$class = "reserved";
									}
								}
								echo "<svg fill='#000000' class='$class' data-location='$pos' data-price='$price'  height='48' viewBox='0 0 24 24' width='48'><path d='M4 18v3h3v-3h10v3h3v-6H4zm15-8h3v3h-3zM2 10h3v3H2zm15 3H7V5c0-1.1.9-2 2-2h6c1.1 0 2 .9 2 2v8z'/></svg>";
							}
						?>
					</div>
				<?php		
					endfor;

				?>
			</div>
		</div>
		<div class="details">
			<?php
				$sql = "SELECT b.*, bd.* FROM bus b, bus_details bd where b.bus_id = bd.bus_id and b.bus_id = '$bus_id'";
				$result = select_query($sql);
				if(mysqli_num_rows($result) == 0){
					echo "<p style='text-align:center;padding:24px 0px'>No buses found for specific route</p>";
				} 		
				while($r = $result->fetch_assoc()): 
			?>
				<span class="heading"><?php echo $r['bus_name']; ?></span>
				<span class="sub">
					<?php 
						if($r['ac'] == 0)
							echo "Non A/C ";
						else
							echo "Volvo A/C ";
						echo $r['seat_format']; ?></span>
					</p>
				<div class="bus-timings"><?php echo "<span>Start time : ".$r['time_source']."</span> </br> <span> Destination time : ".$r['time_destination']."</span> </br><span> Duration: ".$r['duration']."</span>"; ?></div>
				<div class="seats">24 seats</div>
				
			<?php endwhile; ?>
			<p class="_p">Rs. <span id="amount">00</span></p>
			<a id="book-ticket" href="/project/account/checkout.php">Book Now</a>
		</div>
	</div>
</body>
</html>