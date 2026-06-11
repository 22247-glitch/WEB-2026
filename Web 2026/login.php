<?php
session_start();
include"conn.php";
?>

<?php
//test whether the LogIn button on this form has been hit
  if(isset($_POST['LogIn'])){  
	  
//Assign variables to the Email and Password values entered on the form	  
	$LoginUsername = $_POST['Username'];
	$LoginPassword = $_POST['Password'];

//Look for a matching record in the members table 
//and return the records as an array
	$result = $conn->query("select * from member 
	where username='$LoginUsername' and password='$LoginPassword'");
	$row = $result->fetch_array();
	
//Assign the email, password and user_id from the array to variables	
  $id=$row['user_id'];
	$Username=$row['username'];
  $Password=$row['password'];
	
//Assign a Session Variable to each field we want to reuse in this session 
	$_SESSION['UserID'] = $row['user_id'];	
	$_SESSION["Username"] = $row['username'];
	$_SESSION["Password"] = $row['password'];	
//Checking the values entered on the login form against the values in the database. 
//If they match direct the user to the members page
    if($LoginUsername==$Username && $LoginPassword==$Password)
    {
?>
    <script>window.location ="Home.html?id=<?php echo $id;?>";</script>
<?php
    }
    else{
    header("location: Tracking.html"); //send user back to the login page.
	}
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
    <form id="LoginForm" name="LoginForm" method="post" action=""> 
      <div class="title">
      <h1 class="center">Login:</h1>
      <!-- text field-->
      <div class="inputs">
        <label><b>Username</b></label>
        <input input name="Username" type="text" required="required" placeholder="Enter Username">
      </div>
      <!-- text field-->
      <div class="inputs">
        <label><b>Password</b></label>
        <input input name="Password" type="text" required="required" placeholder="Enter Password">
      </div>
      <!-- button-->
      <div class="inputs">
        <input name="Login" type="submit" class="button" id="LogIn" value="LogIn">
      </div>
    </form>

  </div> 

</body>
</html>
