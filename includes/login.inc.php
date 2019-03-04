<?php

session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  if(empty($uid) || empty($pwd)) {
    header("Location: ../index.php?login=empty");
    exit();
  } else {

    // $sql = "SELECT * FROM users WHERE user_uid='$uid' or user_email='$uid'";
    // $result = mysqli_query($conn, $sql);
    // $resultCheck = mysqli_num_rows($result);

    $sqlPreparedStmt = "SELECT * FROM users WHERE user_uid=? or user_email=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {

    // if ($resultCheck < 1) {
      header("Location: ../index.php?login=error");
      exit();

    } else {

      mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {

        $hashedPwdCheck = password_verify($pwd, $row['user_password']);

        if ($hashedPwdCheck == false) {
          header("Location: ../index.php?login=error");
          exit();
        } else if ($hashedPwdCheck == true) {

          $_SESSION['u_id'] = $row['user_id'];
          $_SESSION['u_first'] = $row['user_first'];
          $_SESSION['u_last'] = $row['user_last'];
          $_SESSION['u_email'] = $row['user_email'];
          $_SESSION['u_uid'] = $row['user_uid'];

          $userid = $_SESSION['u_uid'];

          header("Location: ../index.php?login='$userid'");
          exit();

        }

      }

    }

  }

} else {
  header("Location: ../index.php");
  exit();
}
