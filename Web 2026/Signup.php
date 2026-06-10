<?php
  //start the session and create the connection
  session_start();
  include"conn.php";
?>

<?php
  //Run when the SignUp button on the form is hit 
  if(isset($_POST['Signup'])) {	
    //Assign a variable to each of the fields on the form. Ensure the values match the form field names exactly
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Streak = 0;
    //Use the INSERT INTO statement to insert each of the values from the form to a new record in the members table 
    $sql = $conn->query("INSERT INTO member (username, password, streak) 
    Values('$Username', '$Password', '$Streak')");

    //Use the header function to redirect users to the login page	
    header('Location: login.php');
  }  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="SignUp.css">
  <title>Addictionlingo</title>
</head>
<body>
  <div class="content-wrapper">
    <h1 class="top">Welcome to AddictionLingo!</h1>
  </div>
  
  <div class="content-wrapper">
    <form id="RegisterForm" name="RegisterForm" method="post" action="" enctype="multipart/form-data">
        <div class="title">
      <h1 class="center">Signup to AddictionLingo:</h1>
      <!-- text field-->
      <div class="inputs">
        <label><b>Username</b></label>
        <input name="Username" type="text" required="required" placeholder="Enter Username">
      </div>
      <!-- text field-->
      <div class="inputs">
        <label><b>Password</b></label>
        <input name="Password" type="text" required="required" placeholder="Enter Password">
      </div>
      <!-- button-->
      <div class="inputs">
        <input name="Signup" type="submit" class="button" id="SignUp" value="SignUp">
      </div>
      
    </form>
    

  </div> 

</body>
</html>
