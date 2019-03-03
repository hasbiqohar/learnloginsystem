<?php include 'header.php'; ?>

  <section  class="container">
    <h1>Welcome to The Websites</h1>

    <?php

      if (isset($_SESSION['u_id'])) {
        echo "Your are logged in!";
      }

     ?>

  </section>

<?php include 'footer.php' ?>
