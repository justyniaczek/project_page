<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
	}
	else
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
<link rel="stylesheet" href="style.css"/>
<link rel="stylesheet" href="style1.css"/>


<link href="https://fonts.googleapis.com/css?family=Josefin+Sans%CLato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="shortcut icon" href="images/ikona.png">

<script  src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
    <!-- Bootstrap 4.0 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- TableSorter -->
    <script src="js/tablesorter.js"></script>
    <!-- Initializing TableSorter -->
    <script>
        $(document).ready( function () {
                $("#myTable").tablesorter();
        });
    </script>

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

  th.headerSortUp {
            background-color: #3399FF;
            background-repeat: no-repeat;
            background-position: center right;
        }
        th.headerSortDown {
            background-color: #3399FF;
            background-repeat: no-repeat;
            background-position: center right;
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
						<input type="submit" value="ADMIN PANEL" class='button' style="width:250px"/>	
					</form>
					

			<div class="container" style="height: 500px">
				 <div class="row">
            <div class="col-md-10 offset-md-1">
                <h1>Statystyki</h1>
				
				
				<?php
				$query = ("SELECT SUM(plant.price) as 'sumasprzedazy'
											FROM orders
											JOIN plant ON orders.fk_plant_id = plant.id
											WHERE order_status= 'przetwarzanie' ");
											
					$res = mysqli_query($polaczenie, $query);
					$data = mysqli_fetch_array($res);
					echo " Calkowita suma sprzedazy: $data[sumasprzedazy]<br><br>";
				?>
				
                <hr>
                <table class="table" id="myTable">
                  <thead class="thead-inverse">
                    <tr>
                      <th>#</th>
					  <th>Id</th>
                      <th>Nazwa</th>
                      <th>Cena</th>
                      <th>In stock</th>
					  <th>Kupionych sztuk</th>
					  <th>Suma ze sprzedazy</th>
                    </tr>
                  </thead>
                  <tbody>
                   
					<?php
					$result = mysqli_query($polaczenie, "SELECT *
											FROM plant");    
											
					$row=mysqli_num_rows($result);
			
					$nr =1;
					
					
										
					$numer =1;
					$id_number =1;
					
				
					if($row>0)
							{	
								while($retrive=mysqli_fetch_array($result)){
									
									$plant_id = $retrive['id'];
									$plant_name = $retrive['plant_name'];
									$price= $retrive['price'];
									$in_stock = $retrive['in_stock'];
									
									echo "<tr>";
									echo"<th scope='row'>$nr</th>";
									echo"<td>$plant_id</td>";
									echo"<td>$plant_name</td>";
									echo"<td>$price</td>";
									echo"<td>$in_stock</td>";
									
									$query2 = ("SELECT COUNT(fk_plant_id) as 'sum_of_saled_plant'
											FROM orders
											JOIN plant ON orders.fk_plant_id = plant.id
											WHERE order_status= 'przetwarzanie' AND plant.id = '$plant_id';");
									
									$results = mysqli_query($polaczenie, $query2);
									$datas = mysqli_fetch_array($results);
									
									echo"<td>$datas[sum_of_saled_plant]</td>";
									$total_sum = $datas['sum_of_saled_plant']*$price;
									echo"<td>$total_sum</td>";
									echo"</tr>";
									
									$nr= $nr+1;
			
								}
							}
		
				?>
                  </tbody>
                </table>
            </div>
			


			</div>
					
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