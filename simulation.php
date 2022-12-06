<!-- unimplemented code for the original simulation; just testing out CSS -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet">
	<title>Review Your Cards</title>
</head>
<body>
	<ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="create.php">Create a Set</a></li>
        <li style="float:right"><a href="#profile">User Profile</a></li>
    </ul>
	<div class="container" id="card">
		<div class="flashcards">
			<div class="flashcard" id="card-container" onClick="showSide()">
				<div class="side1" id="side1"><h2 style="text-align: center; padding: 15px; margin-top:30px">Side 1</h2></div>
				<div class="side2" id="side2" style="display:none;"><h2 style="text-align: center; padding: 15px; color:red;">Side 2</h2></div>
				<div class="side3" id="side3" style="display:none;"><h2 style="text-align: center; padding: 15px; color:blue;">Side 3</h2></div>
			</div>
		</div>
	  </div>

	  <a href="readSpecificSet.php"><<<< Back to your set</a>

	  <script src="simulation.js"></script>
	
</body>
</html>