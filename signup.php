<?php include 'header.php'; ?>

  <section  class="container">
    <h1>Come Join Us!</h1>
    <form class="signup-form" action="includes/signup.inc.php" method="post">
      <input type="text" name="first" placeholder="First Name" />
      <input type="text" name="last" placeholder="Last Name" />
      <input type="text" name="email" placeholder="Email" />
      <input type="text" name="uid" placeholder="Username" />
      <input type="password" name="pwd" placeholder="Password" />
      <button type="submit" name="submit">Sign up</button>
    </form>
    <?php

    $fullURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($fullURL, "signup=empty") == true) {
      ?>

      <p class="error-message">
        You did not fill in all fields!
      </p>

      <?php
      exit();
    } elseif (strpos($fullURL, "signup=invalid") == true) {
      ?>

      <p class="error-message">
        You used invalid characters, write in capitalize!
      </p>

      <?php
      exit();
    } elseif (strpos($fullURL, "signup=email") == true) {
      ?>

      <p class="error-message">
        You used an invalid email!
      </p>

      <?php
      exit();
    } elseif (strpos($fullURL, "signup=usertaken") == true) {
      ?>

      <p class="error-message">
        Username is taken! Try another name.
      </p>

      <?php
      exit();
    } elseif (strpos($fullURL, "signup=empty") == true) {
      ?>

      <p class="success-message">
        You have been signed up!
      </p>

      <?php
      exit();
    }

     ?>
  </section>

<?php include 'footer.php' ?>
