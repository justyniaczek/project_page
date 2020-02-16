<?php

session_start();
include('connect.php');
$id=$_GET['add'];

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

mysqli_query($polaczenie, "INSERT INTO orders (fk_customers_id, fk_plant_id)
 VALUES ($_SESSION[id], $id)");
 
header('location:sklep.php');


?>