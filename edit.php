<?php include 'header.php'; ?>

  <section  class="container">

    <?php

    if (isset($_SESSION['u_id'])) {

      if (isset($_GET['title'])) {

        $title = $_GET['title'];
        $_SESSION['title'] = $_GET['title'];

        include 'includes/dbh.inc.php';

        $sql = "SELECT * FROM posts WHERE post_title='$title'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
          if ($row['post_author'] == $_SESSION['u_uid']) {

            ?>

            <h1>Edit article</h1>

            <form class="signup-form edit-form delete-form" action="includes/delete.inc.php" method="post">
              <button type="submit" name="submit">Delete</button>
            </form>

            <form class="signup-form edit-form" action="includes/update.inc.php" method="post">
              <input type="text" name="title" placeholder="Title" value="<?php echo $title; ?>" />
              <textarea name="content" rows="8" cols="100"><?php echo $row['post_content']; ?></textarea>
              <button type="submit" name="submit">Post</button>
            </form>

            <?php

          } else {
            ?>

            <h1>You cannot edit this article</h1>

            <?php
          }
        } else {
          header("Location: ../edit.php?update=error");
          exit();
        }

      } else {
        ?>

        <h1>Post an article</h1>

        <form class="signup-form edit-form" action="includes/edit.inc.php" method="post">
          <input type="text" name="title" placeholder="Title" />
          <textarea name="content" rows="8" cols="100"></textarea>
          <button type="submit" name="submit">Post</button>
        </form>

        <?php
      }

    } else {
      echo 'Sorry, you are not sign up yet, please sign up to post the article';
    }

     ?>

  </section>

<?php include 'footer.php' ?>
