<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Tracking.css">
  <title>AddictionLingo • Tracking</title>
</head>
<body>

  <ul>
  <li class="left"><a href="#home"><h2>AddictionLingo</h2></a></li>
  <li class="right"><a href="#news"><img src="enter.png" width="50px" alt="Logout"></a></li>
  <li class="right"><a href="#news"><img src="settings.png" width="50px" alt="Settings"></a></li>
  <li class="right"><a href="#contact"><img src="alarm.png" width="50px" alt="Alerts"></a></li>
  <li class="right"><a href="#about"><img src="messenger.png" width="50px" alt="Messages"></a></li>
  <li class="right"><a href="#contact"><img src="user.png" width="50px" alt="User"></a></li>
  <li class="right"><a href="#about"><img src="home.png" width="50px" alt="Home"></a></li>
</ul>

<div class="streak">
  <h1>Addiction: <span contenteditable="true">Edit..</span></h1>
  <h1 id="streak-amount">🔥0</h1>
  <button class="streakbutton">Share an update</button>
  <button class="streakbutton" id="log-update-btn">Did you stay clean today?</button>
</div>

<div class="content-wrapper">
  <div class="post" id="task-list">
    <h1 class="center">Daily Tasks:</h1>
    
    <div class="card-item">
      <label class="checkbox-container">
        <input type="checkbox" class="task-checkbox" onchange="toggleTaskCrossout(this)">
        <span class="custom-checkmark"></span>
      </label>
      <div class="task-text-container">
        <span contenteditable="true" class="task-title">Task 1</span>
        <span contenteditable="true" class="task-time">12:00 PM</span>
      </div>
      <button class="delete-btn" onclick="this.parentElement.remove()">×</button>
    </div>

    <div class="card-item">
      <label class="checkbox-container">
        <input type="checkbox" class="task-checkbox" onchange="toggleTaskCrossout(this)">
        <span class="custom-checkmark"></span>
      </label>
      <div class="task-text-container">
        <span contenteditable="true" class="task-title">Task 2</span>
        <span contenteditable="true" class="task-time">2:30 PM</span>
      </div>
      <button class="delete-btn" onclick="this.parentElement.remove()">×</button>
    </div>

    <div class="card-item">
      <label class="checkbox-container">
        <input type="checkbox" class="task-checkbox" onchange="toggleTaskCrossout(this)">
        <span class="custom-checkmark"></span>
      </label>
      <div class="task-text-container">
        <span contenteditable="true" class="task-title">Task 3</span>
        <span contenteditable="true" class="task-time">6:00 PM</span>
      </div>
      <button class="delete-btn" onclick="this.parentElement.remove()">×</button>
    </div>
    
    <div class="card-item add-button-card">
      <button class="task-btn" id="add-task-btn">+ Add Task</button>
    </div>
  </div>
</div>

<script>
  function toggleTaskCrossout(checkbox) {
  const cardItem = checkbox.closest('.card-item');
  const textContainer = cardItem.querySelector('.task-text-container');
  
  if (checkbox.checked) {
    textContainer.classList.add('crossed-out');
  } else {
    textContainer.classList.remove('crossed-out');
  }
}

document.getElementById('add-task-btn').addEventListener('click', function() {
  const newCard = document.createElement('div');
  newCard.className = 'card-item';
  
  const label = document.createElement('label');
  label.className = 'checkbox-container';

  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';
  checkbox.className = 'task-checkbox';
  checkbox.onchange = function() { toggleTaskCrossout(this); };

  const checkmark = document.createElement('span');
  checkmark.className = 'custom-checkmark';

  label.appendChild(checkbox);
  label.appendChild(checkmark);

  const textContainer = document.createElement('div');
  textContainer.className = 'task-text-container';

  const newSpan = document.createElement('span');
  newSpan.contentEditable = 'true';
  newSpan.className = 'task-title';
  newSpan.innerText = 'New Task';
  
  const timeSpan = document.createElement('span');
  timeSpan.contentEditable = 'true';
  timeSpan.className = 'task-time';
  timeSpan.innerText = 'Set time';

  textContainer.appendChild(newSpan);
  textContainer.appendChild(timeSpan);
  
  const deleteBtn = document.createElement('button');
  deleteBtn.className = 'delete-btn';
  deleteBtn.innerHTML = '×';
  deleteBtn.onclick = function() {
    this.parentElement.remove();
  };
  
  newCard.appendChild(label);
  newCard.appendChild(textContainer);
  newCard.appendChild(deleteBtn);
  
  const buttonContainer = this.parentElement;
  const taskList = document.getElementById('task-list');
  taskList.insertBefore(newCard, buttonContainer);
  
  newSpan.focus();
});

  const COOLDOWN_TIME = 24 * 60 * 60 * 1000;
  const button = document.getElementById('log-update-btn');

  function checkCooldown(didClick) {
    const lastClicked = localStorage.getItem('btnCooldown');
    const now = Date.now();

    if (lastClicked) {
        const timePassed = now - parseInt(lastClicked);

        if (timePassed < COOLDOWN_TIME) {
            button.className = "streakFbutton";
            button.textContent = "Thanks for checking in!";
            button.disabled = true;
            setTimeout(checkCooldown, 60000);
            return;
        }

        if (didClick) {
         const streakLabel = document.getElementById('streak-amount');
         key = 0;
         amount = key + 1;
         streakLabel.textContent = "🔥" + amount;
        }
        else {
         const streakLabel = document.getElementById('streak-amount');
         key = 1;
         amount = key;
         streakLabel.textContent = "🔥" + amount;
        }
    }
    
    button.className = "streakbutton";
    button.textContent = "Did you stay clean today?";
    button.disabled = false;
  };

  document.getElementById('log-update-btn').addEventListener('click', () => {
    localStorage.setItem('btnCooldown', Date.now());
    checkCooldown(true);
  });

  checkCooldown(false);
</script>

</body>
</html>

