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
verify_login(); //connects to database, makes sure users are logged in

$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
	echo $output;
}

if(isset(($_POST["submit"]))) {
    if( (isset($_POST["setname"]) && $_POST["setname"] !== "") ) {



        $query1 = "insert into Flashcard_Set (Set_Name, FSUser_ID) values (?,?)"; //grabs the set name from the form below and the user ID from the session key; inserts these into the database
        $stmt1 = $mysqli->prepare($query1);
		$stmt1 -> execute([$_POST["setname"],$_SESSION['id']]);
        if($stmt1) {
            $_SESSION["message"] = $_POST["setname"]." has been added";
            $query2 = "select Set_ID from Flashcard_Set where Set_Name = ?";
            $stmt2 = $mysqli->prepare($query2);
		    $stmt2 -> execute([$_POST["setname"]]);
            if($stmt2) {
                $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                $id = $row["Set_ID"];
                redirect("create3.php?id=".urlencode($id)); //after set is created, users are redirected to a page where they can create three faced flashcards
            } else {
                $_SESSION["message"]="Error adding ".$_POST['setname']." ";
            }

        }else {
            $_SESSION["message"]="Error adding ".$_POST['setname']." ";
            redirect("create2.php");
        }


    }


} else { //form where users create a set
    					
                        echo "<form action = 'create2.php' method='post'>";  
					     
                       
                        echo "Name Your Set: <input type = text name='setname'/>";
                       
                        
                        echo "<p><input type = 'submit' name= 'submit' value= 'Add' class = 'button tiny round'/>";
    
                    
                        
                        
                echo "</form>";		
    //////////////////////////////////////////////////////////////////////////////////////////////////
                    
        }
        //echo "</center>";
        echo "</label>";
        echo "</div>";
        echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>";












new_footer("Senior Project");	
Database::dbDisconnect($mysqli);

?>