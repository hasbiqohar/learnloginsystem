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
      header("Location: ../signup.php?signup=invalid-name");
      exit();
    } else {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=invalid-email&first=$first&last=$last");
        exit();
      } else {

        $sql = "SELECT * FROM users WHERE user_email=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../signup.php?sql=error");
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, 's', $email);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          $resultCheck = mysqli_num_rows($result);

          // if ($resultCheck > 0) {
          //   header("Location: ../signup.php?signup=email-taken&first=$first&last=$last");
          //   exit();
          // } else {
            $sql = "SELECT * FROM users WHERE user_uid=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../signup.php?sql=error");
              exit();
            } else {

              mysqli_stmt_bind_param($stmt, 's', $uid);
              mysqli_stmt_execute($stmt);

              $result = mysqli_stmt_get_result($stmt);

              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
                header("Location: ../signup.php?signup=user-taken&first=$first&last=$last&email=$email");
                exit();
              } else {

                if (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])([0-9A-Za-z!@#$%]){8,}$/", $pwd)) {

                  $pwdCount = strlen($pwd);

                  if ($pwdCount >= 8) {
                    header("Location: ../signup.php?signup=pass-too-weak&first=$first&last=$last&email=$email&uid=$uid");
                  } else {
                    header("Location: ../signup.php?signup=pass-too-weak&pwdcnt=$pwdCount&first=$first&last=$last&email=$email&uid=$uid");
                  }

                  exit();
                } else {
                  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                  $sqlPreparedStmt = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_password) VALUE (?, ?, ?, ?, ?)";
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {
                    header("Location: ../signup.php?sql=error");
                    exit();
                  } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $uid, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                  }
                  header("Location: ../signup.php?signup=success");
                  exit();
                }

              }
            // }
          }

        }
      }
    }
  }

} else {
  header("Location: ../signup.php");
  exit();
}
