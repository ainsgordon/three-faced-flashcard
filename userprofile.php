<link rel="stylesheet" href="style.css" type="text/css">

<header>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a class="active" href="create2.php">Create a Set</a></li>
            <li style="float:right"><a href="userprofile.php">User Profile</a></li>
        </ul>
</header>

<?php

require_once("session.php"); 
require_once("final_functions.php");
require_once("database.php");
verify_login(); //connects to database and verfies login


$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	if (($output = message()) !== null) {
		echo $output;
	}
	
echo "<br>";
echo "<div>";

echo"<h2>Hello, ".$_SESSION['username']."!</h2>"; //displays username

echo"<br>";


echo "<p />";
echo "<a href='logoutFS.php'>Logout</a>"; //uses logout.php to log user out
echo "</center>";
echo "</div>";



new_footer("Senior Project");	
Database::dbDisconnect($mysqli); //disconnects from database


?>