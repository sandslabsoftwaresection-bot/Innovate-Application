

$(document).ready(function() {
    // Set the idle time in milliseconds (e.g., 5 minutes)
  const idleTime = 15* 60 * 1000; // 5 minutes

  let timeout;

  // Function to reset the timer whenever there is user activity
  function resetTimer() {
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      //alert("Haiii");
      showLogoutModal();
    }, idleTime);
  }

  // Function to show the logout confirmation modal
  function showLogoutModal() {
      
      
     
        
        
        
        swal({title: "Login Again",
          text: "Your session has expired... ",
          icon: "warning",
          buttons: {
            cancel: "Login Again",
           
          },
        })
        .then((value) => {
          switch (value) {
         
            case "cancel":
              swal("Pikachu fainted! You gained 500 XP!");
              break;
         
            case "catch":
              swal("Gotcha!", "Pikachu was caught!", "success");
              break;
         
            default:
              window.location.href = "https://www.innovate.sapphirebh.com/view/signin.php";
          }
        });
      


  }

  // Function to hide the logout confirmation modal and log the user out
  function logout() {
    // Perform logout actions here (e.g., redirect to logout page or clear session data)
    // For demonstration purposes, let's just refresh the page
    location.reload();
  }

  // Reset the timer whenever there is any user activity (e.g., mousemove, keypress, etc.)
  $(document).on('mousemove keypress', function() {
    resetTimer();
  });

  // Logout button click event
  $('#logoutBtn').on('click', function() {
    logout();
  });

  // Start the initial timer
  resetTimer();
           
});
