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
<link href="css/sands_alert_style.css" rel="stylesheet">
<style>
body {
        font-family: "Raleway", sans-serif;
      font-optical-sizing: auto;
      font-weight: 400;
      font-style: normal;
      }

</style>
</head>
<body>

<button id="btn_success">Success</button>
<button id="btn_danger">Danger</button>
<button id="btn_info">Information</button>
<button id="btn_warning">Warning</button>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/sandsalert.js"></script>


<script>
    
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
        
        
        $('#btn_success').click(function(){
            // 'Your Custom Message' 'event','type','color','ok','cancel','Title'
            SaNDSAlert('This is Success Message..!','AddData','success','#60A200','Confirm','Do nothing');
        });
        
        $('#btn_info').click(function(){
            SaNDSAlert('This is a Info Message..!','AddData','info','#045BC3');
        });
        $('#btn_danger').click(function(){
            SaNDSAlert('This is a danger Message..!','DeleteData','danger','#C70039','I am not Sure');
        });
        
        $('#btn_warning').click(function(){
            SaNDSAlert('This is a Warning Message..!','DeleteData','warning','#E14F00');
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
