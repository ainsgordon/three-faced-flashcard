<link rel="stylesheet" href="style.css" />


<ul>
        <li><a class="active" href="#flashcardapp">Flashcard App</a></li>
    </ul>


<?php
	require_once("session.php"); 
	require_once("final_functions.php");
	require_once("database.php"); //connect to database

	
	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
	}

	if (isset($_POST["submit"])) {
	  if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) && $_POST["password"] !== "") {
	    $username = $_POST["username"];
	    $password = $_POST["password"];
/////////////////////////////////////////////////////////////////////////////////////

			$query = "select FSUser_Name, Password, FSUser_ID from FS_User where FSUser_Name = ?"; //grabs the password and username from the form below
			$stmt = $mysqli -> prepare($query);
			$stmt -> execute([$username]);

			if($stmt){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				

				
				if(password_check($password, $row['Password'])) { //checks to see if the password the user entered matches password in database; if correct, launches user into website
					$_SESSION['username'] = $username;
					$_SESSION['id'] = $row['FSUser_ID'];
						redirect('home.php');
				} else {
					$_SESSION['message'] = 'password or username is wrong'; //if incorrect, redirects user to login page (index.php)
					redirect('index.php');
				}
			}
		
		
	
 
 
 
////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////////////////

		
	   else {
		  $_SESSION["message"] = "Username/Password not found";
		  redirect("index.php");
	   }	   
		
	  }
	}

	//below is form where users enter their username/password
	
?> 
	<p /><p />

	
	<div class='row' style="padding:100px;">
	<br>
	<h3>Login</h3>
	<br>
	

	<label for='left-label' class='left inline'>
	<form action="index.php" method="post" style="align-items:center;">
	  <p>&nbsp;&nbsp;Username:&nbsp;&nbsp;
		<input type="text" name="username"  />
	  </p>
	  <p>&nbsp;&nbsp;Password:&nbsp;&nbsp;
		<input type="password" name="password" value="" />
	  </p>
	  <br>
	  <input type="submit" name="submit" value="Submit" class="tiny round button" />
	</form>
	</label>
	<br>
	<br>
	<br>
	<a href='addLogin2.php'>Create an account >>>>></a>
	</div>


<?php 

Database::dbDisconnect(); //disconnect from database
?>
