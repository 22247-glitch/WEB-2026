<?php
session_start();
include "conn.php";

if(isset($_POST['Login'])){   
    
    $LoginUsername = $_POST['Username'];
    $LoginPassword = $_POST['Password'];

    
    //$result = $conn->query("select * from member where username='$LoginUsername' and password='$LoginPassword'");
    

    // safe code: the question marks mean that they are placeholders that get replaced by s
    $stmt = $conn->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    
    $stmt->bind_param("ss", $LoginUsername, $LoginPassword);
    
    // executes the statement to get results
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_array();
        
        $id = $row['user_id'];
        $Username = $row['username'];
        $Password = $row['password'];
        
        $_SESSION['UserID'] = $row['user_id'];  
        $_SESSION["Username"] = $row['username'];
        $_SESSION["Password"] = $row['password']; 

        if($LoginUsername == $Username && $LoginPassword == $Password) {
            ?>
            <script>window.location ="Home.php?id=<?php echo $id;?>";</script>
            <?php
            exit();
        }
    } else {
        
        ?>
        
        <?php $badInput = true;?>

        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Login.css">
  <title>Addictionlingo</title>
</head>
<body>
  <div class="content-wrapper">
    <h1 class="top">Welcome to AddictionLingo!</h1>
  </div>
  <div class="content-wrapper">
    <form id="LoginForm" name="LoginForm" method="post"> 

      <div class="title" id="wrapper">
        <h1 class="center">Login:</h1>
        
        <div class="inputs">
          <label><b>Username</b></label>
          <input name="Username" type="text" required="required" placeholder="Enter Username">
        </div>
        
        <div class="inputs">
          <label><b>Password</b></label>
          <input name="Password" type="password" required="required" placeholder="Enter Password">
        </div>
        
        <div class="inputs">
          <input name="Login" type="submit" class="button" id="LogIn" value="Log in">
        </div>
      </div>

    </form>
  </div> 
</body>
</html>
<script>
  const wrongInput = <?php echo json_encode($badInput); ?>;
  

  const container = document.getElementById('wrapper');

  const error = document.createElement('p');

  if (wrongInput == true) {
    error.textContent = "Wrong username or password";
    error.classList.add("wrong-input");
    container.appendChild(error);
  }
  

  console.log(wrong);

</script>
