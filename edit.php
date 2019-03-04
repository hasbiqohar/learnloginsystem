<?php include 'header.php'; ?>

  <section  class="container">

    <?php

    if (isset($_SESSION['u_id'])) {

      if (isset($_GET['title'])) {

        $title = $_GET['title'];
        $_SESSION['title'] = $_GET['title'];

        include 'includes/dbh.inc.php';

        // $sql = "SELECT * FROM posts WHERE post_title='$title'";
        // $result = mysqli_query($conn, $sql);

        $sqlPreparedStmt = "SELECT * FROM posts WHERE post_title=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sqlPreparedStmt)) {
          ?>

          <script>
            alert("Sorry, database error.");
            window.location.href="../edit.php?sql=error";
          </script>

          <?php
          exit();
        } else {

          mysqli_stmt_bind_param($stmt, "s", $title);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);

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
