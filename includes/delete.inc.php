<?php

session_start();

$title = $_SESSION['title'];

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  // $sql = "DELETE FROM posts WHERE post_title='$title'";
  // mysqli_query($conn, $sql);

  $sqlPreparedStmt =   "DELETE FROM posts WHERE post_title=?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {

    ?>

    <script>
      alert("Sorry, database error.");
      window.location.href="../edit.php?sql=error";
    </script>

    <?php
    exit();

  } else {

    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);

    ?>

    <script>
      alert("Your article has been deleted!");
      window.location.href="../edit.php?delete=success";
    </script>

    <?php

    // header("Location: ../edit.php?delete=success");
    exit();
  }

} else {
  header("Location: ../edit.php?title='$title'");
  exit();
}
