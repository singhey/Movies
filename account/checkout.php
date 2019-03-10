<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/common.php'); ?>
	<link rel="stylesheet" type="text/css" href="/project/assets/css/checkout.css">
	<script type="text/javascript" src="/project/assets/js/checkout.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION['username']))header('Location: /project/account/login.php?error=1'); 
	?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/nav.php'); ?>
	<?php
		#establish connection
		require_once($_SERVER['DOCUMENT_ROOT']."/project/assets/required/connection.php");
		#check if all variables are recieved
		require_once($_SERVER['DOCUMENT_ROOT']."/project/assets/required/functions.php");
	?>
	<div class="all-wrapper">
		<form class="checkout" id="complete-purchase" method="GET" action="/project/account/book_ticket.php">
		    <div class="checkout-header">
		      <h1 class="checkout-title">
		        Checkout
		        <span class="checkout-price"><?php echo $_GET['amount']; ?></span>
		      </h1>
		    </div>
		    <p>
		      <input type="text" class="checkout-input checkout-name" placeholder="Name" autofocus>
		      <input type="text" class="checkout-input checkout-exp" placeholder="MM">
		      <input type="text" class="checkout-input checkout-exp" placeholder="YY" >
		    	<input type="text" id="date"  style="display:none" name='date'
		    		<?php
		    			echo "value='".$_GET['date']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="amount"
		    		<?php
		    			echo "value='".$_GET['amount']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="busid"
		    		<?php
		    			echo "value='".$_GET['busid']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="seats"
		    		<?php
		    			echo "value='".$_GET['seats']."'";
		    		?>
		    	/>
		    </p>
		    <p>
		      <input type="text" class="checkout-input checkout-card" placeholder="4111 1111 1111 1111">
		      <input type="text" class="checkout-input checkout-cvc" placeholder="CVC">
		    </p>
		    <p>
		      <input type="submit" value="Purchase" class="checkout-btn">
		    </p>
		  </form>
	</div>
</body>
</html>