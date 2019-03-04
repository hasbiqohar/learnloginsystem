<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $author = $_SESSION['u_uid'];
  $lastTitle = $_SESSION['title'];
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  if (empty($title) || empty($content)) {

    ?>

    <script>
      alert("Fill in the blank form!");
      window.location.href="../edit.php?post=empty";
    </script>

    <?php

    // header("Location: ../edit.php?post=error");
    exit();

  } else {

    date_default_timezone_set('Asia/Jakarta');
    $dateFormat = date('Y-m-d H:i:s');

    // $sql = "UPDATE posts SET post_title='$title', post_content='$content', post_time='$dateFormat' WHERE post_title='$lastTitle'";
    // mysqli_query($conn, $sql);

    $sqlPreparedStmt = "UPDATE posts SET post_title=?, post_content=?, post_time=? WHERE post_title=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {
      ?>

      <script>
        alert("Sorry, database error.");
        window.location.href="../edit.php?sql=error";
      </script>

      <?php
      // header("Location: ../signup.php?sql=error");
      exit();
    } else {

      mysqli_stmt_bind_param($stmt, "ssss", $title, $content, $dateFormat, $lastTitle);
      mysqli_stmt_execute($stmt);

      ?>

      <script>
        alert("Your article has been updated!");
        window.location.href="../edit.php?post=success";
      </script>

      <?php

      // header("Location: ../edit.php?post=success");
      exit();
    }


  }

} else {
  header("Location: ../edit.php");
  exit();
}
