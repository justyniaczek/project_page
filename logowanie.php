<?php

	session_start();
	require_once("includes/header.php");
	
?>

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
					<h6> LOGOWANIE:</h6>
					<form action="zaloguj.php" method="post">
		
						Email: <br /> <input type="text" name="login" /> <br />
						Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
						<input type="submit" class='button' value="Zaloguj się" />
					</form>
				<br>
				<form style="display: inline" action="loginadmin.php" method="get">
					  <button class="button">Zaloguj admin</button>
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
?>
	
	
</body>
</html>