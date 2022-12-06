<link rel="stylesheet" href="style.css" />

<ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="create2.php">Create a Set</a></li>
        <li style="float:right"><a href="userprofile.php">User Profile</a></li>
      </ul>
      

<?php 
require_once("session.php"); 
require_once("final_functions.php");
require_once("database.php");
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	if (($output = message()) !== null) {
		echo $output;
	} //connects to database
	
///////////////////////////////////////////////////////////////////////////////////////////////





if(isset(($_POST["submit"]))) {
    if(isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$secret = password_encrypt($password); //grabs the username & password from the form below; encrypts password
		// $_SESSION['message'] = "encrypted password";

		
			
		$query2 = "select FSUser_Name from FS_User where FSUser_Name = ?"; //searches for users with the same username
		$stmt2 = $mysqli -> prepare($query2);
		$stmt2 -> execute([$username]);
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		if($stmt2){
			$_SESSION['message'] = "stmt2 works";
		
		
		$rowNum = $stmt2->rowCount();
			if($rowNum>=1){
				$_SESSION["message"] = "Username unavailable"; //if another user has same username, throws error
				redirect("addLogin2.php");
			}else {
		
		
		
		
		
				$query1 = "insert into FS_User(FSUser_Name,Password) values(?,?)"; //if not, inserts username/encrypted password into database
				$stmt1 = $mysqli -> prepare($query1);
				$stmt1->execute([$username, $secret]);

				
				
				if($stmt1){
					$_SESSION["message"] = "User added";
					redirect("home.php");
				}else {
					$_SESSION["message"] = "Error";
					redirect("addLogin2.php");
				}
			}
		}	
    }


} else { //form where users submit their password/username
    					
                        echo "<form action = 'addLogin2.php' method='post'>";  
					     
                       
                        echo "Username: <input type = text name='username'/>";
						echo "Password: <input type = password name='password'/>";
                       
                    
                        echo "<p><input type = 'submit' name= 'submit' value= 'Add' class = 'button tiny round'/>";
    
                    
                        
                        
                echo "</form>";		
    //////////////////////////////////////////////////////////////////////////////////////////////////
                    
        }
        //echo "</center>";
        echo "</label>";
        echo "</div>";
        echo "<br /><p>&laquo:<a href='index.php'>Back</a>";












new_footer("Senior Project");	
Database::dbDisconnect($mysqli); //disconnect from database

?>


