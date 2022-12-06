<link rel="stylesheet" href="style.css" />

    <ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="create2.php">Create a Set</a></li>
        <li style="float:right"><a href="userprofile.php">User Profile</a></li>
    </ul>

    <br>
    <br>
    <br>

<br>
<br>
<br>


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



if (isset($_GET["id"]) && $_GET["id"] !== "") {
    
            $query = "SELECT * from FlashCard natural join Flashcard_Set where Set_ID = ?"; //grabs all the flashcards in a certain set
            $stmt = $mysqli->prepare($query);
            $stmt -> execute([$_GET["id"]]);

    
            if ($stmt)  { //loops through and displays all of the flashcard
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
                    echo "<td><a href='deleteSpecificFS.php?id=".urlencode($setID)."' style='color:red' onclick='return confirm(\"Are you sure you want to delete?\");'>X</a></td>"; //delete option (unimplemented)
                    echo "<td>".$side1."</td>";
                    echo "<td>".$side2."</td>";
                    echo "<td>".$side3."</td>";
                    echo "<td><a href='updateFlashcard.php?id=".urlencode($setID)."'>Edit</a></td>"; //update option (unimplemented)
                    echo "</tr>";
                }
                echo "  </tbody>";
                echo "</table>";
                echo "</center>";
                echo "</div>";
                echo"<br><br><br><a href='simulation2.php?id=".urlencode($_GET["id"])."'>Review your flashcards >>></a>";






                
    ///////////////////////////////////////////////////////////////////////////////////////////

               
            }
            
            else {
                $_SESSION["message"] = "Set could not be found!";
                redirect("home.php");
            }
        }
	  
    
					

//Disconnect from database
new_footer("Senior Project");	
Database::dbDisconnect($mysqli);

?>