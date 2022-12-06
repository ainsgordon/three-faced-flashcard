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
verify_login(); //connects to database
 
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
	echo $output;
}



if (isset($_GET["id"]) && $_GET["id"] !== "") {
    
            $query = "SELECT * from FlashCard natural join Flashcard_Set where Set_ID = ?"; //grabs all the cards of a certain set
            $stmt = $mysqli->prepare($query);
            $stmt -> execute([$_GET["id"]]);

    
            if ($stmt)  {
                echo "<div class='container'>";
                echo "<div id='flashcards' class='flashcards'>"; //creates flashcard container, makes the flashcards look like flashcards using CSS

                $i = 0; //i is used as an index to create unique flashcard ids

               
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $side1 = $row["Side1"];
                    $side2 = $row["Side2"];
                    $side3 = $row["Side3"];
                   echo "<div class='flashcard' className='flashcard'>";
                
                   $side1id = $i."side1"; //unique flashcard ids for all three cards
                   $side2id = $i."side2";
                   $side3id = $i."side3";
                    echo "<h2 id='$side1id' style='text-align: center; padding: 15px; margin-top:30px'>".$side1."</h2>"; //displays side 1 but not 2 and three; JS used to display sides 2 and 3
                    echo "<h2 id='$side2id' style='display:none;text-align: center; padding: 15px; color:red;'>".$side2."</h2>";
                    echo "<h2 id='$side3id' style='display:none;text-align: center; padding: 15px; color:blue;'>".$side3."</h2>";

                    $i++;
    
                    echo "</div>";
                }
                echo "  </div>";
                echo "</div>";






                
    ///////////////////////////////////////////////////////////////////////////////////////////

               
            }
            
            else {
                $_SESSION["message"] = "Set could not be found!";
                redirect("home.php");
            }
        }
	  
    
					

new_footer("Senior Project");	
Database::dbDisconnect($mysqli); //disconnects from database

?>

<script src="simulation2.js"></script> <!-- calls the JS for the flashcard simulation -->