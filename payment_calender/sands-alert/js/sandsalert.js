 /*
 <!-- SaNDS Alert Starts here-->
<div class="popup-overlay" id="popupOverlay"></div>

<div class="popup-container" id="popupContainer">
  <div class="popup-header">Header Content</div>    
  <div class="popup-content">
       <i class="" id="message_icon"></i>
    <p id="message_matter">Are you sure you want to change the status?</p>
    <div class="otherContent"></div>
    <div class="popup-buttons">
      <button class="ok">OK</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>
<!-- SaNDS Alert Ends here-->
 */
 
  // Create the HTML structure for SaNDS Alert
    var popupOverlay = $('<div class="popup-overlay" id="popupOverlay"></div>');
    var popupContainer = $('<div class="popup-container" id="popupContainer"></div>');
    var popupHeader = $('<div class="popup-header"></div>');
    var popupContent = $('<div class="popup-content"></div>');
    var messageIcon = $('<i class="" id="message_icon"></i>');
    var messageMatter = $('<p id="message_matter">Are you sure you want to change the status?</p>');
    var otherContent = $('<div class="otherContent"></div>');
    var popupButtons = $('<div class="popup-buttons"></div>');
    var okButton = $('<button class="ok">OK</button>');
    var cancelButton = $('<button class="cancel">Cancel</button>');

    // Append elements to the container
    popupContainer.append(popupHeader);
    popupContent.append(messageIcon, messageMatter,otherContent, popupButtons);
    popupButtons.append(okButton, cancelButton);
    popupContainer.append(popupContent);

    // Append the container and overlay to the body
    $('body').append(popupOverlay, popupContainer);
    
    
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

        function SaNDSAlert(message, switchValue, icons, themecolor='#60A200', ok = 'OK', cancel = 'Cancel',title="Messsage")
        {
            
            switch (icons) {
                    case 'warning':
                        $('#message_icon').removeClass().addClass('fas fa-exclamation-triangle');
                        //$('.popup-header').removeClass().addClass('popup-header warning');
                        $('.popup-header').css({'background-color': themecolor});
                        $('.popup-header').html(title);
                        $('#message_icon').css({'color': themecolor,'font-size': '50px'});
                    break;
                    case 'danger':
                        $('#message_icon').removeClass().addClass('fas fa-times-circle');
                        //$('.popup-header').removeClass().addClass('popup-header danger');
                        $('.popup-header').css({'background-color': themecolor});
                        $('.popup-header').html(title);
                        $('#message_icon').css({'color': themecolor,'font-size': '50px'});
                    break;
                    case 'success':
                        $('#message_icon').removeClass().addClass('fas fa-check-circle');
                        //$('.popup-header').removeClass().addClass('popup-header success');
                        $('.popup-header').css({'background-color': themecolor});
                        $('.popup-header').html(title);
                        $('#message_icon').css({'color': themecolor,'font-size': '50px'});
                    break;
                    case 'info':
                        $('#message_icon').removeClass().addClass('fas fa-exclamation-circle');
                        //$('.popup-header').removeClass().addClass('popup-header info');
                        $('.popup-header').css({'background-color': themecolor});
                        $('.popup-header').html(title);
                        $('#message_icon').css({'color': themecolor,'font-size': '50px'});
                    break;
            }
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainer');
            popupOverlay.style.display = 'block';
            popupContainer.style.display = 'block';
            $('#message_matter').html(message);
            $('#message_matter').attr('data-switch-values', switchValue);
            $('.ok').html(ok);
            $('.cancel').html(cancel);
            
        }
        
