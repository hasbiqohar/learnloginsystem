<?php

session_start();

$title = $_SESSION['title'];

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $sql = "DELETE FROM posts WHERE post_title='$title'";
  mysqli_query($conn, $sql);

  ?>

  <script>
    alert("Your article has been deleted!");
    window.location.href="../edit.php?delete=success";
  </script>

  <?php

  header("Location: ../edit.php?delete=success");
  exit();

} else {
  header("Location: ../edit.php?title='$title'");
  exit();
}
