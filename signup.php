<?php include 'connectDataBase.php'; ?>
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the sign-up form data submitted by the user
  $username = $_POST["name"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  
   $sql = "INSERT INTO users (userName, userPassword, email,role) VALUES ('$username', '$password', '$email','default')";
  
   if (mysqli_query($connection, $sql)) {
     echo "Sign-up successful!";
     header("Location: login.html");

   } else {
     echo "Error: " . $sql . "<br>" . mysqli_error($connection);
   }
  //mysqli_close($connection);
 }
?>
