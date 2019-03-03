<?php

session_start();

$title = $_SESSION['title'];

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $sql = "DELETE FROM posts WHERE post_title='$title'";
  mysqli_query($conn, $sql);
  header("Location: ../edit.php?delete=success");
  exit();

} else {
  header("Location: ../edit.php?title='$title'");
  exit();
}
