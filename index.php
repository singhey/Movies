<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	
	<link rel="stylesheet" type="text/css" href="/project/assets/css/index.css">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/common.php'); ?>
	<script type="text/javascript" src="/project/assets/js/suggestion.js"></script>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/nav.php'); ?>
	<div class="all-wrapper">
		<section class="search-holder">
			<form action="/project/pages/buses.php" method="GET">				
				<ul class="_holder">
					<li><input type="text" name="from" placeholder="From" id="from"><div id="from-parent" class="suggestion"></div></li>
					<li><input type="text" name="to" placeholder="To" id="to"><div id="to-parent" class="suggestion"></div></li>
					<li><input type="date" name="date"></li>
					<li><input type="submit" value="Search"></li>
				</ul>
			</form>
		</section>
	</div>
</body>
</html>