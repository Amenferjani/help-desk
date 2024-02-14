<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <link rel="stylesheet" type="text/css" href="styleAddUser.css">
</head>
<body>
  <header>
    <div class="header-left">
      <h2 class="help-desk">Help Desk</h2>
    </div>
    <div class="header-right">
      <a href="adminPage.php" class="problems-button">Problems</a>
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
    <h2>Add User</h2>
    <form action="submit.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>

</body>
</html>
