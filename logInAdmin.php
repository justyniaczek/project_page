<?php

	session_start();
	
	require_once("includes/header.php");
	require_once "connect.php";

?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
 <meta charset="utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
 <title>Sukulenty sklep</title>
 <meta name="description" content="sukulenty, kaktusy,sklep, kwiaciarnia."/>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <meta name="keywords" content="sukulenty, kaktusy,sklep, kwiaciarnia"/>
 <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
 
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="style.css"/>

<link href="https://fonts.googleapis.com/css?family=Josefin+Sans%CLato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="shortcut icon" href="images/ikona.png">

<style> 
a {     
text-decoration: none; 
} 


input[type=text] {
  width: 20%;
  padding: 11px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

input[type=password] {
  width: 20%;
  padding: 11px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

.button {
width:150px; 
height:40px;
 background-color: #4CAF50; 
border: none;
color: white;
padding: 12px 32px;
text-align: center;
text-decoration: none;
display: inline-block;}


</style>
</head>

<body>
	<main>
		<header>
			
			
			<div style="clear:both"></div>
			<div class="main_img">
			<img src="images/main.png" alt="grafika glowna sukulent"/>
			<div class="bottom-left"><h5>Zaloguj się</h5></div>
			</div>
		</header>
		<article>
			<section>
			<div class="container" style="height: 400px">
				
				<div class="logowanie">
					<h6> LOGOWANIE ADMIN:</h6>
					<form action="admin.php" method="post">
	
					Login: <br /> <input type="text" name="login" /> <br />
					Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
					<input type="submit" value="Zaloguj się" class='button' />
				
				</form>
				</div>
				
			</div>
		</section>	
		</article>
	
	<div style="clear:both"></div>
	<footer>
		<div class="footerek">
			<div class="footer_kafelek">
				<h4>	Lorem ipsum dolor sit amet,</h4>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut laboreLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
			</div>
		
		</div>
		<div class="bottombar">
		WYKONANIE STRONY: JUSTYNA REPLIN 2019
		</div>
	</footer>
	</main>

	<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
	mysqli_close($polaczenie);
	?>
	
	
</body>
</html>