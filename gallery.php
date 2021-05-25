<?php

	session_start();

	require_once("connect.php");
	require_once("includes/header.php");	
	
	$message = "";
    if (isset($_POST["submit"]))
    {
        $conn = mysqli_connect("localhost", "root", "", "schema_suculent_shop");

        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);

        $title = htmlentities($title);
        $description = htmlentities($description);

        $total_image = count($_FILES["image"]["tmp_name"]);
        for ($a = 0; $a < $total_image; $a++)
        {
        	$tmp_name = $_FILES["image"]["tmp_name"][$a];
	    	$file_name = $_FILES["image"]["name"][$a];
	        $file_path = "uploads/" . $file_name;

	        $sql = "INSERT INTO images(title, description, path) VALUES('$title', '$description', '" . $file_name . "')";
	        mysqli_query($conn, $sql);
	        move_uploaded_file($tmp_name, $file_path);
        }
        $message = "Zdjecie zostalo przeslane";
    }

?>

	
			<header class="clearfix">
				
				<div style="clear:both"></div>
				<div class="main_img">
				<img src="images/main.png" alt="grafika glowna sukulent"/>
				</div>
			<h6>GALERIA ZDJEC </h6>

			</header>
			<div class="container" style="height: 2000px;">
			<?php
			
			
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			$get = "select path, description from images";
			$result =mysqli_query($polaczenie,$get);
			while($row=mysqli_fetch_assoc($result)){
				$path= $row['path'];
				$description = $row['description'];
				?>
					<img src="uploads/<?php echo"$path";?>" alt = "<?php echo "$description";?>" 
						style=" padding:30px 30px 30px 30px " height='280' width='280'/> 
					<?php 
				}
					
		if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
				{
					
				?>
                    <h6>Dodaj zdjecie</h6>
					<div style="height:500px; width: 50%;
					margin: 0 auto">
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php } ?>

                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div >
                          <h1>Tytul</h1><br>
                            <input type="text" name="title" style="
								 width: 100%;
								  height: 30px;
								  padding: 12px 20px;
								  box-sizing: border-box;
								  border: 2px solid #ccc;
								  border-radius: 4px;
								  background-color: #ffff;
								  resize: none;
							
							" />
                        </div><br>

                        <div class="form-group">
                            <h1>Opis</h1><br>
                            <textarea name="description" style="
								 width: 100%;
								  height: 150px;
								  padding: 12px 20px;
								  box-sizing: border-box;
								  border: 2px solid #ccc;
								  border-radius: 4px;
								  background-color: #ffff;
								  resize: none;
							
							" ></textarea>
                        </div><br>

                        
                            <label>Select file</label><br>
                            <input type="file" name="image[]" multiple accept="image/*"  required /><br><br>
                      
                        <input type="submit" name="submit" value="Dodaj" style = "width:150px;  background-color: #4CAF50; 
						  border: none;
						  color: white;
						  padding: 15px 32px;
						  text-align: center;
						  text-decoration: none;
						  display: inline-block;"/>
                    </form>
				</div>
				<?php
				}?>
			
			</div>
			
			
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
	<?php
		if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
		mysqli_close($polaczenie);
	?>
	</main>
	</body>
</html>