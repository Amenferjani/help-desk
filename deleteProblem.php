<?php
// Include the database connection
include 'connectDataBase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the problem ID from the form submission
  $problemId = $_POST['id'];

  // Update the 'exist' column to 0 and set the status to 'deleted' for the specified problem ID
  $query = "UPDATE userproblems SET exist = 0, statue = 'deleted' WHERE id_problem = ?";
  $stmt = mysqli_prepare($connection, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $problemId);

    if (mysqli_stmt_execute($stmt)) {
      // Update successful, redirect to history.php
      mysqli_stmt_close($stmt);
      mysqli_close($connection);
      header("Location: history.php");
      exit();
    } else {
      // Failed to execute the statement, display an error message
      echo "Failed to execute the statement: " . mysqli_error($connection);
    }
  } else {
    // Failed to prepare the statement, display an error message
    echo "Failed to prepare the statement: " . mysqli_error($connection);
  }
} else {
  // Invalid request method, redirect to history.php
  header("Location: history.php");
  exit();
}
?>
