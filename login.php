<?php include 'connectDataBase.php'; ?>
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the login form data submitted by the user
  $_SESSION['username'] = $_POST["username"];
  $_SESSION['password'] = $_POST["password"];
  $username = $_SESSION['username'];
  $password = $_SESSION['password'];

  // Perform login validation
  // ...

  // Your login validation logic here
  // ...

  $sql = "SELECT * FROM users WHERE userName = '$username' AND userPassword = '$password'";
  $result = $connection->query($sql);

  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $row['id'];

    if ($row['role'] == "admin") {
      // User is an admin, redirect to the admin page
      header("Location: adminPage.php");
      exit();
    } else {
      // User is not an admin, redirect to the main page
      header("Location: mainPage.php");
      exit();
    }
  } else {
    echo "Invalid username or password.";
  }
}
?>
