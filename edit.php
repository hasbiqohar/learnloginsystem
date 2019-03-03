<?php include 'header.php'; ?>

  <section  class="container">
    <h1>Post an article</h1>

    <?php

    if (isset($_SESSION['u_id'])) {
      ?>

      <form class="signup-form edit-form" action="includes/edit.inc.php" method="post">
        <input type="text" name="title" placeholder="Title" />
        <textarea name="content" rows="8" cols="100"></textarea>
        <button type="submit" name="submit">Post</button>
      </form>

      <?php
    } else {
      echo 'Sorry, you are not sign up yet, please sign up to post the article';
    }

     ?>

  </section>

<?php include 'footer.php' ?>
