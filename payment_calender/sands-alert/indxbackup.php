<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Custom Popup</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
<!--Above Not Required -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
body {
        font-family: "Raleway", sans-serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
      }


  /* Popup container */
  .popup-container {
    display: none; /* Initially hidden */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 0px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    width: 70%; /* Default width for larger screens */
    max-width: 500px; /* Maximum width for smaller screens */
    margin: 0 auto; /* Center align horizontally */
  }
  /* Media query for smaller screens */
    @media screen and (max-width: 768px) {
        .popup-container {
            width: 90%; /* Adjusted width for smaller screens */
        }
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
    padding :20px;
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
  
.popup-header {
    padding: 10px; /* Padding around the header content */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold font weight */
    text-align: left; /* Center align the text */
    border-radius: 5px 5px 0 0; /* Rounded corners for the top */
    color: #ffffff; /* White text color */
}

.popup-header.success {
    background-color: #60A200; /* Green background color for success */
}

.popup-header.danger {
    background-color: #C70039; /* Red background color for danger */
}

.popup-header.warning {
    background-color: #FFC300; /* Yellow background color for warning */
}

.popup-header.info {
    background-color: #045BC3; /* Blue background color for info */
}

.popup-header {
    cursor: move; /* Set cursor to move */
}


</style>
</head>
<body>

<div class="popup-overlay" id="popupOverlay"></div>

<div class="popup-container" id="popupContainer">
  <div class="popup-header">Header Content</div>    
  <div class="popup-content">
       <i class="" id="message_icon"></i>
    <p id="message_matter">Are you sure you want to change the status?</p>
    <div class="popup-buttons">
      <button class="ok">OK</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>

<button id="btn_success">Success</button>
<button id="btn_danger">Danger</button>
<button id="btn_info">Information</button>
<button id="btn_warning">Warning</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
//   document.getElementById('togglePopup').addEventListener('click', function() {
//     var popupOverlay = document.getElementById('popupOverlay');
//     var popupContainer = document.getElementById('popupContainer');
//     popupOverlay.style.display = 'block';
//     popupContainer.style.display = 'block';
//   });
  

//   document.querySelectorAll('.popup-buttons button').forEach(function(button) {
//     button.addEventListener('click', function() {
//       var popupOverlay = document.getElementById('popupOverlay');
//       var popupContainer = document.getElementById('popupContainer');
//       popupOverlay.style.display = 'none';
//       popupContainer.style.display = 'none';
//       // Check which button was clicked
//       if (button.classList.contains('ok')) {
//         // OK button clicked, perform action
//         alert('Status changed!');
//       } else if (button.classList.contains('cancel')) {
//         // Cancel button clicked, do nothing
//         alert('Action canceled!');
//       }
//     });
//   });
</script>

<script>

// Get the popup container and header elements
var popupContainer = document.getElementById('popupContainer');
var popupHeader = document.querySelector('.popup-header');

// Variables to store the position of the mouse and the offset of the popup container
var mouseX, mouseY, popupOffsetX, popupOffsetY;

// Flag to indicate whether dragging is in progress
var isDragging = false;

// Event listener for mouse down on the header
popupHeader.addEventListener('mousedown', function(event) {
    // Set dragging flag to true
    isDragging = true;

    // Calculate the initial position of the mouse relative to the popup container
    mouseX = event.clientX;
    mouseY = event.clientY;
    popupOffsetX = popupContainer.offsetLeft;
    popupOffsetY = popupContainer.offsetTop;

    // Prevent default behavior to avoid text selection
    event.preventDefault();
});

// Event listener for mouse move
document.addEventListener('mousemove', function(event) {
    // If dragging is in progress
    if (isDragging) {
        // Calculate the new position of the popup container based on the mouse movement
        var deltaX = event.clientX - mouseX;
        var deltaY = event.clientY - mouseY;
        var newPopupX = popupOffsetX + deltaX;
        var newPopupY = popupOffsetY + deltaY;

        // Set the new position of the popup container
        popupContainer.style.left = newPopupX + 'px';
        popupContainer.style.top = newPopupY + 'px';

        // Prevent default behavior to avoid scrolling
        event.preventDefault();
    }
});

// Event listener for mouse up
document.addEventListener('mouseup', function() {
    // Reset dragging flag to false
    isDragging = false;
});

    $(document).ready(function(){
        
        document.querySelectorAll('.popup-buttons button').forEach(function(button) {
            button.addEventListener('click', function() {
              var popupOverlay = document.getElementById('popupOverlay');
              var popupContainer = document.getElementById('popupContainer');
              popupOverlay.style.display = 'none';
              popupContainer.style.display = 'none';
              // Check which button was clicked
              if (button.classList.contains('ok')) {
                // OK button clicked, perform action
                var switchData = $('#message_matter').attr('data-switch-values');
                switch (switchData) {
                    case 'AddData':
                        AddDataToDatabase();
                        break;
                    case 'DeleteData':
                        DeleteRowFromTheTable();
                        break;
                    default:
                        alert('No action defined for this message.');
                }
              } else if (button.classList.contains('cancel')) {
                // Cancel button clicked, do nothing
                alert('Action canceled!');
              }
            });
        });
        
        function SaNDSAlert(message,switchValue,icons)
        {
            
            switch (icons) {
                    case 'warning':
                        $('#message_icon').removeClass().addClass('fas fa-exclamation-triangle');
                        $('.popup-header').removeClass().addClass('popup-header warning');
                        $('#message_icon').css({'color': '#FFC300','font-size': '50px'});
                    break;
                    case 'danger':
                        $('#message_icon').removeClass().addClass('fas fa-times-circle');
                        $('.popup-header').removeClass().addClass('popup-header danger');
                        $('#message_icon').css({'color': '#C70039','font-size': '50px'});
                    break;
                    case 'success':
                        $('#message_icon').removeClass().addClass('fas fa-check-circle');
                        $('.popup-header').removeClass().addClass('popup-header success');
                        $('#message_icon').css({'color': '#60A200','font-size': '50px'});
                    break;
                    case 'info':
                        $('#message_icon').removeClass().addClass('fas fa-exclamation-circle');
                        $('.popup-header').removeClass().addClass('popup-header info');
                        $('#message_icon').css({'color': '#045BC3','font-size': '50px'});
                    break;
            }
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainer');
            popupOverlay.style.display = 'block';
            popupContainer.style.display = 'block';
            $('#message_matter').html(message);
            $('#message_matter').attr('data-switch-values', switchValue);
            
            
        }
        
        $('#btn_success').click(function(){
            // First Para is User Message and Second is SwitchValue
            SaNDSAlert('This is Success Message..!','AddData','success');
        });
        
        $('#btn_info').click(function(){
            SaNDSAlert('This is a Info Message..!','AddData','info');
        });
        $('#btn_danger').click(function(){
            SaNDSAlert('This is a danger Message..!','AddData','danger');
        });
        
        $('#btn_warning').click(function(){
            SaNDSAlert('This is a Warning Message..!','AddData','warning');
        });
        
        function AddDataToDatabase()
        {
            console.log('There I will write the code for Add Data to DB Using Ajax Post');
        }
        
        function DeleteRowFromTheTable()
        {
            console.log('There I will write the code for Delete proses to DB using AJAX Post');
        }
        
    });
</script>

</body>
</html>
