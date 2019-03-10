<?php

	if($_SERVER['REQUEST_METHOD']==='POST'){
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/functions.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/project/assets/required/connection.php');
		$u = $_POST['username'];
		$p = $_POST['password'];
		$n = $_POST['name'];
		$e = $_POST['email'];
		$result = select_query("SELECT * FROM customer where username = '$u'");
		if($result == -1){
			header('Location: http://localhost/project/account/sign_up.php?error=1');
		}
		$result = query("INSERT INTO customer (name, username, password, email) values ('$n', '$u', '$p', '$e')");
		if($result!== -1){
			session_start();
			$_SESSION['username'] = $u;
			$_SESSION['name'] = $e;
			$result = select_query("SELECT * FROM customer where username = '$u'");
			$data = $result->fetch_assoc();
			$_SESSION['user_id'] = $data['customer_id'];
			header('Location: http://localhost/project/');
			
		}
	}else{
		header('Location: http://localhost/project/');
	}

?>