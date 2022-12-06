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


    $query = "SELECT * FROM Flashcard_Set NATURAL JOIN FS_User where FSUser_ID=?"; //grabs all of a user's sets from the database
    $stmt = $mysqli -> prepare($query);
    $stmt -> execute([$_SESSION['id']]);

    if($stmt) { //loops through all the sets of flashcards a user has and displays them
        echo " <br>";
        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Flashcard Sets</h2>";
        echo "<br>";
        echo "<table>";
        echo "  <thead>";
        echo "      <tr><th></th><th>Set Name</th>";
        echo "  </thead>";
        echo "  <tbody>";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = $row["Set_Name"];
            $setID = $row["Set_ID"];
            $userName = $row["FSUser_Name"];

            echo "<tr>";
            echo "<td><a href='deleteFS.php?id=".urlencode($setID)."' style='color:red' onclick='return confirm(\"Are you sure you want to delete?\");'>X</a></td>"; //delete button
            echo "<td>".$name."</td>";
            echo "<td><a href='readSpecificSet.php?id=".urlencode($setID)."'>View</a></td>"; //view button
            echo "</tr>";
        }
        echo "  </tbody>";
        echo "</table>";
        echo "</center>";
        echo "</div>";
    }

    new_footer("Senior Project");
    Database::dbDisconnect(); //disconnects from the database
?>