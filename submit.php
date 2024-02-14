<?php
session_start();
include 'connectDataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the submitted username and description from the form
  $username = $_POST['username'];
  $description = $_POST['description'];

  // Prepare a query to retrieve the user ID based on the provided username
  $getUserQuery = "SELECT id FROM users WHERE userName = ?";
  $stmt = $connection->prepare($getUserQuery);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Fetch the user ID
    $row = $result->fetch_assoc();
    $userId = $row['id'];

    // Prepare a query to insert the user ID and description into the userPc table
    $insertQuery = "INSERT INTO userPc (user_id, PcDiscription) VALUES (?, ?)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_param("is", $userId, $description);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
      header("Location: addUser.php");
      exit();
    } else {
      echo "Failed to add user.";
    }
  } else {
    echo "User not found.";
  }
} else {
  echo "Invalid request.";
}
?>
