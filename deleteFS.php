

<?php 

require_once("session.php"); 
require_once("included_functions.php");
require_once("database.php"); //connects to database

$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
	echo $output;
}

	$query2 = "SET FOREIGN_KEY_CHECKS=0;";
	  $stmt2 = $mysqli -> prepare($query2);
	  $stmt2 -> execute();




	
  	if (isset($_GET["id"]) && $_GET["id"] !== "") {
				
	  $query = "delete from Flashcard_Set where Set_ID=?"; //deletes a flashcard set of a certain ID (i.e. user clicks red X in read)
	  $stmt = $mysqli -> prepare($query);
	  $stmt -> execute([$_GET["id"]]);

  
		if ($stmt) {
			$_SESSION["message"] =  "Deleted!";

		}
		else {
			$_SESSION["message"] =  "Could not be deleted";

		}
		
		
		redirect('home.php');

		
//////////////////////////////////////////////////////////////////////////////////////				
	}
	else {
		$_SESSION["message"] = "Set could not be found!";
		redirect("home.php");
	}

			
			

new_footer("Ainsley Gordon Senior Project"); 
Database::dbDisconnect(); //disconnects from database

?>