<?php

	session_start();
	
	if ((isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		
	}else
	{header('Location: index.php');
		exit();}


	require_once "connect.php";
	
	if (isset($_POST["submit"]))
    {
        $conn = mysqli_connect("localhost", "root", "", "schema_suculent_shop");

        $plant_name = mysqli_real_escape_string($conn, $_POST["plant_name"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
		$latino_name = mysqli_real_escape_string($conn, $_POST["latino_name"]);
		$price = mysqli_real_escape_string($conn, $_POST["price"]);
		$in_stock = mysqli_real_escape_string($conn, $_POST["in_stock"]);

        $plant_name = htmlentities($plant_name);
        $description = htmlentities($description);
		$latino_name = htmlentities($latino_name);
		$price = htmlentities($price);
		$in_stock = htmlentities($in_stock);
		
		

        $total_image = count($_FILES["image"]["tmp_name"]);
        for ($a = 0; $a < $total_image; $a++)
        {
        	$tmp_name = $_FILES["image"]["tmp_name"][$a];
	    	$file_name = $_FILES["image"]["name"][$a];
	        $file_path = "images/" . $file_name;

	        $sql = "INSERT INTO plant(plant_name, latino_name, description, price, in_stock, path)
					VALUES('$plant_name', '$latino_name', '$description','$price','$in_stock' , '" . $file_name . "')";
	        mysqli_query($conn, $sql);
	        move_uploaded_file($tmp_name, $file_path);
        }
        $message = "Przedmiot dodany !!!";
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
  width: 80%;
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
				
				<div style="height:500px; width: 50%;
					margin: 0 auto">
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php } ?>

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div >
                            <label>Nazwa</label><br>
                            <input type="text" name="plant_name" />
                        </div><br>
						
						<div >
                            <label>Nazwa lacinska</label><br>
                            <input type="text" name="latino_name" />
                        </div><br>
						
						

                        <div class="form-group">
                            <label>Opis</label><br>
                            <textarea name="description" style="width: 550px; height:100px;"></textarea>
                        </div><br>
						
						<div >
                            <label>Price</label><br>
                            <input type="text" name="price" />
                        </div><br>
						
						<div >
                            <label>In stock</label><br>
                            <input type="text" name="in_stock" />
                        </div><br>
	
                         <label>Wybierz zdjecie</label><br>
                         <input type="file" name="image[]" multiple accept="image/*"  required /><br><br>
                      
                        <input type="submit" name="submit" value="Dodaj" class='button'/>
                    </form>
				</div>
 
			</div>
				
			</section>	
		</article>
				
	
	</main>

	<?php
	if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
	mysqli_close($conn);
?>
	
	
</body>
</html>