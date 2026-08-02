<?php
  session_start();
  include "conn.php";
  $username = isset($_SESSION['Username']) ? $_SESSION['Username'] : 'Guest';
  $result = $conn->query("SELECT Username, streak FROM member");

  $array = [];
  while ($row = $result->fetch_assoc()) {

    $array[] = $row;

  }
  // search in the array for username and gets the index
  $index = array_search($username, array_column($array, 'Username'));
  $streak = $array[$index]['streak'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Home.css">
  <title>Addictionlingo</title>
</head>
<body>

  <ul>
    <li class="left"><a href="Home.php"><h2>AddictionLingo</h2></a></li>
    <li class="right"><a href="#news"><img src="enter.png" width="50px" alt="Logout"></a></li>
    <li class="right"><a href="#news"><img src="settings.png" width="50px" alt="Settings"></a></li>
    <li class="right"><a href="#Tracking.html"><img src="alarm.png" width="50px" alt="Alerts"></a></li>
    <li class="right"><a href="#about"><img src="messenger.png" width="50px" alt="Messages"></a></li>
    <li class="right"><a href="#contact"><img src="user.png" width="50px" alt="User"></a></li>
    <li class="right"><a href="Home.html"><img src="home.png" width="50px" alt="Home"></a></li>
  </ul>

  <div class="streak">
    <h1>Welcome back, <?php echo htmlspecialchars($username); ?>!</h1>
    <h1>Your streak: <?php echo htmlspecialchars($streak); ?>🔥</h1>
    <button class="streakbutton">Share an update</button>
    <button class="streakbutton">Todays check in</button>
  </div>

  <div class="content-wrapper">
    
    <div class="post">
      <h1 class="center">posts:</h1>
      <div class="card-item">Hugo: starting to get clean off alhohol</div>
      <div class="card-item">Bradley Pratt: 2 weeks clean off phone addiction</div>
      <div class="card-item">Craig Pratt: one day off cigs</div>
      <div class="card-item">Riley Robert: 1 week off cocaine</div>
      <div class="card-item">James: 2 days off cocaine</div>
      <div class="card-item">Johm: hey people</div>
    </div>

    <div class="streaks">
      <h1 class="center">streaks:</h1>
      <div class="card-item">Elvis Ye: 0 days 🔥</div>
      <div class="card-item">Bradley Pratt: 14 days 🔥</div>
      <div class="card-item">Craig Pratt: 1 days 🔥</div>
      <div class="card-item">Mark: 7 days 🔥</div>
      <div class="card-item">Johm: 9 days 🔥</div>
      <div class="card-item">James: 2 days 🔥</div>
    </div> 


  </div> 

</body>
</html>
