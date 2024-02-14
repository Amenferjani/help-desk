<?php
session_start();
include 'connectDataBase.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
  <link rel="stylesheet" type="text/css" href="styleAdminPage.css">
</head>
<body>
<header>
  <h2>Help desk</h2>
  <div class="button-container">
    <a class="header-button" href="addUser.php">Add</a>
    <div class="dropdown">
      <button class="dropbtn">Actions</button>
      <div class="dropdown-content">
        <a href="editProfile.html">Edit Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</header>


  <div class="container">
    <?php
    $problemsPerPage = 8;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $user_id = $_SESSION['user_id'];

    // Check if the user has admin role
    $roleQuery = "SELECT role FROM users WHERE id = $user_id";
    $roleResult = $connection->query($roleQuery);
    $role = $roleResult->fetch_assoc()['role'];

    if ($role === 'admin') {
      // Count the total number of problems
      $countQuery = "SELECT COUNT(*) AS total FROM userproblems INNER JOIN users ON userproblems.user_id = users.id";
      $countResult = $connection->query($countQuery);
      $totalCount = $countResult->fetch_assoc()['total'];

      // Calculate the total number of pages
      $totalPages = ceil($totalCount / $problemsPerPage);

      // Calculate the offset for the current page
      $offset = ($currentPage - 1) * $problemsPerPage;

      // Retrieve problems, their corresponding users, and status for the current page
      $sql = "SELECT userproblems.*, users.userName FROM userproblems INNER JOIN users ON userproblems.user_id = users.id ORDER BY userproblems.id_problem DESC LIMIT $offset, $problemsPerPage";

      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
        // Display the problems, users, and status
        while ($row = $result->fetch_assoc()) {
          $problem = $row['problem'];
          $user = $row['userName'];
          $status = $row['statue'];
          $problemId = $row['id_problem'];

          // Display the problem, user, and status information
          echo "<div class='problem-card'>";
          echo "<div class='top-right-buttons'>";
          echo "<form method='post' action='updateProblemStatus.php'>";
          echo "<input type='hidden' name='problem_id' value='" . $problemId . "'>";
          echo "<button class='status-button done' type='submit' name='status' value='done'>Mark as Done</button>";
          echo "</form>";
          echo "<form method='get' action='view.php'>";
          echo "<input type='hidden' name='id' value='" . $problemId . "'>";
          echo "<button class='status-button view' type='submit' name='status' value='view'>View</button>";
          echo "</form>";
          echo "<form method='post' action='closeProblem.php'>";
          echo "<input type='hidden' name='problem_id' value='" . $problemId . "'>";
          echo "<button class='status-button close' type='submit' name='status' value='closed'>Close</button>";
          echo "</form>";
          echo "</div>";
          echo "<h3>Problem:</h3>";
          echo "<p>" . $problem . "</p>";
          echo "<h4>Sent by:</h4>";
          echo "<p>" . $user . "</p>";
          echo "<h4>Status:</h4>";
          echo "<p>" . $status . "</p>";
          echo "</div>";
        }

        // Display pagination links
        echo "<div class='pagination'>";
        if ($currentPage > 1) {
          echo "<a href='adminPage.php?page=" . ($currentPage - 1) . "'>&lt; Previous</a>";
        }
        for ($i = 1; $i <= $totalPages; $i++) {
          echo "<a href='adminPage.php?page=" . $i . "'>" . $i . "</a>";
        }
        if ($currentPage < $totalPages) {
          echo "<a href='adminPage.php?page=" . ($currentPage + 1) . "'>Next &gt;</a>";
        }
        echo "</div>";
      } else {
        echo "<p>No problems found.</p>";
      }
    } else {
      echo "<p>Access denied. You do not have permission to view this page.</p>";
    }
    ?>
  </div>

  <script>
    // JavaScript to handle the dropdown functionality
    document.addEventListener('click', function(event) {
      var dropdowns = document.getElementsByClassName('dropdown-content');
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (!openDropdown.parentElement.contains(event.target)) {
          openDropdown.style.display = 'none';
        }
      }
    });
  </script>
</body>
</html>
<?php
} else {
    ?>
    <!DOCTYPE html>
<html>
<head>
  <title>Error Page</title>
  <link rel="stylesheet" type="text/css" href="styleForMainPage.css">
</head>
<body>
  <div class="error-container">
    <h2>Error Message</h2>
    <p>An error occurred. Please try again later.</p>
  </div>
</body>
</html>
<?php
}
?>
