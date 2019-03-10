<?php

	function select_query($sql){
		global $con;
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo "<b>Error</b> ".mysqli_error($con)." </br>$sql".$sql;
			return -1;
		}
		return $result;
	}

	function query($sql){
		global $con;
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo "<b>Error</b> ".mysqli_error($con)." </br>$sql".$sql;
			return -1;
		}
		return 1;
	}

?>