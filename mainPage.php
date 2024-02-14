<?php
  session_start();
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Main Page</title>
      <link rel="stylesheet" type="text/css" href="styleForMainPage.css">
    </head>
    <body>
      <header>
        <h2>Help desk</h2>
        <div class="logout-button">
          <div class="dropdown-content">
            <a href="editProfile.html">Edit profile</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </header>
      
      <div class="container center-container">
        <h1>welcome</h1>
      
        <form action="sendEmail.php" method="POST">
          <label for="problem">Problem:</label>
          <input type="text" id="problem" name="problem" placeholder="Type your problem">
        
          <button type="submit">Send</button>
        </form>

        <a href="history.php" class="history-button">History</a>
      </div>

      <script>
        // JavaScript to handle the dropdown functionality
        document.addEventListener('click', function(event) {
          var dropdowns = document.getElementsByClassName('dropdown-content');
          for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (!openDropdown.parentElement.contains(event.target)) {
              openDropdown.style.display = 'none';
            }
          }
        });
      </script>
    </body>
    </html>
  <?php }
  else{?>
          <!DOCTYPE html>
      <html>
      <head>
        <title>Error Page</title>
        <link rel="stylesheet" type="text/css" href="styleForMainPage.css">
      </head>
      <body>
        <div class="error-container">
          <h2>Error Message</h2>
          <p>An error occurred. Please try again later.</p>
        </div>
      </body>
      </html>
  <?php }
?>
