<?php

	session_start();

	require_once "connect.php";
	
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if(isset($_POST['search'])){
		$searchq = $POST['search'];
		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
		$query= mysql_query($polaczenie,"SELECT * FROM customers WHERE first_name LIKE '%$searchq' OR second_name LIKE '%$searchq' ") or die ("could not search");
		$count = mysql_num_rows($query);
		
		if($count ==0){
			echo "No results !";
		}
		
		else{
			while($row  = mysql_fetch_array($query)){
				$first_name = $row['first_name'];
				$second_name = $row['second_name'];
				$email = $row['email'];
				$output .= '<div> '.$first_name.' '.$last_name.'</div>';

			}
		}
			
	}
	
?>