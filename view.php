<?php
session_start();
include 'connectDataBase.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Retrieve the problem ID from the query string
        $problemId = $_GET['id'];

        // Update the status to "seen" for the specified problem ID
        $query = "UPDATE userproblems SET statue = 'seen' WHERE id_problem = ?";
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $problemId);

            if (mysqli_stmt_execute($stmt)) {
                // Update successful
                mysqli_stmt_close($stmt);
                mysqli_close($connection);

                // Redirect back to admin page or any other desired location
                header("Location: adminPage.php");
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
        // Invalid request method
        echo "Invalid request method";
    }
} else {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
