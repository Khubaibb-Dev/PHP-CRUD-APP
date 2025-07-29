<?php
include 'connection.php';

$sql = "SELECT * FROM `usersdata`.`users`";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User List - User Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fs-3" href="#">User Management</a>
    <div>
      <a href="index.php" class="btn btn-outline-light btn-sm">
        <i class="bi bi-person-plus"></i> Add New User
      </a>
    </div>
  </div>
</nav>

<main class="container my-5">

  <div class="card shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">User Details</h4>
      <small class="text-light"><?= date('F j, Y, g:i a') ?></small>
    </div>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle mb-0">
        <thead class="table-success text-center">
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th style="min-width: 160px;">Actions</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php if (mysqli_num_rows($result) > 0): 
              $sn = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?= $sn++ ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['password']) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-2" title="Edit">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" 
                   onclick="return confirm('Are you sure you want to delete this user?');" title="Delete">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </td>
            </tr>
          <?php endwhile; else: ?>
            <tr><td colspan="5" class="text-center fst-italic">No user records found.</td></tr>
          <?php endif; 
          mysqli_close($connect); ?>
        </tbody>
      </table>
    </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
