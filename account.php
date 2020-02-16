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
	require_once("connect.php");
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
?>

		<header>
			<div style="clear:both"></div>
			<div class="main_img">
			<img src="images/main.png" alt="grafika glowna przedstawiajaca kwiat"/>
		
			</div>
		</header>
		<article>
			<section>
			<div class="container" style="height: 500px">
				
				<div class="logowanie">
					<h6> MOJE KONTO:</h6>
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
					
						echo "Imie: $first_name<br>";
						echo "<br>Nazwisko: $second_name<br>";
						echo "<br>Email: $email<br>";
						echo "<br>Adres: $adress<br>";
						echo "<br>Adres2: $adress2<br>";

					?>
					<br>
					<form action="edit.php" method="post">
					<input type="submit"  value="Edytuj" class='btn' style="width:200px"/>
				
				</form>
				<br>

				
				<form action="generatepdf.php" method="post">
			
				<input type="submit" value="Generuj PDF" class='btn' style="width:200px" /></form>
					
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
	if(isset($_SESSION['blad']))
	echo $_SESSION['blad'];
	mysqli_close($polaczenie);
?>
	
	
</body>
</html>