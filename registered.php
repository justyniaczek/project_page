<?php

	session_start();
	
	if(isset($_POST['udanarejestracja'])){
		header('Location:index.php');
		exit();
		
	}
	else{
		unset($_SESSION['udanarejestracja']);
	}
	require_once("includes/header.php");
	
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
</style>

<style>
.error{
	color:red;
	margin-top:10px;
	margin-bottom:10px;
}
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
					<h6> Dziekujemy za rejestracje,<br/>
						Teraz mozesz sie zalogowac!</h6>
					
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
	
?>
	
	
</body>
</html>