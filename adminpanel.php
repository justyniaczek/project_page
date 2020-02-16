<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{}
	else{	
		header('Location: index.php');
		exit();
		}

	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	$output= "";
	if(isset($_POST['search'])){
		$searchq = $_POST['search'];
		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
		$query= mysqli_query($polaczenie,"SELECT * FROM customers WHERE first_name LIKE '%$searchq' OR second_name LIKE '%$searchq'") or die ("could not search");
		$count = mysqli_num_rows($query);
		
		if($count ==0){
			echo "No results !";
		}

		else{
			echo "<div class= 'result'>WYNIKI WYSZUKIWANIA: </div>";
			while($row  = mysqli_fetch_array($query)){
				$id = $row['id'];
				$first_name = $row['first_name'];
				$second_name = $row['second_name'];
				$email = $row['email'];
				$adress = $row['adress'];
				$adress2 = $row['adress2'];
				$output .= '<div class= "result"> ID: '.$id.' '.$first_name.'  '.$second_name.' '.$email.'  '.$adress.'  '.$adress2.'     <a href ="delete-admin.php?del=$id"><button>Delete</a></div>';
		
			}
		}
			
		echo "$output";
	
	}
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
 

<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="style1.css"/>

<link href="https://fonts.googleapis.com/css?family=Josefin+Sans%CLato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="shortcut icon" href="images/ikona.png">


<style > 
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
	padding: 20px 20px 20px 20px;
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
th, td , tr{
  padding: 10px;
  text-align: center;
}



</style>
</head>

<body>
	<main>
	
		<article>
			<section>
					<form action="logout.php" method="post">
						<input type="submit" value="WYLOGUJ"  class='button'/>	
					</form>
	
					<form action="edytujsklep.php" method="post">
						<input type="submit" value="EDYTUJ SKLEP" class='button'/>	
					</form>
					
					<form action="admin-images.php" method="post">
						<input type= "submit" value="GALERIA"  class='button'/>	
					</form>
					<form action="statystyki.php" method="post">
						<input type= "submit" value="STATYSTYKI"  class='button'/>	
					</form>	
					<form action="adminpanel.php" method="post">
						<input type="text" name="search" placeholder="Wyszukaj uzytkownikow"/>
						<input type= "submit" value="SZUKAJ"  class='button'/>	
					</form>	
					
					
					

			<div class="container" style="height: 500px">
			
			
				<?php
					$result = mysqli_query($polaczenie, "SELECT * FROM customers");
					$row=mysqli_num_rows($result);

					echo "<br><br><h2>Admin panel</h2><br>";
					echo "Zarejestrowanych uzytkownikow: ".$row;
				
					echo "<br><br><table style='width:80%; border-spacing: 6mm'>";
						echo "  <tr>";
						echo "  <th>Nr</th>";
						echo "  <th>Firstname</th>";
						echo "  <th>Lastname</th>";
						echo "    <th>Email</th>";
						echo "    <th>Adres</th>";
						echo "    <th>Adres2</th>";
						echo "    <th>Delete users</th>";
						echo "  </tr>";
						
						while($retrive=mysqli_fetch_array($result)){

							$id= $retrive['id'];
							$fname = $retrive['first_name'];
							$lname=$retrive['second_name'];
							$email= $retrive['email'];
							$adress= $retrive['adress'];
							$adress2= $retrive['adress2'];



							echo "  <tr >";
							echo "    <td>$id</td>";

							echo "    <td>$fname</td>";
							echo "   <td>$lname</td>";
							echo "    <td>$email</td>";
							echo "    <td>$adress</td>";
							echo "    <td>$adress2</td>";
							echo " <td><form action = 'delete-admin.php?del=$id' method='post'>
							<input type='submit' value='Delete' class='btn' />	
							</form></td>";
							echo "  </tr>";
						

						}
						echo "  </table>";
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