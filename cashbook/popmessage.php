<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Custom Popup</title>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<!---->
<style>
  /* Popup container */
  .popup-container {
    display: none; /* Initially hidden */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 1000;
  }
  
  /* Popup overlay */
  .popup-overlay {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
  }
  
  /* Popup content */
  .popup-content {
    text-align: center;
  }
  
  /* Popup buttons */
  .popup-buttons {
    margin-top: 20px;
  }
  
  .popup-buttons button {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  
  .popup-buttons button.ok {
    background-color: #28a745;
    color: #fff;
  }
  
  .popup-buttons button.cancel {
    background-color: #dc3545;
    color: #fff;
  }
</style>
</head>
<body>

<div class="popup-overlay" id="popupOverlay"></div>

<div class="popup-container" id="popupContainer">
  <div class="popup-content">
    <p id="message_matter">Are you sure you want to change the status?</p>
    <div class="popup-buttons">
      <button class="ok">OK</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>

<button id="togglePopup">Toggle Popup</button>

<script>
  document.getElementById('togglePopup').addEventListener('click', function() {
    var popupOverlay = document.getElementById('popupOverlay');
    var popupContainer = document.getElementById('popupContainer');
    popupOverlay.style.display = 'block';
    popupContainer.style.display = 'block';
  });

  document.querySelectorAll('.popup-buttons button').forEach(function(button) {
    button.addEventListener('click', function() {
      var popupOverlay = document.getElementById('popupOverlay');
      var popupContainer = document.getElementById('popupContainer');
      popupOverlay.style.display = 'none';
      popupContainer.style.display = 'none';
      
      // Check which button was clicked
      if (button.classList.contains('ok')) {
        // OK button clicked, perform action
        alert('Status changed!');
      } else if (button.classList.contains('cancel')) {
        // Cancel button clicked, do nothing
        alert('Action canceled!');
      }
    });
  });
</script>

</body>
</html>
