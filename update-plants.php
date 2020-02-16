<?php

		require_once "connect.php";
		$id_edited=$_GET['edited'];
		echo "$id_edited";

		
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		
		mysqli_query($polaczenie, "UPDATE plant SET plant_name='$_POST[e_plant_name]', latino_name='$_POST[e_latino_name]',
		description='$_POST[e_description]', price='$_POST[e_price]', in_stock='$_POST[e_in_stock]' WHERE id = '$id_edited'");
		header('location:edytujsklep.php');
	
				
?>