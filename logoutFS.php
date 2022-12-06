<?php 

require_once("session.php"); 
require_once("final_functions.php");
require_once("database.php");
verify_login();



if (($output = message()) !== null) {
	echo $output;
}

session_destroy(); //logs users out of their account


////////////////////////////////////////////////////////////////////////////////////////


 redirect("index.php"); //launches them back to homepage
 

new_footer("Senior Project");	
Database::dbDisconnect($mysqli);

 ?>
