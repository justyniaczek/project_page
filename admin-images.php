<?php

	session_start();
	
	if ( $_SESSION['zalogowany']!=true)
	{
			
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
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="style1.css" />


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
					
					

			<div class="container" style="height: 500px">
				<?php
			
			
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			$get = "select path, description,id from images";
			$result =mysqli_query($polaczenie,$get);
			while($row=mysqli_fetch_assoc($result)){
				$id= $row['id'];
				$path= $row['path'];
				$description = $row['description'];
				?>
					<img src="uploads/<?php echo"$path";?>" alt = 
					"<?php echo "$description";?>" style=" padding:10px 5px  10px " height='150' width='150'/>
					 <?php echo"<form action='delete-image.php?del=$id' method='post'>
						<input type='submit'  value='USUN' class='button' style='width:150px'/>	
					</form>";
				}?>
			
			
						
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