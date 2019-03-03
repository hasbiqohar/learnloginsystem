<?php session_start(); ?>

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
      echo '<form class="nav-login" action="includes/logout.inc.php" method="post">
              <button type="submit" name="submit">Log out</button>
            </form>';
    } else {
      echo '<form class="nav-login" action="includes/login.inc.php" method="post">
              <input type="text" name="uid" placeholder="Username/e-mail" />
              <input type="password" name="pwd" placeholder="Password" />
              <button type="submit" name="submit">Log in</button>
            </form>
            <a class="nav-signup" href="signup.php">Sign up</a>';
    }

     ?>

  </header>
