<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		
	}
	else
	{	header('Location: index.php');
		exit();}
	require_once("includes/header.php");
	require_once("connect.php");
	
	$msg= ""; $msg2=""; $msg3="";$msg4="";$msg5="";$msg6="";$msg7="";$msg8="";$msg9="";
	
	if(isset($_POST['submit'])){
		echo "dupa";
		
		$e_first_name = $_POST['e_first_name'];
		$e_second_name =$_POST['e_second_name'];
		echo "$e_first_name";
		
	}
		
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		
		$sql = "UPDATE customers SET first_name='$_POST[e_first_name]', 
				second_name='$_POST[e_second_name]', email='$_POST[e_email]', adress='$_POST[e_adress]',
				adress2='$_POST[e_adress2]' WHERE id=$_POST[id]";
		
		$rezultat = @$polaczenie->query($sql);	
		
	/*	header('Location: account.php');
*/
?>