<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $author = $_SESSION['u_uid'];
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
    $dateFormat = date('d-m-Y H:i:s');

    // $sql = "INSERT INTO posts (post_author, post_title, post_content, post_time) VALUE ('$author', '$title', '$content', '$dateFormat')";
    // mysqli_query($conn, $sql);

    $sqlPreparedStmt = "INSERT INTO posts (post_author, post_title, post_content, post_time) VALUE (?, ?, ?, ?)";

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

      mysqli_stmt_bind_param($stmt, "ssss", $author, $title, $content, $dateFormat);
      mysqli_stmt_execute($stmt);

      ?>

      <script>
        alert("Your article has been posted!");
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
