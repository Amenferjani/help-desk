<?php
include 'connectDataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the problem ID from the form submission
  $problemId = $_POST['problem_id'];

  // Update the problem status to 'done' in the database
  $updateQuery = "UPDATE userproblems SET statue = 'done' WHERE id_problem = ?";
  $stmt = mysqli_prepare($connection, $updateQuery);
  mysqli_stmt_bind_param($stmt, "i", $problemId);
  mysqli_stmt_execute($stmt);

  // Redirect back to the admin page
  header("Location: adminPage.php");
  exit();
} else {
  // Invalid request, redirect back to the admin page
  header("Location: adminPage.php");
  exit();
}
?>
