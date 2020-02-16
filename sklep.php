<?php

	session_start();
	
	require_once("includes/header.php");
	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

?>
		<header>
			
			<div style="clear:both"></div>
			<div class="main_img">
			<img src="images/main.png" alt="zdjecie glowne sukulent"/>
			<div class="bottom-left"><h5>Sklep</h5></div>
			</div>
		</header>
		
		
		<article>
			<section>
		
				
			
			<?php
				
					$result = mysqli_query($polaczenie, "SELECT * FROM plant ");
							
							while($retrive=mysqli_fetch_array($result)){

								$id= $retrive['id'];
								$plant_name = $retrive['plant_name'];
								$latino_name=$retrive['latino_name'];
								$price= $retrive['price'];
								$description= $retrive['description'];
								$in_stock= $retrive['in_stock'];
								$path= $retrive['path'];
								
								echo"<div class='sztuka'> <div class='image-plant'>";
								?>
								<img src="images/<?php echo"$path";?>" alt = "<?php echo "$description";?>" 
								style=" padding:15px 15px 15px 15px " height='180' width='180'/></div>;
								
								
								<div class="sztuka1">
									<?php
									
									
									echo"<h2>$plant_name</h2><br>";
									echo"Nazwa lacinska: $latino_name<br>";
									echo"Cena: $price<br><br>";
									echo"$description";
									
									if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
									
									echo "<br><br><a href ='add.php?add=$id'><button class='buttn' >KUP</a>";}
									
									
									echo"</div>";
								echo"</div>";
								}
			
			?>
					
					
			</section>
		
			</article>
						
				<div style="clear:both"></div>
	<footer>
		<div class="footerek">
			<div class="footer_kafelek">
				<h4>Nam non diam est. </h4>
				Vivamus finibus ornare est ac tincidunt. Etiam ac magna dapibus, fermentum tortor nec, convallis leo. Nam non diam est. Quisque vulputate sit amet justo vestibulum pellentesque. Suspendisse aliquam sit amet dui at malesuada. Proin non sagittis 
			</div>
			<div class="footer_kafelek">
				<h4>Nam non diam est. </h4>
				Vivamus finibus ornare est ac tincidunt. Etiam ac magna dapibus, fermentum tortor nec, convallis leo. Nam non diam est. Quisque vulputate sit amet justo vestibulum pellentesque. Suspendisse aliquam sit amet dui at malesuada. Proin non sagittis 
			</div>
			<div class="footer_kafelek">
				<h4>Nam non diam est. </h4>
				Vivamus finibus ornare est ac tincidunt. Etiam ac magna dapibus, fermentum tortor nec, convallis leo. Nam non diam est. Quisque vulputate sit amet justo vestibulum pellentesque. Suspendisse aliquam sit amet dui at malesuada. Proin non sagittis 
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