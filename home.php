

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Flashcard App</title>
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    />
    
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <ul>
        <li><a class="active" href="home.php">Home</a></li>
        <li><a href="create2.php">Create a Set</a></li>
        <li style="float:right"><a href="userprofile.php">User Profile</a></li>
      </ul>
      <?php include 'readSet.php'; ?>
    

      
    
  </body>
</html>