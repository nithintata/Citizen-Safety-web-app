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
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];

    if (empty($selector) || empty($validator)) {
      echo '<h5>Could not validate your request</h5>';
    }
    else {
      if ((ctype_xdigit($selector) !== false) && (ctype_xdigit($validator) !== false)) {
        echo '<form id="signup" action="includes/reset-password.inc.php" method="post">
           <input type="hidden" name="selector" value="'. $selector.'">
           <input type="hidden" name="validator" value="'. $validator.'">
           <label>New Password :</label><br>
           <input type="password" name="pwd" placeholder="Enter Your New Password" required><br>
           <label>Repeat New Password :</label><br>
           <input type="password" name="pwd-repeat" placeholder="Repeat Your New Password" required><br>

           <button type="submit" name="reset-password-submit">Change Password</button>
         </form>';
      }
    }
   ?>

</div>
</main>


<?php
 require 'footer.php';
?>
