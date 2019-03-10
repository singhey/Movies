<?php

	if($_SERVER['REQUEST_METHOD']==='POST'){
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/functions.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/connection.php');
		$u = $_POST['username'];
		$p = $_POST['password'];
		echo $u;
		echo $p;
		$result = select_query("SELECT * FROM customer where username='$u' AND password = '$p'");
		if($result!== -1 && mysqli_num_rows($result)==1){
			session_start();
			$data = $result->fetch_assoc();
			$_SESSION['username'] = $data['username'];
			$_SESSION['user_id'] = $data['customer_id'];
			header('Location: http://localhost/project/');
		}else{
			header('Location: http://localhost/project/account/login.php?error=1');
		}
	}else{
		header('Location: http://localhost/project/');
	}

?>