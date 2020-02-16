<?php

session_start();
include('connect.php');
$id=$_GET['order'];

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

echo "$_SESSION[sum]";

mysqli_query($polaczenie, "UPDATE orders SET order_status='przetwarzanie', order_date= NOW()
 WHERE  fk_customers_id='$_SESSION[id]' AND order_status='niezatwierdzone'"); 


$result = mysqli_query($polaczenie, "SELECT * FROM orders WHERE order_status='przetwarzanie'");
$row=mysqli_num_rows($result);

 
header('location:koszyk.php');
mysqli_close($polaczenie);


?>