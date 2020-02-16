<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{	
	}
	else{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
 <meta charset="utf-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
 <title>Sukulenty</title>
 <meta name="description" content="sukulenty, kaktusy,sklep, kwiaciarnia."/>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <meta name="keywords" content="sukulenty, kaktusy,sklep, kwiaciarnia"/>
 <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
 
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="style1.css"/>


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

th, td {
  padding: 15px;
  text-align: center;
}

</style>
</head>

<body>
	<main>
	
		<article>
			<section>
					<form action="logout.php" method="post">
						<input type="submit" value="WYLOGUJ" class='button'  />	
					</form>

					<form action="adminpanel.php" method="post">
						<input type="submit" value="EDYCJA USEROW" class='button' style="width:250px"/>	
					</form>
					
					<form action="add-plants.php" method="post">
						<input type="submit"  value="DODAJ" class='button' style="width:250px"/>	
					</form>
					

			<div class="container" style="height: 500px">
			
				
				<?php
					$result = mysqli_query($polaczenie, "SELECT * FROM plant");
					$row=mysqli_num_rows($result);

					echo "<br><br><h2>Admin panel</h2><br>";
					echo "Przedmiotow w sklepie: ".$row;
				
					echo "<br><br><table style='width:80%; border-spacing: 15mm'>";
						echo "  <tr>";
						echo "  <th>Nr</th>";
						echo "  <th>Nazwa</th>";
						echo "  <th>Nazwa lacinska</th>";
						echo "    <th>Opis</th>";
						echo "    <th>Cena</th>";
						echo "    <th>In_stock</th>";	
						echo "    <th></th>";								

						echo "  </tr>";
					
						
						while($retrive=mysqli_fetch_array($result)){

							$id= $retrive['id'];
							$plant_name = $retrive['plant_name'];
							$latino_name=$retrive['latino_name'];
							$description= $retrive['description'];
							$price= $retrive['price'];
							$in_stock= $retrive['in_stock'];



							echo "  <tr >";
							echo "    <td>$id</td>";
							echo "    <td>$plant_name</td>";
							echo "   <td>$latino_name</td>";
							echo "    <td>$description</td>";
							echo "    <td>$price</td>";
							echo "    <td>$in_stock</td>";
							echo " <td><form action = 'edit-plants.php?edit=$id' method='post'>
							<input type='submit' value='Edytuj' class='btn' />	
							</form></td>";
							
						
							echo "  </tr>";

						}
				echo "</table>";?>			
					
			</div>
			</section>	
		</article>
				
	
	</main>

	<?php
		if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		mysqli_close($polaczenie);
	?>
	
	
</body>
</html>