<?php
include('connect.php');
$id=$_GET['edit'];

$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

mysqli_query($polaczenie, "DELETE FROM customers WHERE id = '$id'");
header("Location:adminpanel.php")

?>