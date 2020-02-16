<?php
include('connect.php');
$order_id=$_GET['del'];

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);


	require_once "connect.php";
	
	$del_id=$_GET['del'];

	$result = mysqli_query($polaczenie, "DELETE FROM images
	WHERE id='$del_id'");
	
	header('Location:admin-images.php');
	mysqli_close($polaczenie);

?>