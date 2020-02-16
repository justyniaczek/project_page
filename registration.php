<?php

	session_start();
	require_once("includes/header.php");
	
	if(isset($_POST['email']))
	{//walidacja formularza 
		$validation = true;
		
		$polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name) or die($polaczenie);
		$first_name = mysqli_real_escape_string($polaczenie, $_POST['first_name']);
		$second_name = mysqli_real_escape_string($polaczenie, $_POST['second_name']);
		$email = mysqli_real_escape_string($polaczenie,$_POST['email']);
		$pass =$_POST['pass'];
		$pass1 = $_POST['pass1'];
		$adress =mysqli_real_escape_string($polaczenie,$_POST['adress']);
		$adress2 = mysqli_real_escape_string($polaczenie,$_POST['adress2']);
		
		
		if($pass!=$pass1){
			$validation =false;
			$_SESSSION['e_pass']='Hasla sa rozne!';
			
		}
		$password_hash =password_hash($pass, PASSWORD_DEFAULT);
		
		if(!isset( $_POST['regulamin'])){
			$validation= false;
			$_SESSION['e_regulamin']='Przed rejestracja zaakceptuj regulamin';
		}
	

		
		if(strlen($pass)<8 || strlen($pass)>20)
		{
			$validation= false;
			$_SESSION['e_pass'] = 'Haslo musi miec 8 - 20 znakow!';
		}
		
		if(strlen($first_name)<3){
			$validation =false;
			$_SESSION['e_first_name']='Pole imie jest zbyt krotkie!';
			
		}
		
		if(strlen($second_name)<1){
			$validation =false;
			$_SESSION['e_second_name']='Pole nazwisko nie moze byc puste!';	
		}
		
		if(strlen($adress)<1){
			$validation =false;
			$_SESSION['e_adress']='Pole adres nie moze byc puste!';	
		}
		
		$email = $_POST['email'];
		$emailB= filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email)){
			$validation= false;
			$_SESSION['e_email'] = "Podaj poprawny adres email!";
		}
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		
		$polaczenie->connect_errno!=0;
		$result = $polaczenie->query("SELECT id FROM customers 
		WHERE email='$email'");
				
		$mails = $result-> num_rows;
		if($mails>0){
			$validation = false;
			$_SESSION['e_email'] = "Istnieje konto o podanym emailu";
		} 	
			
		if ($validation==true){
			$pass= md5($pass);
			if($polaczenie->query("INSERT INTO customers VALUES (NULL,'$first_name','$second_name', '$email', '$pass',
			'$adress','$adress2')"))
			{
				$_SESSION['udanarejestracja']=true;
				header('Location: registered.php');
				
			}
			
		}
	}
	
	
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


a {     
text-decoration: none; 
} 

input[type=text] {
  width: 30%;
  padding: 11px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}


input[type=password] {
  width: 30%;
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
			<div class="bottom-left"><h5> Zarejestruj sie</h5></div>
			</div>
		</header>
		<article>
			<section>
			<div class="container" style="height: 800px">
				
				<div class="logowanie">
					<h6> Rejestracja:</h6>
					<form method="post">
					
	
					Imie: <br /> <input type="text" name="first_name" /> <br />
					<?php
						if(isset($_SESSION['e_first_name']))
						{
							echo '<div class="error">'.$_SESSION['e_first_name'].'</div>';
							unset($_SESSION['e_first_name']);	
						}
					?>
					
					
					Nazwisko: <br /> <input type="text" name="second_name" /> <br /><br />
						<?php
						if(isset($_SESSION['e_second_name']))
						{
							echo '<div class="error">'.$_SESSION['e_second_name'].'</div>';
							unset($_SESSION['e_second_name']);	
						}
					?>
					
					
					
					Email: <br /> <input type="text" name="email" /> <br /><br />
					<?php
						if(isset($_SESSION['e_email']))
						{
							echo '<div class="error">'.$_SESSION['e_email'].'</div>';
							unset($_SESSION['e_email']);	
						}
					?>
					
					
					Haslo: <br /> <input type="password" name="pass" /> <br /><br />
					
					<?php
						if(isset($_SESSION['e_pass']))
						{
							echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
							unset($_SESSION['e_pass']);	
						}
					?>
					
					
					Powtorz haslo: <br /> <input type="password" name="pass1" /> <br /><br />		
					
					Adres: <br /> <input type="text" name="adress" /> <br /><br />
					<?php
						if(isset($_SESSION['e_adress']))
						{
							echo '<div class="error">'.$_SESSION['e_adress'].'</div>';
							unset($_SESSION['e_adress']);	
						}
					?>
					
					Adres 2: <br /> <input type="text" name="adress2" /> <br /><br />
					
					<label>
					Akceptacja regulaminu:
					<input type= "checkbox" name="regulamin"/><br/><br/>
					</label>
					<?php
						if(isset($_SESSION['e_regulamin'])){
							echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
							unset($_SESSION['e_regulamin']);
						}
					?>
					
					
					<input type="submit" value="Zarejestruj sie" class='button' />
				
				</form>
					
					
				
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