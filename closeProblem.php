<?php
include 'connectDataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the problem_id and status are provided
    if (isset($_POST['problem_id']) && isset($_POST['status'])) {
        $problemId = $_POST['problem_id'];
        $status = $_POST['status'];

        // Update the status of the problem in the userproblems table
        $updateQuery = "UPDATE userproblems SET statue = '$status' WHERE id_problem = $problemId";
        if ($connection->query($updateQuery) === TRUE) {
            header("Location: adminPage.php");
        } else {
            echo "Error updating problem status: " . $connection->error;
        }
    } else {
        echo "Invalid request parameters.";
    }
} else {
    echo "Invalid request method.";
}
?>
