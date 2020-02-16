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

.result{
	width:50%;
	font-size:15px;
	padding: 15px 10px 10px 10px;
	text-align:center;
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
	
		<article>
			<section>
					<form action="logout.php" method="post">
						<input type="submit" value="WYLOGUJ SIE" class='button' />	
					</form><br>
					<form action="edytujsklep.php" method="post">
						<input type="submit" value="WROC"  class='button'/>	
					</form><br>
					<form action="adminpanel.php" method="post">
						<input type="submit" value="EDYCJA USEROW" class='button' style="width:250px"/>	
					</form>
					

			<div class="container" style="height: 1000px">
			
			
				<?php
					$id=$_GET['edit'];
				
					$result = mysqli_query($polaczenie, "SELECT * FROM plant WHERE id='$id'");
					$row=mysqli_num_rows($result);

					echo "</br></br><h2>Admin panel</h2></br>";
					echo "<h1>Edycja: </h1>";
			
						while($retrive=mysqli_fetch_array($result)){

							$id= $retrive['id'];
							$plant_name = $retrive['plant_name'];
							$latino_name=$retrive['latino_name'];
							$description= $retrive['description'];
							$price= $retrive['price'];
							$in_stock= $retrive['in_stock'];
							
							
							echo "Plant_name:<tr><form action=update-plants.php?edited=$id method=post>";
							echo "<td><input type= text name=e_plant_name value='$plant_name'></td></br></br>";
						
				
							echo "latino_name:";
							echo "</br><td><form action=form action=update-plants.php method=post>
								<textarea name='e_latino_name' cols='100' rows='10'>$latino_name</textarea>
								</br>";
							
						
							echo "description:";
							echo "</br><td><form action=form action=update-plants.php method=post>
								<textarea name='e_description' cols='100' rows='10'>$description</textarea>";
							
							
							echo "</br>price:</br><td><input type= text name=e_price value='$price'></td></br></br>";
							
							echo "in_stock:</br><td><input type= text name=e_in_stock value='$in_stock'></td></br></br>";
						
							echo "<input type=hidden name=id value='$id'>";
							echo "<td><input type=submit class='button'>";
							echo "</form></tr>";
						
						}
				?>			
					
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