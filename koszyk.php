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
	require_once "connect.php";
	

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);				
			
					$result = mysqli_query($polaczenie, "SELECT first_name, second_name,email, adress, adress2 FROM customers WHERE id='$_SESSION[id]'");
					$row=mysqli_num_rows($result);
				
					
						
						while($retrive=mysqli_fetch_array($result)){

							$fname = $retrive['first_name'];
							$second_name=$retrive['second_name'];
							$email= $retrive['email'];
							$adress= $retrive['adress'];
							$adress2= $retrive['adress2'];

						}
?>		


	
		<header>
			<div style="clear:both"></div>
			<div class="main_img">
			<img src="images/main3.png" alt="grafika glowna sukulent"/>
			<div class="bottom-left"><h5>KOSZYK</h5></div>
			</div>
		</header>
		
		
		<article>
			<section>
			<div class="container" style="height: 1200px">
				<br><br><h2>KOSZYK</h2><br>
				<?php
					$result = mysqli_query($polaczenie, "SELECT *
											FROM customers 
											JOIN orders ON customers.id = orders.fk_customers_id
											JOIN plant ON orders.fk_plant_id = plant.id
											WHERE customers.id ='$_SESSION[id]' AND order_status='niezatwierdzone';");    
											
					
					$row=mysqli_num_rows($result);
				
			if($row>0)
					{
					
					echo "<br><br><table style='width:80%; border-spacing: 10mm'>";
						echo "  <tr>";
						echo "  <th>Nr</th>";
						echo "  <th>Nazwa</th>";
						echo "  <th>Latino name</th>";
						echo "    <th>Cena</th>";	
						echo "  </tr>";
						
						$i=0;
						$sum =0;
						
						
						
						while($retrive=mysqli_fetch_array($result)){
							
							$id= $retrive['id'];
							$name = $retrive['plant_name'];
							$lname=$retrive['latino_name'];
							$order_id= $retrive['order_id'];
							$price= $retrive['price'];
							
							$i++;
							$sum= $sum+$price;

							echo "  <tr align='center'>";
							echo "    <td>$i</td>";
							echo "    <td>$name</td>";
							echo "   <td>$lname</td>";
							echo "    <td>$price zl</td>";	
							echo "  <td><a href ='delete-item.php?del=$order_id'><button class='btn'>Usun </button></a>";	
							echo "  </tr>";
							
							

						}
							echo "<h1> Suma: $sum</h1>";	
							$_SESSION['sum'] = $sum;
							
				}
				else{
					echo "<h2> BRAK ZAMOWIEN</h2>";
				}
				?>	
				
			
			<div style="clear:both"></div>
				<br><br>
				<div class="koszyk" style=" font-size:15px; line-height: 30px; text-align:center">

						<?php
						
							if($row>0){
						echo "Imie: $fname<br>";
						echo "Nazwisko: $second_name<br>";
						echo "Email: $email<br>";
						echo "Adres: $adress<br>";
						echo "Adres 2: .$adress2";
						echo "  <td><a href ='account.php'><button class='btn'>Edytuj dane </button></a>";	
						echo "  <td align='center'><p><a href ='confirm_order.php?order=$id'><button class='btn'>Potwierdz zamowienie</button></a>";	
						
							}
						?>		
				
			</div>		
			
		</div>
		<article>
	<section>
	</main>
	<?php
		if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		mysqli_close($polaczenie);
	?>
	
</body>
</html>