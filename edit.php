<?php
include 'connection.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid user ID!'); window.location.href='display.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// Fetch user details
$sql = "SELECT * FROM `usersdata`.`users` WHERE id = $id";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) != 1) {
    echo "<script>alert('User not found!'); window.location.href='display.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);

$username = $row['username'];
$email = $row['email'];
$password = $row['password'];

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $update_sql = "UPDATE `usersdata`.`users`
                   SET username='$username', email='$email', password='$password' 
                   WHERE id = $id";

    if (mysqli_query($connect, $update_sql)) {
        echo "<script>
                alert('User updated successfully!');
                window.location.href = 'display.php';
              </script>";
        exit;
    } else {
        die("Error updating record: " . mysqli_error($connect));
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit User - User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fs-3" href="#">User Management</a>
    <div>
      <a href="display.php" class="btn btn-outline-light btn-sm">
        <i class="bi bi-table"></i> View Users
      </a>
    </div>
  </div>
</nav>

<main class="container my-5">
  <div class="card shadow-sm mx-auto" style="max-width: 600px;">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0">Edit User</h4>
    </div>
    <div class="card-body">
      <form method="POST" novalidate>
        <div class="form-floating mb-3">
          <input type="text" name="username" class="form-control" id="username" 
                 placeholder="Username" value="<?= htmlspecialchars($username) ?>" required />
          <label for="username">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="email" 
                 placeholder="name@example.com" value="<?= htmlspecialchars($email) ?>" required />
          <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-4">
          <input type="text" name="password" class="form-control" id="password" 
                 placeholder="Password" value="<?= htmlspecialchars($password) ?>" required />
          <label for="password">Password</label>
        </div>
        <button type="submit" name="update" class="btn btn-primary w-100 fs-5">
          <i class="bi bi-save"></i> Update User
        </button>
      </form>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
