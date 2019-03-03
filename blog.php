<?php include 'header.php'; ?>

  <section  class="container blog">
    <h1>Blog</h1>

    <?php

    include 'includes/dbh.inc.php';

    // $sql = "SELECT * FROM posts";
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)) {
        if (isset($_SESSION['u_id'])) {
          ?>
            <a href="update.php">
              <h2>
                <?php echo $row['post_title']; ?>
              </h2>
            </a>
            <p>
              <?php echo $row['post_time']; ?>
            </p>
            <span>
              <?php echo $row['post_author']; ?>
            </span>
            <p>
              <?php echo $row['post_content']; ?>
            </p>
          <?php
        } else {
          ?>
            <h2>
              <?php echo $row['post_title']; ?>
            </h2>
            <p>
              <?php echo $row['post_time']; ?>
            </p>
            <span>
              <?php echo $row['post_author']; ?>
            </span>
            <p>
              <?php echo $row['post_content']; ?>
            </p>
          <?php
        }
    }

     ?>

  </section>

<?php include 'footer.php' ?>
