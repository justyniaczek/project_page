<?php

	session_start();
	
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{	
	}
	else{
		header('Location: index.php');
		exit();
	}

	require_once("includes/header.php");
	require_once("includes/functions.php");
	require_once("connect.php");
	$polaczenie = mysqli_connect($host, $db_user, $db_password, $db_name) or die ($polaczenie);
	$msg= ""; $msg2=""; $msg3="";$msg4="";$msg5="";
	
	if(isset($_POST['submit'])){
		
		$e_first_name = mysqli_real_escape_string($polaczenie, $_POST['e_first_name']);
		$e_second_name =mysqli_real_escape_string($polaczenie, $_POST['e_second_name']);
		$e_email = mysqli_real_escape_string($polaczenie, $_POST['e_email']);
		$e_adress = mysqli_real_escape_string($polaczenie,$_POST['e_adress']);
		$e_adress2 = mysqli_real_escape_string($polaczenie,$_POST['e_adress2']);

		$good =true;
	
	
	if(strlen($e_first_name) < 3){
		$msg= '<div >Imie musi miec wiecej niz 3 litery!</div>';
		$good= false;
	}

	if(strlen($e_second_name) < 3){
		$good= false;
		$msg2= '<div >Nazwisko musi miec wiecej niz 3 litery!</div>';
	}
	
	
	if(!filter_var($e_email, FILTER_VALIDATE_EMAIL)){
		$good= false;
		$msg3= "<div class = 'error'>Wpisz poprawnie adres email!</div>";
	}
	

	if(email_exists($e_email, $polaczenie)){
		$good= false;
		$msg4= "<div class = 'error'>Email istnieje w bazie!</div>";
	}


	if(empty($e_adress)){
		$good= false;
		$msg5=  "<div class = 'error'>Pole adres nie moze byc puste!</div>";
	}

	
	if($good!=false)
	{
		$polaczenie->query("UPDATE customers SET first_name='$_POST[e_first_name]', second_name='$_POST[e_second_name]', email='$_POST[e_email]', adress='$_POST[e_adress]', adress2='$_POST[e_adress2]' WHERE id=$_POST[id]");
	
		$msg6 ="Dziekujemy za rejestracje";}
	}
	
		
?>

	
		<header>
		
			<div style="clear:both"></div>
			<div class="main_img">
			<img src="images/main.png" alt="grafika glowna sukulent"/>
		
			</div>
		</header>
		<article>
			<section>
			<div class="container" style="height: 800px">
				
				<div class="logowanie">
					<h6> WPROWADZ DANE DO EDYCJI :</h6>
						<form method="post" enctype="multipart/form-data" >
						<?php
						
						$result = mysqli_query($polaczenie, "SELECT *
											FROM customers WHERE id='$_SESSION[id]';");    
											
					
						$row=mysqli_num_rows($result);
					
						if($row>0)
						{						
							while($retrive=mysqli_fetch_array($result)){
								
								$first_name = $retrive['first_name'];
								$second_name=$retrive['second_name'];
								$email= $retrive['email'];
								$adress= $retrive['adress'];
								$adress2= $retrive['adress2'];				
								
						}}
							
						echo"<div class= 'form-group'>";
						echo "Imie:<br> ";
						echo "<td><input type= text name=e_first_name value='$first_name''></td>";
						echo "$msg<br><br>";
						echo "</div>";
						
						echo"<div class= 'form-group'>";
						echo "Nazwisko:</br><td><input type= text name=e_second_name value='$second_name'></td>";
						echo "$msg2</br></br>";
						echo "</div>";
						
						echo"<div class= 'form-group'>";
						echo "Email:</br><td><input type= text name=e_email value='$email'></td>";
						echo "$msg3 $msg4</br></br>";
						echo "</div>";

						echo"<div class= 'form-group'>";
						echo "Adres:</br><td><input type= text name=e_adress value='$adress'></td>";
						echo "$msg5 </br></br>";
						echo "</div>";
						
						echo"<div class= 'form-group'>";
						echo "Adres2:</br><td><input type= text name=e_adress2 value='$adress2'></td></br></br>";
						echo "</div>";
					
						echo "<input type=hidden name=id value='".$_SESSION['id']."'>";
						echo "<td><input type=submit name='submit' class ='button'>";
					
						
						?>
						</form>
						
						<br/><br/>
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