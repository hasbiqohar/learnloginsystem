<?php

if (isset($_POST['submit'])) {

  include_once 'dbh.inc.php';

  $first = mysqli_real_escape_string($conn, $_POST['first']);
  $last = mysqli_real_escape_string($conn, $_POST['last']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $uid = mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    header("Location: ../signup.php?signup=empty");
    exit();
  } else {
    if (!preg_match("/^([A-Z])([a-z])+$/", $first) || !preg_match("/^([A-Z])([a-z])+$/", $last)) {
      header("Location: ../signup.php?signup=invalid");
      exit();
    } else {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=email");
        exit();
      } else {

        $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
          header("Location: ../signup.php?signup=usertaken");
          exit();
        } else {

          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

          // $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_password) VALUE ('$first', '$last', '$email', '$uid', '$hashedPwd')";
          $sqlPreparedStmt = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_password) VALUE (?, ?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {
            header("Location: ../signup.php?sql=error");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $hashedPwd);
            mysqli_stmt_execute($stmt);
          }
          // mysqli_query($conn, $sql);
          header("Location: ../signup.php?signup=success");
          exit();

        }

      }
    }
  }

} else {
  header("Location: ../signup.php");
  exit();
}
