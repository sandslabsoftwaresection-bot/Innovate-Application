  // Click event handler for the control
 function sandsBaloon(controlID, popupID)
 {
  $(controlID).click(function() {
    // Calculate the position of the popup window relative to the control
    var buttonOffset = $(this).offset();
    var popupLeft = buttonOffset.left;
    var popupTop = buttonOffset.top + $(this).outerHeight();

    // Set the position of the popup window
    $(popupID).css({
      'position': 'absolute',
      'left': popupLeft + 'px',
      'top': popupTop+5 + 'px',
    });

    // Show the popup window
    $(popupID).show();
  });
}
//#myButton, #popupWindow
  // Click event handler to close the popup window when clicking outside of it
  // <!-- $(document).click(function(event) { -->
    // <!-- if (!$(event.target).closest('#myButton, #popupWindow').length) { -->
      // <!-- $('#popupWindow').hide(); -->
    // <!-- } -->
	
  // <!-- }); -->
  
  $('.closeButton').click(function() {
     $(this).closest('.popupWindow').hide();
  });
  