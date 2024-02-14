<?php include 'connectDataBase.php'; ?>
<?php
    session_start();
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUserName = $_POST["username"];
    $password = $_POST["password"];
    $newEmail = $_POST["email"];
    $newPassword=$_POST["new_password"];
    $name=$_SESSION['username'];

    $sql="UPDATE users SET userPassword = '$newPassword',userName ='$newUserName',email='$newEmail'  WHERE userPassword ='$password' AND userName ='$name' ";
    if(mysqli_query($connection, $sql)){
        echo "user details changed successful!";
        $_SESSION['username'] = $newUserName;
        $_SESSION['password'] =  $newPassword;
        $_SESSION['loggedin'] = true;
        header("Location: mainPage.php"); 
        exit();

    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
 }
 ?>