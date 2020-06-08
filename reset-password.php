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
</style>
</head>

<main>
  <br><br>
  <div class="form-content">
  <h3>Reset Your Password</h3>
  <?php
    if (isset($_GET['reset'])) {
      if ($_GET['reset'] == "success") {
        echo '<h5 class="success">Check Your Mail Inbox!</h5>';
      }
    }
   ?>
 <form id="signup" action="includes/reset-request.inc.php" method="post">
    <label>E-mail :</label><br>
    <input type="email" name="email" placeholder="Enter your registered mail-id" required><br>
    <button type="submit" name="reset-request-submit">Receive New Password</button>
  </form>
</div>
</main>


<?php
 require 'footer.php';
?>
