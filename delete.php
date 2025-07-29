<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM `usersdata`.`users` WHERE id = $id";
    if (mysqli_query($connect, $sql)) {
        echo "<script>
                alert('User deleted successfully!');
                window.location.href = 'display.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete user.');
                window.location.href = 'display.php';
              </script>";
    }

    mysqli_close($connect);
} else {
    echo "<script>
            alert('Invalid request!');
            window.location.href = 'display.php';
          </script>";
}
?>
