<?php
 require 'header.php';
?>

<head>
<style>
   main{background-color: #ccc;height: 700px;}
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
  <h3>Sign Up</h3>
  <?php
  if (isset($_GET["error"])) {

    if ($_GET["error"] == "emptyfields") {
      echo "<h5>! Fill in all the fields</h5>";
    }
    elseif ($_GET["error"] == "invalidmailuid") {
      echo "<h5>! Invalid Mail-Id and Username</h5>";
    }
    elseif ($_GET["error"] == "invalidmail") {
      echo "<h5>! Invalid Mail-Id</h5>";
    }
    elseif ($_GET["error"] == "invaliduid") {
      echo "<h5>! Invalid Username</h5>";
    }
    elseif ($_GET["error"] == "passwordcheck") {
      echo "<h5>! Passwords did not matched</h5>";
    }
    elseif ($_GET["error"] == "usertaken") {
      echo "<h5>! Username already exists</h5>";
    }
  }
  elseif (isset($_GET['signup']) == "success") {
      echo '<h5 id="success">Sign Up Successful !</h5>';
  }
  elseif (isset($_GET['newpwd']) == "passwordupdated") {
      echo '<h5 id="success">Password is Updated !</h5>';
  }

  ?>
  <form id="signup" action="includes/signup.inc.php" method="post">
    <label style="padding:10px 0px;">Username :</label><br>
    <input type="text" name="uid" placeholder="Enter a username" autofocus required><br>
    <label>E-mail :</label><br>
    <input type="email" name="mail" placeholder="Enter a valid mail-id" required><br>
    <label>password :</label><br>
    <input type="password" name="pwd" placeholder="Enter a password" required><br>
    <label>Repeat password :</label><br>
    <input type="password" name="pwd-repeat" placeholder="Repeat the above password" required><br>
    <button type="submit" name="signup-submit">Submit</button>
    <a href="reset-password.php">Forgot Your Password?</a>
  </form>

</div>
</main>


<?php
 require 'footer.php';
?>
