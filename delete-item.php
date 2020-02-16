<?php
include('connect.php');
$order_id=$_GET['del'];

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);


$result = mysqli_query($polaczenie, "DELETE FROM orders
WHERE order_id ='$order_id'");

header('Location:koszyk.php');
mysqli_close($polaczenie);


?>