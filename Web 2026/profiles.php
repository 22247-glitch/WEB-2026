<?php
  session_start();
  include "conn.php";

  //gets the username from the member table 
  $result = $conn->query("SELECT username FROM member");

  $ProfileUsernames = [];
  $Searched = false;

  // loops
  while ($row = $result->fetch_assoc()) {
      $ProfileUsernames[] = $row['username']; // Appends the column value
  }

  $Username = null;
  if(isset($_GET['Search']) && !empty($_GET['Username'])){   
    $Username = $_GET['Username'];
    $Searched = true;
  }

  echo $Searched ? 'true' : 'false';


?>

<!DOCTYPE html>
<html lang="en">    
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Profiles.css">
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


  <div class="title">

    <h1>People to follow</h1>

    <form id="SearchUsers" name="SearchUsers" method="get" action="">
      <div class="inputs">
        <input name="Username" type="text" required="required" placeholder="Enter Username" id="Username">
        <input name="Search" type="submit" class="Search" id="Search" value="Search">
        <div id="addcancel"></div>
      </div>
    </form>

  </div>


  <div class="content-wrapper">
    <div class="people">  
      <div id="more"></div>
    </div>
  </div>


<script>
  //empty div to show the users from
  const moreCard = document.getElementById('more');
  const array = <?php echo json_encode($ProfileUsernames); ?>;
  const searched = <?php echo json_encode($Searched); ?>;
  const usersearched = <?php echo json_encode($Username); ?>;
  let useramount = array.length;

  // new card
  for (let i = 0; i < array.length; i++) {
    // it makes the card element 
    const newCard = document.createElement('div');
    newCard.className = 'card-item';
        
    newCard.innerHTML = `
        <div class="user-info">
            <img src="profile.png" width="50px" alt="Profile">
            <span class="username">New User</span>
        </div>
        <button class="view">View profile</button>
    `;
    //replace the text with the username in the database by getting the class the username is on
    const usernameSpan = newCard.querySelector('.username');
    usernameSpan.textContent = array[i];
        
    // the thing that actually creates a card
    moreCard.parentElement.insertBefore(newCard, moreCard);
  }

  if (searched == true) {
    //delete all cards 
    const cards = document.querySelectorAll('.card-item');
    for (let i = 0; i < cards.length; i++) {
      const card = cards[i];
      card.remove();
    }

    const addbutton = document.getElementById('addcancel');

    const stopsearch = document.createElement('div');
    stopsearch.innerHTML = `
      <input name="Cancel" type="submit" class="Cancel" id="Cancel" value="Cancel search" formnovalidate>
    `;
    addbutton.parentElement.insertBefore(stopsearch, addbutton);

    //make a card that shows the one searched username

    if (array.includes(usersearched)) {
      const newCard = document.createElement('div');
      newCard.className = 'card-item';

      newCard.innerHTML = `
        <div class="user-info">
            <img src="profile.png" width="50px" alt="Profile">
            <span class="username">New User</span>
        </div>
        <button class="view">View profile</button>
      `;
      const usernameSpan = newCard.querySelector('.username');
      usernameSpan.textContent = usersearched;
      moreCard.parentElement.insertBefore(newCard, moreCard);
    }




  }
</script>
</body>
</html>
