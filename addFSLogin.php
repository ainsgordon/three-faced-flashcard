<link rel="stylesheet" href="style.css" />

<ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="create.php">Create a Set</a></li>
        <li style="float:right"><a href="#profile">User Profile</a></li>
</ul>

<?php  //this code is testing the addlogin function, the implemented add login is addLogin2
require_once("session.php"); 
require_once("included_functions.php");
require_once("database.php");
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	if (($output = message()) !== null) {
		echo $output;
	}
	
///////////////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['submit'])){
	if(isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== ''){
		


		$username = $_POST['username'];
		$password = $_POST['password'];
		$secret = password_encrypt($password);
		$_SESSION['message'] = "encrypted password";

		
			
		$query2 = "select FSUser_Name from FS_User where FSUser_Name = ?";
		$stmt2 = $mysqli -> prepare($query2);
		$stmt2 -> execute($username2);
		$row = $stmt2->fetch(PDO::FETCH_ASSOC);
		if($stmt2){
			$_SESSION['message'] = "stmt2 works";
		
		
		$rowNum = $stmt2->rowCount();
			if($rowNum>=1){
				$_SESSION["message"] = "Username unavailable";
				redirect("addFSLogin.php");
			}else {
		
		
		
		
		
				$query1 = "insert into FS_User(FSUser_Name,Password) values('".$username."','".$secret."')";
				$stmt1 = $mysqli -> prepare($query1);
				$stmt1->execute();

				// if(!stmt1) {
				// 	die("could not insert data" . $mysqli-> error); 
				// }
				
				if($stmt1){
					$_SESSION["message"] = "User added";
					redirect("addFSLogin.php");
				}else {
					$_SESSION["message"] = "Error";
					redirect("addFSLogin.php");
				}
			}
		}	
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////
?>
		<div class='row'>
		<label for='left-label' class='left inline'>
		<h3>Add Flashcard User</h3>


<form action=addFSLogin.php method=post>
 <p>Username:<input type="text" name="username" value="" /> </p>
 <p>Password: <input type="password" name="password" value="" /> </p>
 <input type="submit" name="submit" value="Add User" class="button tiny round"/>
</form>
			<p><br /><br /><hr />
			<h2>Current Users</h2>
<?php
$query = "select * from aggordon.FS_User";
$stmt = $mysqli -> prepare($query);
$stmt -> execute();
if($stmt) {
	echo "
    <center>
    <table>
        <thead>
            <tr><th></th><th>Username</th>
        </thead>
        <tbody>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$id = $row['FSUser_ID'];
		$username = $row['FSUser_Name'];
		$hashed_password = $row['Password'];
		echo "<tr><td><a href='deleteLogin.php?id=".urlencode($id)."' style=' color: red ' onclick='return confirm(\"Are you sure?\"); '>X</a></td>
        <td style='text-align-center'>".$username."</td>
        </tr>";
	}
	echo "</table>
	</center>";
}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
			
  	  <?php echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>"; ?>
			
	</div>
	</label>

<?php 

//Disconnect from database database
new_footer("Senior Project");
Database::dbDisconnect($mysqli);

?>