<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "help_desk";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    echo "Connection failed:";
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";
?>
<?php
// ...

?>

