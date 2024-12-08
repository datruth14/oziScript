
<?php
		//cheching user if on lacal server use a specific db else use another
		//cheching user if on lacal server use a specific db else use another
		//cheching user if on lacal server use a specific db else use another
		if (substr_compare(getcwd(), ":", 1,1) == 0) {
		 //echo '<script>alert("You are working on a local machine AKA client Server")</script>';
		
			$server  = "localhost";
			$username = "localhost username eg(root)";
			$password = "localhost password eg( )";
			$database = "localhost database name eg(mydbname)";
		//connecting to server 
			$conn 	  = mysqli_connect($server, $username,$password, $database);
		//checking if connection was successful
			if ($conn) {
				//echo "<script>alert('Database Connected successfully')</script>";
			}else{
				echo "<script>alert('Error Found, Database Not Connected successfully')</script>";
			}
		
		}else{
		
		 //echo '<script>alert("You are working on a hosted machine AKA server")</script>';
			$server	  = "localhost";
			$username = "live server username eg(myusername)";
			$password = "live server password eg(mypassword)";
			$database = "live server database eg(mydbname)";
		//connecting to server 
			$conn 	  = mysqli_connect($server, $username,$password, $database);
		//checking if connection was successful
			if ($conn) {
				//echo "<script>alert('Database Connected successfully')</script>";
			}else{
				echo "<script>alert('Error Found, Database Not Connected successfully')</script>";
			}
		
		}