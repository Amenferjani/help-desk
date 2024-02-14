
<?php
// Include the database connection
include 'connectDataBase.php';

// Check if the user is logged in and retrieve their user ID
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $user_id = $_SESSION['user_id'];

  // Fetch the problems of the user from the database
  $query = "SELECT * FROM userproblems WHERE user_id = ? AND exist = 1 ORDER BY id_problem DESC"; // Only fetch problems where exist = 1
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $problems = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // Display the problems
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>User Problems</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
      }

      .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h1 {
        text-align: center;
        color: #333;
      }

      .problem-list {
        list-style: none;
        padding: 0;
      }

      .problem-list-item {
        margin-bottom: 20px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
      }

      .problem-list-item .problem-date {
        font-size: 12px;
        color: #888;
      }

      .delete-button {
        background-color: #ff6666;
        color: #fff;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      .login-button {
        background-color: #333;
        color: #fff;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>User Problems</h1>
      <button class="login-button" onclick="location.href='mainPage.php'">exit</button>
      <ul class="problem-list">
        <?php foreach ($problems as $problem) { ?>
          <li class="problem-list-item">
            <h3><?php echo $problem['problem']; ?></h3>
            <p class="problem-date">Date: <?php echo $problem['date']; ?></p>
            <p>Status: <?php echo $problem['statue']; ?></p>
            <form method="post" action="deleteProblem.php">
              <input type="hidden" name="id" value="<?php echo $problem['id_problem']; ?>">
              <button class="delete-button" type="submit">Delete</button>
            </form>
          </li>
        <?php } ?>
      </ul>
    </div>
  </body>
  </html>
  <?php
} else {
  // User is not logged in, redirect to login page or display an error message
  header("Location: login.php");
  exit();
}
?>
