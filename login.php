<?php
 require 'header.php';
?>

<head>
<style>
main{background-color: #ccc;height: 1000px;padding-top: 50px;}
.form-content{width: 40%;margin: auto;font-size: 20px;
              background-color: white;padding: 20px;padding-top: 10px;}
 h3{text-align: center;}
 #signup{margin-left: 40px;}
 #signup input[type=text],#signup input[type=password],#signup input[type=email]{margin: 10px 0px;width: 60%;}
 #action{padding-top: 15px;margin-left: 50%;}
 h5{color: red;text-align: center;}
 #success{color: green;}
 #signup a{margin-left: 40px;font-size: 16px;text-decoration: none;}
</style>
</head>

<main>
  <br><br>
  <div class="form-content">
  <h3>Log In/Sign In</h3>
  <?php
  if (isset($_GET["error"])) {

    if ($_GET["error"] == "wrongpassword") {
      echo "<h5>Wrong Username or Password Combination!</h5>";
    }

  }

  ?>
  <form id="signup" action="includes/login.inc.php" method="post">
    <label style="padding:10px 0px;">Username/E-mail :</label><br>
    <input type="text" name="mailuid" placeholder="Enter a username" autofocus required><br>
    <label>password :</label><br>
    <input type="password" name="pwd" placeholder="Enter a password" required><br>
    <button type="submit" name="login-submit">Submit</button>
    <a href="reset-password.php">Forgot Your Password?</a>
    <a href="signup.php">signup </a>
  </form>

</div>
</main>


<?php
 require 'footer.php';
?>
