<link rel="stylesheet" type="text/css" href="/project/assets/css/nav.css">
<script type="text/javascript" src="/project/assets/js/nav.js"></script>
<header>
	<h1>BUS TICKET BOOKING</h1>
    <nav>
    	<div class="left" style="float:left;padding-left:16px;">
      <a href="/project">Home</a>
      <a href="/project/pages/promise.php">We Promise</a>
      <a href="/project/pages/about_us.php">About Us</a>
      <a href="/project/pages/contact_us.php">Contact us</a>
  </div>
      <div class="right" style="float:right;padding-right:16px;">
      	<?php if(!isset($_SESSION['username'])): ?>
 	     <a href="/project/account/login.php">Login</a>
		<a href="/project/account/sign_up.php">Sign Up</a>
	<?php endif;	?>
		<?php if(isset($_SESSION['username'])): ?>
			<a href="/project/account/account.php"><?php echo $_SESSION['username']; ?></a>
		<a href="/project/account/tickets.php">Tickets</a>
		<a href="/project/account/log_out.php">Log Out</a>
	<?php endif; ?>
	</div>
    </nav>
  </header>