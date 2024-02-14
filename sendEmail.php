<?php
session_start();
include 'connectDataBase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $problem = $_POST["problem"];
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];
  $status = "waiting";
  $date = date('Y-m-d'); // Get the current date

  $query = "SELECT id FROM users WHERE userName = ? AND userPassword = ?";
  $stmt = mysqli_prepare($connection, $query);
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);

  if (mysqli_stmt_execute($stmt)) {
    // Get the result set
    $result = mysqli_stmt_get_result($stmt);

    // Check if a matching user is found
    if (mysqli_num_rows($result) > 0) {
      // Fetch the user ID
      $row = mysqli_fetch_assoc($result);
      $user_id = $row['id'];
      $_SESSION['user_id'] = $user_id;

      // Now you have the user ID, you can use it as needed
      $insertQuery = "INSERT INTO userproblems (problem, statue, date, user_id, exist) VALUES (?, ?, ?, ?, 1)";
      $stmt = mysqli_prepare($connection, $insertQuery);
      mysqli_stmt_bind_param($stmt, "sssi", $problem, $status, $date, $user_id);

      if (mysqli_stmt_execute($stmt)) {
        // Problem inserted successfully
        echo "Problem added successfully";
        header("Location: mainPage.php");
        exit();
      } else {
        // Failed to insert the problem
        echo "Failed to add the problem";
      }
    } else {
      // No matching user found
      echo "Invalid username or password";
    }
  } else {
    // Failed to execute the query
    echo "Error executing the query";
  }

  mysqli_stmt_close($stmt);
}
?>
