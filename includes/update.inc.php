<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $author = $_SESSION['u_uid'];
  $lastTitle = $_SESSION['title'];
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  if (empty($title) || empty($content)) {

    header("Location: ../edit.php?post=error");
    exit();

  } else {

    date_default_timezone_set('Asia/Jakarta');
    $dateFormat = date('Y-m-d H:i:s');

    $sql = "INSERT INTO posts (post_author, post_title, post_content, post_time) VALUE ('$author', '$title', '$content', '$dateFormat')";
    $sql = "UPDATE posts SET post_title='$title', post_content='$content', post_time='$dateFormat' WHERE post_title='$lastTitle'";
    mysqli_query($conn, $sql);
    header("Location: ../edit.php?post=success");
    exit();
  }

} else {
  header("Location: ../edit.php");
  exit();
}
