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
require_once("included_functions.php");
require_once("database.php");
verify_login(); //connects to database and verifies users are logged in

 
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
	echo $output;
}



	echo "<div class='row'>";
	echo "<h3>Create Cards</h3>";
	echo "<label for='left-label' class='left inline'>";
	//echo "<center>";
	

	if (isset($_POST["submit"])) {
		if( (isset($_POST["side1"]) && $_POST["side1"] !== "") && (isset($_POST["side2"]) && $_POST["side2"] !== "") &&(isset($_POST["side3"]) && $_POST["side3"] !== "") && (isset($_POST["setID"]) && $_POST["setID"] !== "")) {
//////////////////////////////////////////////////////////////////////////////////////////////////
					
					$query3 = "INSERT INTO FlashCard (FlashCard.Side1, FlashCard.Side2, FlashCard.Side3, FlashCard.Set_ID) VALUES (?,?,?,?)"; //grabs the three faces and set ID from the form below, inserts them into the database
					$id = $_GET["id"];
					
					$stmt3 = $mysqli->prepare($query3);
					$stmt3 -> execute([$_POST["side1"],$_POST["side2"],$_POST["side3"],$_POST["setID"]]);
					
					
					if($stmt3) {
						$_SESSION["message"] = $_POST["side1"]." has been added";
                        redirect("create3.php?id=".urlencode($_POST["setID"]));
					}else {
						$_SESSION["message"]="Error adding ".$_POST["side1"]." ";
                        redirect("create3.php?id=".urlencode($_POST["setID"]));
					}
						
					
		
					
//////////////////////////////////////////////////////////////////////////////////////////////////


		}
		else {
				$_SESSION["message"] = "Unable to add card.";
				redirect("create3.php?id=".urlencode($id));
		}
	}
	else {
//////////////////////////////////////////////////////////////////////////////////////////////////

					
					echo "<form action = 'create3.php' method='post'>"; 
                    echo "Side 1: <input type = text name='side1'/>"; 
                    echo "Side 2: <input type = text name='side2'/>"; 
                    echo "Side 3: <input type = text name='side3'/>"; 
                    echo "<input type ='hidden' name='setID' value='".$_GET['id']."'/>"; //hidden value that grabs setID for later use
                    echo "<p><input type = 'submit' name= 'submit' value= 'Add' class = 'button tiny round'/>"; //form that creates flashcards
					     
				

				
					
					
			echo "</form>";		
//////////////////////////////////////////////////////////////////////////////////////////////////
				
	}
	//echo "</center>";
	echo "</label>";
	echo "</div>";
	

?>

<?php
if (isset($_GET["id"]) && $_GET["id"] !== "") { //displays the flashcards that users make as they make them
    
	$query = "SELECT * from FlashCard natural join Flashcard_Set where Set_ID = ?";
	$stmt = $mysqli->prepare($query);
	$stmt -> execute([$_GET["id"]]);


	if ($stmt)  {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Set Name</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "      <tr><th></th><th>Side 1</th><th>Side 2</th><th>Side 3</th>";
		echo "  </thead>";
		echo "  <tbody>";
	   
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$side1 = $row["Side1"];
			$side2 = $row["Side2"];
			$side3 = $row["Side3"];


			echo "<tr>";
			echo "<td><a href='deleteSpecificFS.php?id=".urlencode($setID)."' style='color:red' onclick='return confirm(\"Are you sure you want to delete?\");'>X</a></td>"; //option to delete flashcard
			echo "<td>".$side1."</td>";
			echo "<td>".$side2."</td>";
			echo "<td>".$side3."</td>";
			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";
		echo "</center>";
		echo "</div>";

		echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>";






		
///////////////////////////////////////////////////////////////////////////////////////////

	   
	}
	
	else {
		$_SESSION["message"] = "Set could not be found!";
		redirect("home.php");
	}
}


///////////////////////////////////////////////////////////////////

// Disconnect from database


new_footer("Senior Project");	
Database::dbDisconnect($mysqli);

?>