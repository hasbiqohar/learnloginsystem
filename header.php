<?php
  session_start();
  $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Log System</title>
  <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>

  <header class="container">
    <nav>
      <ul>
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="blog.php">Blog</a>
        </li>
        <?php

        if (isset($_SESSION['u_id'])) {
          ?>
          <li>
            <a href="edit.php">Edit</a>
          </li>
          <?php
        }

         ?>
      </ul>
    </nav>

    <?php

    if (isset($_SESSION['u_id'])) {
      ?>
            <form class="nav-login" action="includes/logout.inc.php" method="post">
              <?php

              if (strpos($fullURL, "login=success") == true) {
                ?>

                <p class="success-message login-message">
                  Welcome
                  <?php
                    $first = $_SESSION['u_first'];
                    $last = $_SESSION['u_last'];
                    echo "$first $last";
                  ?>!
                </p>

                <?php
              }

              ?>
              <button type="submit" name="submit">Log out</button>
            </form>
      <?php
    } else {
      ?>
            <form class="nav-login" action="includes/login.inc.php" method="post">
              <?php

              if (strpos($fullURL, "login=empty") == true) {
                ?>

                <p class="error-message login-message">
                  You did not fill in all fields!
                </p>

                <?php
              } elseif (strpos($fullURL, "login=error") == true) {
                ?>

                <p class="error-message login-message">
                  Error with username or password!
                </p>

                <?php
              }
              ?>
              <input type="text" name="uid" placeholder="Username/e-mail" />
              <input type="password" name="pwd" placeholder="Password" />
              <button type="submit" name="submit">Log in</button>
            </form>
            <a class="nav-signup" href="signup.php">Sign up</a>
      <?php
    }

     ?>

  </header>
