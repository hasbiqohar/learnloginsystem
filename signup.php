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
  </section>

<?php include 'footer.php' ?>
